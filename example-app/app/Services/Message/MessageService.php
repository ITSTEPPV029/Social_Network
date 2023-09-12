<?php

namespace App\Services\Message;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Events\StoreMessageEvent;

class MessageService
{
    /**
     *  
     *
     * @param 
     * @return App\Models\User
     */
    public static function messageShow()
    {
        $user_id = Auth::user()->id;

        $user =  Message::select('*')
            ->join('users', function ($join) use ($user_id) {
                $join->on('users.id', '=', 'messages.recipient_user_id')
                    ->orWhere('users.id', '=', 'messages.sender_user_id');
            })
            ->where(function ($query) use ($user_id) {
                $query->where('messages.recipient_user_id', '=', $user_id)
                    ->whereRaw('users.id = messages.sender_user_id');
            })
            ->orWhere(function ($query) use ($user_id) {
                $query->where('messages.sender_user_id', '=', $user_id)
                    ->whereRaw('users.id = messages.recipient_user_id');
            })
            ->orderBy('messages.id', 'DESC')
            ->first();

        if ($user == null) {
            $user = User::distinct()
                ->select('*')
                ->join('messages', function ($join) use ($user_id) {
                    $join->on('users.id', '=', 'messages.sender_user_id')
                        ->orWhere('users.id', '=', 'messages.recipient_user_id');
                })
                ->where(function ($query) use ($user_id) {
                    $query->where(function ($query) use ($user_id) {
                        $query->where('messages.sender_user_id', $user_id)
                            ->where('messages.recipient_user_id', '!=', $user_id);
                    })
                        ->orWhere(function ($query) use ($user_id) {
                            $query->where('messages.recipient_user_id', $user_id)
                                ->where('messages.sender_user_id', '!=', $user_id);
                        });
                })->first();
        }

        return $user;
    }

    /**
     *  receives a message from the user with whom you are currently chatting
     *
     * @param 
     * @return App\Models\User
     */
    public static function index($request)
    {

        $user = User::find($request->input('id'));

        $messages = Message::with('senderUser')
            ->where(function ($query) use ($user) {
                $query->where('sender_user_id', $user->id)
                    ->orWhere('recipient_user_id', $user->id);
            })
            ->where(function ($query) use ($user) {
                $query->where('sender_user_id',  Auth::user()->id)
                    ->orWhere('recipient_user_id', Auth::user()->id);
            })
            ->orderByDesc('created_at')->take(7)->get();

        $messages = array_reverse($messages->toArray());
       
        self::readFalse($user);
        return $messages;
    }


    /**
     * 
     *
     * @param 
     * @return 
     */
    public static function store($request)
    {
        $message = new Message();
        $message->text = $request->input('text');
        $message->sender_user_id = Auth::user()->id;
        $message->recipient_user_id = $request->input('id');
        $message->read = true;
        $message->save();

        broadcast(new StoreMessageEvent($message, $request->input('id')))->toOthers();

        return $message;
    }

    /**
     * We note that the message has been read
     *
     * @param 
     * @return 
     */
    public static function readFalse(User $user)
    {
        $messages = Message::where('sender_user_id', $user->id)
            ->where('recipient_user_id', Auth::user()->id)
            ->get();

        foreach ($messages as $message) {
            $message->read = false;
            $message->save();
        }
    }

    /**
     * 
     *
     * @param 
     * @return App\Models\User
     */
    public static function getChats()
    {
        $user_id =  Auth::user()->id;
        $user = User::select('*')
            ->where(function ($query) use ($user_id) {
                $query->where('sender_user_id', $user_id)
                    ->orWhere('recipient_user_id', $user_id);
            })
            ->join('messages', function ($join) use ($user_id) {
                $join->on('users.id', '=', 'messages.recipient_user_id')
                    ->where('messages.sender_user_id', $user_id)
                    ->orWhere(function ($query) use ($user_id) {
                        $query->where('users.id', '=', 'messages.sender_user_id')
                            ->where('messages.recipient_user_id', $user_id);
                    });
            })
            ->get();

        //створення колекції з ід
        $user_ids = $user->pluck('id')->toArray();

        $additionalUsers =User::distinct()
            ->select('users.*')
            ->join('messages', function ($join) use ($user_id) {
                $join->on('users.id', '=', 'messages.sender_user_id')
                    ->orWhere('users.id', '=', 'messages.recipient_user_id');
            })
            ->where(function ($query) use ($user_id, $user_ids) {
                $query->where(function ($query) use ($user_id, $user_ids) {
                    $query->where('messages.sender_user_id', $user_id)
                        ->where('messages.recipient_user_id', '!=', $user_id);
                })
                    ->orWhere(function ($query) use ($user_id, $user_ids) {
                        $query->where('messages.recipient_user_id', $user_id)
                            ->where('messages.sender_user_id', '!=', $user_id);
                    })
                    ->whereNotIn('users.id', $user_ids);
            })->get();

        $user = $user->concat($additionalUsers);

        $user = $user->reject(function ($user) use ($user_id) {
            return $user->id ==  $user_id;
        });

        return $user;
    }

   /**
     * 
     *
     * @param 
     * @return
     */
    public static function getNotReadMessage(){

        $messages = Message::where('recipient_user_id', Auth::user()->id)
        ->Where('read',true)
        ->get();

        return $messages->pluck('sender_user_id')->toArray();
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\StoreMessageEvent;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //вивід остання чату користувача (коли він нажимає на повідомлення)
    public function messageShow()     
    {    
        $user_id = Auth::user()->id; 

            $user = DB::table('messages')
            ->select('users.*')
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

        if($user==null)
        {
            $user = DB::table('users')
            ->distinct()
            ->select('users.*')
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
     return view('home/message',compact('user'));
    }
    
    public function openChat(Request $request) 
    {
        return  $this->index($request);
    }
 
    public function sendingMessage(User $user)     
    {          
        return view('home/message',compact('user'));
    }

//отримує повідомлення від користувача з яким зараз чат  
    public function index(Request $request)     
    {     
        $user = User::find($request->input('id'));

        $messages = Message::with('senderUser')
        ->where(function ($query) use ($user) {
            $query->where('sender_user_id',$user->id)
                  ->orWhere('recipient_user_id',$user->id );
        })
        ->where(function ($query) use ($user) {
            $query->where('sender_user_id',  Auth::user()->id)
                  ->orWhere('recipient_user_id', Auth::user()->id );
        })
        ->orderByDesc('created_at')->take(7)->get();

        $messages = array_reverse($messages->toArray());

        $this->readFalse($user);

        return  $messages;
    }

    public function store(Request $request)     
    {
        $message = new Message();  
        $message->text = $request->input('text');
        $message->sender_user_id = Auth::user()->id;
        $message->recipient_user_id = $request->input('id');
        $message->read=true;
        $message->save(); 

     broadcast(new StoreMessageEvent($message ,$request->input('id')))->toOthers();  

     return response()->json($message->load('senderUser'));
    }

    public function getChats()     
    {       
       $user_id =  Auth::user()->id; 
       $user = DB::table('users')
        ->distinct()
        ->select('users.*')
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
       
        $additionalUsers = DB::table('users')
            ->distinct()
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
            })
            ->get();

            $user = $user->concat($additionalUsers);

            $user = $user->reject(function ($user) use ( $user_id) {
             return $user->id ==  $user_id;
              });

        return  $user;
    }

    public function  indexChat(Request $request)
    {
       $user  = Auth::user();
       return  $user ;
    }
//відмічаємо що повідомлення прочитано
    public function readFalse(User $user)
    {
        $messages = Message::where('sender_user_id', $user->id)
        ->where('recipient_user_id', Auth::user()->id)
        ->get();

        foreach ($messages as $message) {
            $message->read = false;
            $message->save();
        }
    }

    public function  readMessageTrue(Request $request)
    {
        $user = User::find($request->input('id'));
        $this->readFalse($user);
    }

    public function  getNotReadMessage(Request $request)
    {
        $user = User::find($request->input('id'));

         $messages = Message::where('recipient_user_id', Auth::user()->id)
        ->Where('read',true)
        ->get();

        $messagesId= $messages->pluck('sender_user_id')->toArray();

        return   $messagesId;
    }
    

}

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
    public function messageShow()     
    {    
        $user_id =  Auth::user()->id; 

        $user = DB::table('users')
        ->distinct()
        ->select('users.*')
        ->join('messages', function($join) use ($user_id) {
            $join->on('users.id', '=', 'messages.sender_user_id')
                ->orWhere('users.id', '=', 'messages.recipient_user_id')
                ->where(function($query) use ($user_id) {
                    $query->where('messages.sender_user_id', '=', $user_id)
                        ->orWhere('messages.recipient_user_id', '=', $user_id);
                });
        })->first(); // ->get();
      
        return view('home/message',compact('user'));
    }

    public function sendingMessage(User $user)     
    {          
        return view('home/message',compact('user'));
    }

    public function index(Request $request)     
    {     
        $user =User::find($request->input('id'));

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

        return  $messages;//response()->json($messages);
    }

    public function store(Request $request)     
    {
        $message = new Message();  
        $message->text = $request->input('text');
        $message->sender_user_id = Auth::user()->id;
        $message->recipient_user_id = $request->input('id');
        $message->save(); 

     broadcast(new StoreMessageEvent($message ,$request->input('id')))->toOthers();  

     return response()->json($message->load('senderUser'));
      // return $message;
    }

    public function getChats()     
    {       
        $user_id =  Auth::user()->id; 

        $user = DB::table('users')
        ->distinct()
        ->select('users.*')
        ->join('messages', function($join) use ($user_id) {
            $join->on('users.id', '=', 'messages.sender_user_id')
                ->orWhere('users.id', '=', 'messages.recipient_user_id')
                ->where(function($query) use ($user_id) {
                    $query->where('messages.sender_user_id', '=', $user_id)
                        ->orWhere('messages.recipient_user_id', '=', $user_id);
                });
        })->get();

        
        $user = $user->reject(function ($user) use ( $user_id) {
            return $user->id ==  $user_id;
        });

        return  $user;
    }

    public function  indexChat(Request $request)
    {

       // userChatId
         $user   = Auth::user();

        return  $user ;

    }


}

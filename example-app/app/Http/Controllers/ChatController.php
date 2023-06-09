<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\StoreChatEvent;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
   
    public function chatView()     
    {    
        return view('home/chat');
    }

    public function index()     
    {     
       // return Chat::latest()->take(10)->get();
       $messages = Chat::with('user')
       ->orderByDesc('created_at')
              ->take(7)
              ->get();
     $messages = array_reverse($messages->toArray());
        return response()->json($messages);
    }
    public function store(Request $request)     
    {
       $chat = new Chat();  
       $chat->text = $request->input('text');
       $chat->user_id = Auth::user()->id;
       $chat->save(); 
     
        //$chat->crated_at=// доробити 
        broadcast(new StoreChatEvent($chat))->toOthers();
        //Chat::create()
        // $request->validate([
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|string|min:6',
        //    ]);


       //return $chat->load('user');
        return response()->json($chat->load('user'));
        
    }



}

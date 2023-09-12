<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\StoreChatEvent;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
 /**
  *  chat page 
  *
  * @param 
  * @return \Illuminate\Http\Response
  */
  public function chatView()     
  {    
    return view('home/chat');
  }

  /**
   * 
   *
   * @param 
   * @return 
   */
  public function index()     
  {     
    $messages = Chat::with('user')
    ->orderByDesc('created_at')
    ->take(7)
    ->get();

    $messages = array_reverse($messages->toArray());

    return response()->json($messages);
  }

   /**
     * for possible general chat
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     
    {
    //    $chat = new Chat();  
    //    $chat->text = $request->input('text');
    //    $chat->user_id = Auth::user()->id;
    //    $chat->save(); 
     
    //     broadcast(new StoreChatEvent($chat))->toOthers();
    //     //Chat::create()
    //     // $request->validate([
    //     //     'email' => 'required|email|max:255',
    //     //     'password' => 'required|string|min:6',
    //     //    ]);
    //    //return $chat->load('user');
    //     return response()->json($chat->load('user'));     
    }



}

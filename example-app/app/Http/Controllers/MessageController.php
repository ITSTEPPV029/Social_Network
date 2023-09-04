<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\StoreMessageEvent;
use Illuminate\Support\Facades\DB;
use App\Services\Message\MessageService;

class MessageController extends Controller
{
   /**
     * show of the user's last chat (when he clicks on the message)
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function messageShow()    
    {   
      $user = MessageService::messageShow();
      return view('home/message',compact('user'));
    }
    
   /**
     * 
     * @param Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function openChat(Request $request) 
    {
        return  $this->index($request);
    }

   /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
    */
    public function sendingMessage(User $user)     
    {          
        return view('home/message',compact('user'));
    }

   /**
     * receives a message from the user with whom you are currently chatting
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */  
    public function index(Request $request)     
    {     
        $messages = MessageService::index($request);
        return  $messages;
    }

   /**
     * saving and sending the message
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     
    {
      $message = MessageService::store($request); 
      return response()->json($message->load('senderUser'));
    }

   /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function getChats()     
    {       
        $user = MessageService::getChats(); 
        return $user;
    }

    /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function  indexChat(Request $request)
    {
        return Auth::user(); 
    }


  /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function  readMessageTrue(Request $request)
    {
        $user = User::find($request->input('id'));
        MessageService::readFalse($user);
    }

    /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function  getNotReadMessage()
    {
        return MessageService::getNotReadMessage();
    }
    
}

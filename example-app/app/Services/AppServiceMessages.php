<?php

namespace App\Services;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceMessages 
{
    public function getUser()
    {
        $user = User::find(Auth::user()->id);

        $messages = Message::with('senderUser')
        ->where(function ($query) use ($user) {
            $query->where('recipient_user_id',$user->id)
                  ->where('read',true);
        })->count();
       
        return  $messages = ($messages === 0) ? '' : $messages;
    }
   
}

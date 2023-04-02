<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
   /**
     * запит на дружбу
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function friendRequest(User $user)
    {
        Auth::user()->friendsOf()->attach($user->id);
        return view('home/home');
    }
    /**
     * підтвердження дружби
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function addFriend(User $user)
    {                    
        Auth::user()->friendsRequest()->where('id',$user->id)->first()->pivot->update(['friend_request'=>true]);
        return view('home/home');
    }

}

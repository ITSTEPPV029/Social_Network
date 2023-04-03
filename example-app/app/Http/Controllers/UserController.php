<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   /**
     * запит на дружбу
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    //test1
    public function friendRequest(User $user)
    {
        $User = \App\Models\User::find(Auth::user()->id);
        $User->friendsOf()->attach($user->id);
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
        $User = \App\Models\User::find(Auth::user()->id);
        $User->friendsRequest()->where('id',$user->id)->first()->pivot->update(['friend_request'=>true]);
        return view('home/home');
    }

}

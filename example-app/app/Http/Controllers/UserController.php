<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function friendRequest(User $user)
    {
        Auth::user()->friendsOf()->attach($user->id);
        return view('home/home');
    }
    public function addFriend(User $user)
    {                    
        //  Auth::user()->friendsRequest()->where('id',$user->id)->first()->syncWithPivotValues([1], ['friend_request'=>true]);
        //Auth::user()->friendsRequest()->where('id',$user->id)->first()->updateExistingPivot( ['friend_request'=>true]);
       // Auth::user()->friendsRequest()->where('id',$user->id)->first()->syncWithoutDetaching(1,['friend_request'=>true]);
        Auth::user()->friendsRequest()->where('id',$user->id)->first()->pivot->update(['friend_request'=>true]);
        return view('home/home');
    }


}

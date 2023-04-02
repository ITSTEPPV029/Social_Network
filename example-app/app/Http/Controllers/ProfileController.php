<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class ProfileController extends Controller
{
    public function show(User $user)     
    {
      // $f = [
      //   'friend_id'=>3,
      //   'user_id'=>1,
      //   'friend_request'=>1,
      // ];

      // Friend::create($f);
     // $f =Friend::all();

      return view('home.profile',compact('user'));
    }

}

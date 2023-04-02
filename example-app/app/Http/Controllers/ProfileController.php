<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class ProfileController extends Controller
{
  /**
     * сторінка користувача 
     *
     * @param  App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)     
    {
      return view('home.profile',compact('user'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

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
    return view('home.profile', compact('user'));
  }

 /**
  * 
  *
  * @param 
  * @return \Illuminate\Http\Response
  */
  public function getCheckUser(Request $request)
  {
    $userPage = User::find( $request->input('id'));
    $user = User::find(Auth::user()->id);

    $mas = [
      'checkFriendsRequest'=> $user->checkFriendsRequest($userPage),
      'checkIfFriend'=>$user->checkIfFriend($userPage),
    ];

    return  $mas;
  }

 /**
  * 
  *
  * @param 
  * @return \Illuminate\Http\Response
  */
  public function getUserPost(Request $request)
  {
    $user = User::find( $request->input('id'));
    return $user;
  }

}

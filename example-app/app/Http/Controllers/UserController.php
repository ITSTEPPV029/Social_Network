<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use vendor\Intervention\Image\Facades\Image;
use App\Services\User\UserService;

class UserController extends Controller
{

  /**
   * friend request
   *
   * @param  Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function friendRequest(Request $request)
  {
    return  response()->json(UserService::friendRequest($request));
  }

  /**
   * confirmation of friendship
   *
   * @param  \App\Models\User $user
   * @return 
   */
  public function addFriend(User $user)
  {
    UserService::addFriend($user);
    return redirect()->back();
  }

  /**
   * adding an avatar
   *
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function addAvatar(Request $request)
  {
    UserService::addAvatar($request);
    return redirect()->back();
  }

  /**
   * checking whether the user is authorized and whether his page
   *
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  // public function isLoggedIn(Request $request)
  // {
  //   return (Auth::user()->id == $request->input('id')) ? 1 : 0;
  // }

  /**
   * friends page
   *
   * @param 
   * @return \Illuminate\Http\Response
   */
  public function getFriends()
  {
    $user = \App\Models\User::find(Auth::user()->id);
    return view('home/friends', compact('user'));
  }

  /**
   * 
   *
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function pageFriendsJs(User $user)
  {
    return view('home/friends', compact('user'));
  }

  /**
   * remove friends from friends
   *
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function deleteFriend(User $user)
  {
    $User = \App\Models\User::find(Auth::user()->id);

    if ($User->checkIfFriend($user)) {
      $User->deleteFriend($user);
      return redirect()->back()->with('info', 'Видалено з друзів');
    } else
      return redirect()->back();
  }

  /**
   * remove friends from friends Js
   *
   * @param Illuminate\Http\Request;
   * @return 
   */
  public function deleteFriendVueJs(Request $request)
  {
    $user = User::find($request->input('id'));
    $User = \App\Models\User::find(Auth::user()->id);

    if ($User->checkIfFriend($user)) {
      $User->deleteFriend($user);
      return true;
    } else
      return false;
  }

  /**
   * return the number of friends
   *
   * @param Illuminate\Http\Request;
   * @return 
   */
  public function  getFriendsCount(Request $request)
  {
    $user = User::find($request->input('id'));
    return $user->friends()->count();
  }
}

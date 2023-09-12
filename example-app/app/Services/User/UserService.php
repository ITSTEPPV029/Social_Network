<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\MyPost;
use App\Models\SavePostCategory;
use App\Models\SavePost;
use Illuminate\Support\Facades\DB;

class UserService {

  /**
   * friend request
   *
   * @param \Illuminate\Http\Request
   * @return 
   */
  public static function friendRequest($request)
  {
    $user = User::find($request->input('id'));
    $User = \App\Models\User::find(Auth::user()->id);

    if ($User->checkIfFriend($user))
      return false;

    if ($User->id != $user->id)
      $User->friendsOfMine()->attach($user->id);
  
    return true;
  }

  /**
   * confirmation of friendship
   *
   * @param  \App\Models\User $user
   * @return 
   */
  public static function addFriend(User $user)
  {
    $User = \App\Models\User::find(Auth::user()->id);
    $User->friendsRequest()
    ->where('id', $user->id)
    ->first()->pivot
    ->update(['friend_request' => true]);
  }

 /**
   * adding an avatar
   *
   * @param \Illuminate\Http\Request
   * @return 
   */
  public static function addAvatar($request)
  {
    $user = \App\Models\User::find(Auth::user()->id);

    if ($user->avatar != "/storage/uploads/anonym.png")
      unlink(public_path($user->avatar));

    // if($user->avatar!="/public/storage/uploads/anonym.png")       //для хоста
    //  unlink(public_path(str_replace('/public', '', $user->avatar))); 

    $photoMainName = $request->file('avatar')->store('uploads', 'public');
    $user->avatar = "/storage/" . $photoMainName;
    // $user->avatar="public/storage/".$photoMainName;     //public для хоста
    $user->save();
    
  }


}

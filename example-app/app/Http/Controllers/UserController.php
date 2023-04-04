<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use vendor\Intervention\Image\Facades\Image;

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

  /**
     * добавлення аватарки
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addAvatar(Request $request)
    {   
          
          $fileName= $request->file('avatar');
          $user =  new User();
          $filePath = $user->getAvatarPath(Auth::user()->id);
         // Image::make($fileName)->resize(300, 200)->save(public_path($filePath.$fileName));
          
          $photoMainName = $request->file('avatar')->store('uploads','public');

      // $merch->name_main_photo = $photoMainName;

       // $request
        //$User = \App\Models\User::find(Auth::user()->id);
       // $User->friendsRequest()->where('id',$user->id)->first()->pivot->update(['friend_request'=>true]);
       // return view('home/home');
    }




}

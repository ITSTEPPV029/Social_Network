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

        if($User->checkIfFriend($user))
        {
          return redirect()->back(); 
        }  
        $User->friendsOfMine()->attach($user->id);
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
          $user = \App\Models\User::find(Auth::user()->id);
       
          if($user->avatar!="/storage/uploads/anonym.png")
            unlink(public_path($user->avatar));

          $photoMainName = $request->file('avatar')->store('uploads','public');
          $user->avatar="/storage/".$photoMainName;
          $user->save();

      // $merch->name_main_photo = $photoMainName;
  // $filePath = $user->getAvatarPath(Auth::user()->id);
         // Image::make($fileName)->resize(300, 200)->save(public_path($filePath.$fileName));
           //$fileName= $request->file('avatar');
       // $request
        //$User = \App\Models\User::find(Auth::user()->id);
       // $User->friendsRequest()->where('id',$user->id)->first()->pivot->update(['friend_request'=>true]);
        return view('home/home');

    }




}

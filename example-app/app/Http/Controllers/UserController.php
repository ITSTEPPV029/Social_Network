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

      if ($User->checkIfFriend($user))
      {
        return redirect()->back();//->with('message',"123"); 
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

      if ($user->avatar!="/storage/uploads/anonym.png")
        unlink(public_path($user->avatar));

   // if($user->avatar!="/public/storage/uploads/anonym.png")       //для хоста
   //  unlink(public_path(str_replace('/public', '', $user->avatar))); 

      $photoMainName = $request->file('avatar')->store('uploads','public');
      $user->avatar="/storage/".$photoMainName;
      // $user->avatar="public/storage/".$photoMainName;     //public для хоста
      $user->save();

      return view('home/home');
    }

     /**
     * перевірка чи користувач авторизований і чи його сторінка 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
   public function isLoggedIn(Request $request)
   {
     if (Auth::user()->id==$request->input('id'))
     {
        return 1;
     }
     return  0;
   }
 
}

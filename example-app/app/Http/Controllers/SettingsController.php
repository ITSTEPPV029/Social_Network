<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function settingsView()     
    {    
        return view('home/settings');
    }
    public function  update(Request $request)     
    {    
        $validatedData = $request->validate([
            'first_name' => 'string|regex:/^[^0-9]*$/',
            'last_name' => 'string|regex:/^[^0-9]*$/',
            'nick_name' => ['string','max:30','alpha_dash',
               Rule::unique('users')->ignore(Auth::user()->id),],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),],

            'date_of_birth'=> 'nullable|date|before_or_equal:today',
            'gender' => '',
            'city' => '',
            'about_me' => '',
        ]);

        $userModel = User::find(Auth::user()->id);
        $userModel->update($validatedData);

        $userModel = User::find(Auth::user()->id);

        return $userModel;
    }
    public function uploadAvatar(Request $request)   
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


        return $user->avatar;
    }  
    


}

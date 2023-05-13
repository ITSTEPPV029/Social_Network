<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function settingsView()     
    {    
        return view('home/settings');
    }
    public function  update(Request $request)     
    {    
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'nick_name' => 'required|string|unique:users|max:30|alpha_dash',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = $request->input('user');
        $userModel = User::find(Auth::user()->id);
        $userModel->update($user); 


        try {
            $userModel->update($user); 
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1062){
                $errors = array(
                    'nick_name' => array('This nick name has already been taken.'),
                    'email' => array('This email has already been taken.'),
                );
                return response()->json(['errors' => $errors], 422);
            }
        }








        $userModel = User::find(Auth::user()->id);

        return $userModel;
    }
   


}

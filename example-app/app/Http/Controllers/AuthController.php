<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function getSigUp()
    {
        return view('home/registration');
    }

    public function postSigUp(Request $request)  
    {        
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'nick_name' => 'required|string|unique:users|max:30|alpha_dash',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
           ]);
          
           $data['password']= bcrypt($data['password']); 
           User::create($data);

           if(!Auth::attempt($request->only(['email','password']),$request->has('remember')))
           {
               return redirect()->back(); 
           }
           return view('home/home');
    } 
    
    public function getSigin()
    {
        return view('home/login');
    }

    public function postSigin(Request $request)  
    {        
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
           ]);
     
           if(!Auth::attempt($request->only(['email','password']),$request->has('remember')))
           {
               return redirect()->back(); 
           }

           return view('home/home');
    } 
    
    public function getSigout()
    {
        Auth::logout();
        return view('home/home');
    }

 
}

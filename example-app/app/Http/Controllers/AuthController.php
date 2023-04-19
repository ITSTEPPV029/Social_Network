<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
       /**
     * сторінка 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function getSigUp()
    {
        return view('home/registration');
    }

   /**
     * добавлення користувача в базу та авторизація 
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

           $user= Auth::user();
           return redirect()->route('profile.show',compact('user')); 
          
    } 
      /**
     * сторінка авторизації
     *
     * @param  
     * @return \Illuminate\Http\Response
     */

    public function getSigin()
    {
        return view('home/login');
    }

   /**
     * авторизація 
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postSigin(Request $request)  
    {        
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
           ]);
     
           if(!Auth::attempt($request->only(['email','password']),$request->has('remember')))
           {
               //return redirect()->back(); 
               return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Неправильна електронна адреса або пароль',]); 
           }
           $user=  Auth::user();
           return redirect()->route('profile.show',compact('user')); 
    } 

     /**
     *  головна сторінка
     *
     * @param 
     * @return 
     */
    public function getSigout()
    {
        Auth::logout();
        return view('home/home');
    }

 
}

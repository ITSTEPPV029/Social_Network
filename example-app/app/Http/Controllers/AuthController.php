<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\AuthService; 

class AuthController extends Controller
{
    /**
     * registration
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSigUp(RegistrationRequest $request)
    { 
        $data = $request->validated();
        AuthService::postSigUp($data,$request);

        return redirect()->route('profile.show', ['user' => Auth::user()]);
    }

    /**
     * authorization
     *
     * @param  Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function postSigin(AuthRequest $request)
    {
        $request->validated();

        if (AuthService::postSigin($request))
         return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Неправильна електронна адреса або пароль',]); 

        return redirect()->route('profile.show',['user' => Auth::user()]); 
    }

    /**
     * authorization page
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function getSigin()
    {
        return view('home/login');
    }

    /**
     *  home page
     *
     * @param 
     * @return 
     */
    public function getSigout()
    {
        Auth::logout();
        return view('home/home');
    }

   /**
     * registration page
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function getSigUp()
    {
        return view('home/registration');
    }
  
}

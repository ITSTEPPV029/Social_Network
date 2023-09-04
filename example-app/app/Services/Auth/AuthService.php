<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService 
{   
    /**
     *  registration
     *
     * @param 
     * @return 
     */
    public static function postSigUp($data,$request)
    {
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back();
        }
        
       return $data;
    }

    /**
     *  authorization
     *
     * @param 
     * @return 
     */
   public static function  postSigin($request)
    {
        if (!Auth::attempt($request->only(['email','password']),$request->has('remember')))
        return true;
        
       return false;
    }
   
   
}

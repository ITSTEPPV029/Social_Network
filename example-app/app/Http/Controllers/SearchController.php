<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * пошук користувача по імені та ніку
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)     
    {
       $userName = $request->input('search');
       $users= User::where(DB::raw("CONCAT (first_name,' ', last_name)"),'LIKE',"%{$userName}%")
       ->orWhere('nick_name','LIKE',"%{$userName}%")->get();
             if($users==null)
             {
                 abort(404);
             }
      return view('home.usersFound',compact('users'));    
    }
    
      /**
     * вивід всіх користувачів  з фільтраціює (виводим не друзів )
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function allUser()     
    {
      $users= User::all();
     
      if(Auth::check())  
      {
        $user = User::find(Auth::user()->id);
        $users = $users->filter(function($value) use ($user) {
          return !$user->checkIfFriend($value);
         });  
      }
     
      return view('home.usersFound',compact('users'));  
    }

}

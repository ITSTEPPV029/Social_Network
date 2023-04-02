<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
class SearchController extends Controller
{
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
    
    public function allUser()     
    {
      
       $users= User::all();
      return view('home.usersFound',compact('users'));
        
    }

}

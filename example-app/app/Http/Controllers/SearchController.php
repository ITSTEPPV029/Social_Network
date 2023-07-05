<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\MyPost;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Filters\UserFilter;
use Illuminate\Validation\Rule;

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

      if($users==null){
        abort(404);
      }
      
      return view('home.usersFound',compact('users'));    
    }

     /**
     * пошук користувача по імені
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function filterUser(Request $request)     
    {
      $data = $request->validate([
        'name' => '',
        'nick_name' => '',
        'date_of_birth'=> '',
        'gender' => '',
        'city' => '',
        'agePet' => '',
        'genderPet' => '',
        'kindPet' => '',
       ]);

      $filter = app()->make(UserFilter::class,['queryParams'=>array_filter($data)]);

      $users = User::filter($filter)->get();
      return $users;    
    }

    /**
     * вивід всіх користувачів  з фільтраціює (вивідом не друзів)
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function allUser()     
    {
      $users= User::orderByDesc('id')->take(20)->get();

      // $user = User::find(Auth::user()->id);
      // $users = $users->filter(function($value) use ($user) {
      //   return !$user->checkIfFriend($value);
      //  });  
       
      return view('home.usersFound',compact('users'));  
    }

   /**
     * вивід користувачів які входять в радіус пошуку 
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function getUsersMap(Request $request)     
    {
         $centerLat = Auth::user()->latitude;//. 50.742864;
         $centerLng = Auth::user()->longitude;//25.331121;
         $radius = 50000;//радіус пошуку користувачів

            $users = DB::table('users')
            ->select('*')
            ->selectRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) AS distance', [$centerLat, $centerLat, $centerLng])
            ->whereRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) <= ?', [$centerLat, $centerLat, $centerLng, $radius])
            ->get();

        return $users;//response()->json($chat->load('user'));
    }
}

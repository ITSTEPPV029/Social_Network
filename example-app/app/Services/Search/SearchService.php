<?php

namespace App\Services\Search;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\MyPost;
use App\Models\SavePostCategory;
use App\Models\SavePost;
use Illuminate\Support\Facades\DB;

class SearchService{

 /**
     * user search by name and nickname
     *
     * @param  Illuminate\Http\Request
     * @return 
     */
    public static function searchUser($request)     
    {
       $userName = $request->input('search');
       $users= User::where(DB::raw("CONCAT (first_name,' ', last_name)"),'LIKE',"%{$userName}%")
       ->orWhere('nick_name','LIKE',"%{$userName}%")
       ->get();

       return $users;
    }

     /**
     * output of users included in the search radius 
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public static function getUsersMap()     
    {
         $centerLat = Auth::user()->latitude;//. 50.742864;
         $centerLng = Auth::user()->longitude;//25.331121;
         $radius = 50000;//радіус пошуку користувачів

            $users = User::select('*')
            ->selectRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) AS distance', [$centerLat, $centerLat, $centerLng])
            ->whereRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) <= ?', [$centerLat, $centerLat, $centerLng, $radius])
            ->get();

        return $users;
    }

}
<?php

namespace App\Services\Map; 

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class MapService 
{   
    /**
     *  saving the user's coordinates on the map
     *
     * @param \Illuminate\Http\Request  $request
     * @return App\Models\User
     */
    public static function store($request)
    {
        User::where('id', Auth::user()->id)->update([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),]);
    
        $centerLat = 50.742864;
        $centerLng = 25.331121;
        $radius = 150000;
    
        $users = DB::table('users')
        ->select('*')
        ->selectRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) AS distance', [$centerLat, $centerLat, $centerLng])
        ->whereRaw('(6371000 * 2 * ASIN(SQRT(POWER(SIN(RADIANS(latitude - ?) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN(RADIANS(longitude - ?) / 2), 2)))) <= ?', [$centerLat, $centerLat, $centerLng, $radius])
        ->get();

         return  $users;
         
    }


   
}

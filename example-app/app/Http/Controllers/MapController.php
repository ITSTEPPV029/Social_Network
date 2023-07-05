<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
   /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function mapView()     
    {    
        return view('home/map');
    }

   /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     
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

        return $users;
    }
}

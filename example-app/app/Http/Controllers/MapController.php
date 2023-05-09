<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MapController extends Controller
{
    public function mapView()     
    {    
        return view('home/map');
    }

    public function store(Request $request)     
    {
       //$request->input('text');
        // Отримуємо координати точки центру та радіус
        $centerLat = 50;
        $centerLng = 25;
        $radius = 5; // Радіус в метрах

        // Виконуємо запит до бази даних на вибір користувачів в заданому радіусі
        $users = DB::table('users')
    ->select('*')
    ->selectRaw('( 6371000 * acos( cos( radians(?) ) *
                cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?)
                ) + sin( radians(?) ) *
                sin( radians( latitude ) ) )
                ) AS distance', [$centerLat, $centerLng, $centerLat])
    ->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [$centerLng, $centerLat, $radius])
    ->get();


        return $users;//response()->json($chat->load('user'));
    
    }
}

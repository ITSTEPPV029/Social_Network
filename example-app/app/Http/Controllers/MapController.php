<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Map\MapService;

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
     * saving the user's coordinates on the map
     *
     * @param \Illuminate\Http\Request 
     * @return App\Models\User
     */
    public function store(Request $request)     
    {
        $users = MapService::store($request);
    
        return $users;
    }
}

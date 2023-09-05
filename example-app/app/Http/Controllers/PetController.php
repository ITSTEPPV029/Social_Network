<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use  App\Services\Pet\PetService;

class PetController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = User::find($request->input('id'));
      return  $user->pets; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  
     * @return  App\Models\Pet;
     */
    public function store(Request $request)
    {
        return PetService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit() 
    {
       
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request 
     * @return App\Models\Pet;
     */
    public function update(Request $request)
    {
        return PetService::update($request);
    }

    /**
     * 
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return PetService::destroy($request);
    }

}

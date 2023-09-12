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
     * @param  \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = User::find($request->input('id'));
      return  response()->json($user->pets); 
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
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(PetService::store($request));
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return  response()->json(PetService::update($request));
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return  response()->json(PetService::destroy($request));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $user->pets->get();
        //$pets = Pet::where('user_id', $request->input('id'))->get();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $pet = new Pet();
         $avatar = $request->file('file');
         $photoName = $avatar->store('uploads', 'public');

    //   $pet->avatar = "/public/storage/" . $photoMainName; для сервера 
         $pet->avatar = "/storage/" . $photoName;
         $pet->name = $request->input('name');
         $pet->kind_of = $request->input('kindOfPet');
         $pet->gender = $request->input('genderPet');
         $pet->age = $request->input('agePet');
         $pet->about = $request->input('aboutPet');
         $pet->user_id = Auth::user()->id;
      
         $pet->save();

        $user = User::find(Auth::user()->id);
        return  $user->pets; 

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $petId = $request->input('id');
        $petData = $request->except('_token', '_method', 'id');
        
        $pet = Pet::find($petId);
        $pet->update($petData);
    
        if($request->file('file'))
        {
            $avatar = $request->file('file');
            $photoName = $avatar->store('uploads', 'public');
            $pet->avatar = "/storage/" . $photoName;
            // $pet->avatar = "/public/storage/" . $photoMainName; для сервера 
            $pet->save();
        }
    
        $user = User::find(Auth::user()->id);
        return $user->pets; 
    }

    /**
     * 
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $pet = Pet::find($request->input('id'));
        $pet->delete();

        $user = User::find( Auth::user()->id );
        return  $user->pets; 

    }

}

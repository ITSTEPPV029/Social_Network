<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::all();
        foreach ($pets as $pet) {
            echo 'Name pet: ' . $pet->name;
            echo '<br>';
            echo 'User ID: ' . $pet->user_id;
            echo '<br>';
            echo '-------------------------------';
            echo '<br>';
        }
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
        $pet->name = $request->input('name');
        $pet->user_id = Auth::user()->id;
        $avatar = $request->file('avatar');
        if ($avatar !== null) {
            $photoMainName = $avatar->store('uploads', 'public');
            $pet->avatar = "/storage/" . $photoMainName;
        } else
            $pet->avatar = "/storage/uploads/anonym.png";

        $pet->save();

        dd('Успішно збережено! ' . $pet);
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
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }

    public function add()
    {
        return view('home.addPets');
    }
}

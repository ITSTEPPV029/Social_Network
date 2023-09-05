<?php

namespace App\Services\Pet;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\MyPost;
use App\Models\Pet;

class PetService {

/**
* 
*
* @param  \Illuminate\Http\Request  
* @return  App\Models\Pet;
*/
public static function store($request)
{  
    $pet = new Pet();
    $avatar = $request->file('file');
    $photoName = $avatar->store('uploads', 'public');

    //$pet->avatar = "/public/storage/" . $photoName; для сервера 
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
  * 
  *
  * @param  \Illuminate\Http\Request 
  * @return  App\Models\Pet;
  */
    public static function update($request)
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
           // $pet->avatar = "/public/storage/" . $photoName; // для сервера 
            $pet->save();
        }
    
        $user = User::find(Auth::user()->id);
        return $user->pets; 
    }

   /**
     * 
     *
     * @param  \Illuminate\Http\Request 
     * @return  App\Models\Pet;
     */
    public  static  function destroy($request)
    {
        $pet = Pet::find($request->input('id'));
        $pet->delete();

        $user = User::find( Auth::user()->id );
        return  $user->pets; 
    }

}
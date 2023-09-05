<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller
{
    /**
     * 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function settingsView()
    {
        return view('home/settings');
    }

    /**
     * 
     *
     * @param App\Http\Requests\SettingsRequest;
     * @return App\Models\User;
     */
    public function  update(SettingsRequest $request)
    {
        $validatedData = $request->validated();

        $userModel = User::find(Auth::user()->id);
        $userModel->update($validatedData);

        return $userModel;
    }

    /**
     * 
     *
     * @param Illuminate\Http\Request;
     * @return App\Models\User;
     */
    public function uploadAvatar(Request $request)
    {
        $user = \App\Models\User::find(Auth::user()->id);

        if ($user->avatar != "/storage/uploads/anonym.png")
            unlink(public_path($user->avatar));

        // if($user->avatar!="/public/storage/uploads/anonym.png")       //для хоста
        //  unlink(public_path(str_replace('/public', '', $user->avatar))); 

        $photoMainName = $request->file('avatar')->store('uploads', 'public');
        $user->avatar = "/storage/" . $photoMainName;
        // $user->avatar="public/storage/".$photoMainName;     //public для хоста

        $user->save();
        return $user->avatar;
    }
}

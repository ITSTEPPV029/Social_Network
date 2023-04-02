<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home/home');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('registration/','getSigUp')->middleware('guest')->name('registration.getSigUp');
    Route::post('registration/','postSigUp')->middleware('guest')->name('registration.postSigUp');
    Route::get('login/','getSigin')->middleware('guest')->name('login.getSigin');
    Route::post('login/','postSigin')->middleware('guest')->name('login.postSigin');
    Route::get('logout/','getSigout')->name('logout.getSigout');
  
  });
  
  Route::get('search/','App\Http\Controllers\SearchController@searchUser')->name('search.searchUser');
  Route::get('profile/{user}/','App\Http\Controllers\ProfileController@show')->name('profile.show');
  Route::get('allUser/','App\Http\Controllers\SearchController@allUser')->name('allUser.allUser');

  Route::get('friendRequest/{user}','App\Http\Controllers\UserController@friendRequest')->name('friendRequest.friendRequest');
  Route::get('addFriend/{user}','App\Http\Controllers\UserController@addFriend')->name('addFriend.addFriend');

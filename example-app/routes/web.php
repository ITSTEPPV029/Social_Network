<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyPostController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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
Route::view('home/home', 'home')->name('home.home');

//Route::controller(AuthController::class)->group(function () {
    Route::get('registration/','AuthController@getSigUp')->middleware('guest')->name('registration.getSigUp');
    Route::post('registration/','AuthController@postSigUp')->middleware('guest')->name('registration.postSigUp');
    Route::get('login/','AuthController@getSigin')->middleware('guest')->name('login.getSigin');
    Route::post('login/','AuthController@postSigin')->middleware('guest')->name('login.postSigin');
    Route::get('logout/','AuthController@getSigout')->name('logout.getSigout');
  //});

  Route::post('avatar/add','UserController@addAvatar')->name('avatar.addAvatar');
  Route::get('search/','App\Http\Controllers\SearchController@searchUser')->name('search.searchUser');
  Route::get('profile/{user}/','ProfileController@show')->name('profile.show');
  Route::get('allUser/','SearchController@allUser')->name('allUser.allUser');
  Route::get('friendRequest/{user}','App\Http\Controllers\UserController@friendRequest')->name('friendRequest.friendRequest');
  Route::get('addFriend/{user}','App\Http\Controllers\UserController@addFriend')->name('addFriend.addFriend');

  Route::post('store/','MyPostController@store')->name('store');
  Route::get('index/','MyPostController@index')->name('index');

        // Route::group(['prefix' => 'store'], function(){

        //     Route::post('/', 'MyPostController@store')->name('store');

        // });

        // Route::group([ 'prefix' => 'store'], function () {

        //     Route::post('/', [MyPostController::class, 'store']);
        
        // });
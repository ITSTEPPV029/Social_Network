<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Http\Controllers\AccessTokenController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('index','MyPostController@index')->middleware('auth:api')->name('index');
Route::post('store','MyPostController@store')->middleware('auth:api')->name('store');
Route::post('deletePost','MyPostController@delete')->middleware('auth:api')->name('deletePost');
Route::post('isLoggedIn', 'UserController@isLoggedIn')->middleware('auth:api')->name('isLoggedIn');

Route::post('like','MyPostController@like')->middleware('auth:api')->name('like');


Route::get('test',function () {
    return  Auth::user()->id;
})->middleware('auth:api');

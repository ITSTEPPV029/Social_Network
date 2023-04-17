<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('index','MyPostController@index')->name('index');
Route::post('store','MyPostController@store')->name('store');

Route::post('deletePost','MyPostController@delete')->name('deletePost');
Route::post('isLoggedIn','UserController@isLoggedIn')->name('isLoggedIn');

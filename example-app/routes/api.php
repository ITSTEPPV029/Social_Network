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

Route::post('index','MyPostController@index')->middleware('auth:api')->name('index');
Route::post('store','MyPostController@store')->middleware('auth:api')->name('store');
Route::post('deletePost','MyPostController@delete')->middleware('auth:api')->name('deletePost');
Route::post('isLoggedIn', 'UserController@isLoggedIn')->middleware('auth:api')->name('isLoggedIn');

Route::post('like','MyPostController@like')->middleware('auth:api')->name('like');

Route::post('chat/','ChatController@store')->middleware('auth:api');
Route::get('chat/','ChatController@index')->middleware('auth:api');

Route::post('message/store','MessageController@store')->middleware('auth:api');
Route::post('message/index','MessageController@index')->middleware('auth:api');
Route::post('message/indexChat','MessageController@indexChat')->middleware('auth:api');
Route::get('message/getChats','MessageController@getChats')->middleware('auth:api');

// Route::post('test',function (Request $request) {
//     return  $request->input('id');
// })->middleware('auth:api');

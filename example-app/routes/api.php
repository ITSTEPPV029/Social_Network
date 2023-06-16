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
Route::post('isLiked','MyPostController@isLiked')->middleware('auth:api');

Route::post('chat/','ChatController@store')->middleware('auth:api');
Route::get('chat/','ChatController@index')->middleware('auth:api');

Route::post('message/store','MessageController@store')->middleware('auth:api');
Route::post('message/index','MessageController@index')->middleware('auth:api');
Route::post('message/indexChat','MessageController@indexChat')->middleware('auth:api');
Route::get('message/getChats','MessageController@getChats')->middleware('auth:api');
Route::post('message/openChat','MessageController@openChat')->middleware('auth:api');
Route::post('message/readMessageTrue','MessageController@readMessageTrue')->middleware('auth:api');
Route::post('message/getNotReadMessage','MessageController@getNotReadMessage')->middleware('auth:api');

Route::post('comment/store','CommentController@store')->middleware('auth:api');

Route::post('map/store','MapController@store')->middleware('auth:api');

Route::post('settings','SettingsController@update')->middleware('auth:api');
Route::post('upload-avatar','SettingsController@uploadAvatar')->middleware('auth:api');

Route::post('filter', 'SearchController@filterUser')->middleware('auth:api');

Route::post('PetStore', 'PetController@store')->middleware('auth:api');
Route::post('getPets', 'PetController@index')->middleware('auth:api');
Route::post('PetUpdate', 'PetController@update')->middleware('auth:api');
Route::post('deletePets', 'PetController@destroy')->middleware('auth:api');

Route::post('getCheckUser', 'ProfileController@getCheckUser')->middleware('auth:api');

Route::post('friendRequest', 'UserController@friendRequest')->middleware('auth:api');
Route::post('deleteFriendVueJs', 'UserController@deleteFriendVueJs')->middleware('auth:api');
Route::post('deleteFriendVueJs', 'UserController@deleteFriendVueJs')->middleware('auth:api');

Route::post('getPosts', 'NewsController@getPost')->middleware('auth:api');

Route::post('addCategory', 'SavePostController@addCategory')->middleware('auth:api');
Route::post('getCategories', 'SavePostController@getCategories')->middleware('auth:api');
Route::post('savePostToCategory', 'SavePostController@savePostToCategory')->middleware('auth:api');
Route::post('savePostGetCategory', 'SavePostController@savePostGetCategory')->middleware('auth:api');


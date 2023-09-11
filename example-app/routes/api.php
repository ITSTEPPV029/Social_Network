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

Route::controller(MyPostController::class)->middleware('auth:api')->group(function () {
    Route::post('index','index')->name('index');
    Route::post('store','store')->name('store');
    Route::post('deletePost','delete')->name('deletePost');
    Route::post('isLoggedIn', 'isLoggedIn')->name('isLoggedIn');
    Route::post('like','like')->name('like');
    Route::post('isLiked','isLiked');
    Route::post('sharePost','sharePost');
    Route::post('sharePostGetUser','sharePostGetUser');
});

Route::controller(ChatController::class)->middleware('auth:api')->group(function () {
    Route::post('chat/','store');
    Route::get('chat/','index');
});

Route::controller(ChatController::class)->middleware('auth:api')->group(function () {
    Route::post('chat/','store');
    Route::get('chat/','index');
});

Route::controller(MessageController::class)->middleware('auth:api')->group(function () {
    Route::post('message/store','store');
    Route::post('message/index','index');
    Route::post('message/indexChat','indexChat');
    Route::get('message/getChats','getChats');
    Route::post('message/openChat','openChat');
    Route::post('message/readMessageTrue','readMessageTrue');
    Route::post('message/getNotReadMessage','getNotReadMessage');
});

Route::controller(SettingsController::class)->middleware('auth:api')->group(function () {
    Route::post('settings','update');
    Route::post('upload-avatar','uploadAvatar');  
});

Route::controller(PetController::class)->middleware('auth:api')->group(function () {
    Route::post('PetStore', 'store');
    Route::post('getPets', 'index');
    Route::post('PetUpdate', 'update');
    Route::post('deletePets', 'destroy');
});

Route::controller(ProfileController::class)->middleware('auth:api')->group(function () {
    Route::post('getCheckUser', 'getCheckUser');
    Route::post('getUserPost', 'getUserPost');
});

Route::controller(UserController::class)->middleware('auth:api')->group(function () {
    Route::post('friendRequest', 'friendRequest');
    Route::post('deleteFriendVueJs', 'deleteFriendVueJs');
    Route::post('deleteFriendVueJs', 'deleteFriendVueJs');
    Route::post('getFriendsCount', 'getFriendsCount');
});

Route::controller(SavePostController::class)->middleware('auth:api')->group(function () {
    Route::post('addCategory', 'addCategory');
    Route::post('getCategories', 'getCategories');
    Route::post('savePostToCategory', 'savePostToCategory');
    Route::post('savePostGetCategory', 'savePostGetCategory');
});

Route::controller(SearchController::class)->middleware('auth:api')->group(function () {
    Route::post('getUsersMap', 'getUsersMap');
    Route::post('filter', 'filterUser');
});

Route::post('comment/store','CommentController@store')->middleware('auth:api');
Route::post('map/store','MapController@store')->middleware('auth:api');
Route::post('getPosts', 'NewsController@getPost')->middleware('auth:api');



<?php

use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('registration/', 'getSigUp')->name('registration.getSigUp');
    Route::post('registration/', 'postSigUp')->name('registration.postSigUp');
    Route::get('login/', 'getSigin')->name('login.getSigin');
    Route::post('login/', 'postSigin')->name('login.postSigin');
    Route::get('logout/', 'getSigout')->name('logout.getSigout');
    Route::get('forgot/', 'forgotPassword')->name('forgot.password');

});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::post('avatar/add', 'addAvatar')->name('avatar.addAvatar');
    Route::get('friendRequest/{user}', 'friendRequest')->name('friendRequest.friendRequest');
    Route::get('addFriend/{user}', 'addFriend')->name('addFriend.addFriend');
    Route::get('friends', 'getFriends')->name('friends');
    Route::get('pageFriends/{user}', 'pageFriendsJs');
    Route::get('deleteFriend/{user}', 'deleteFriend')->name('deleteFriend');
});

Route::controller(SearchController::class)->middleware('auth')->group(function () {
    Route::get('search/', 'searchUser')->name('search.searchUser');
    Route::get('allUser/', 'allUser')->name('allUser.allUser');
    Route::get('filter/', 'filterUser')->name('filterUser');
});


Route::controller(PetController::class)->group(function () {
    Route::get('/allpets', 'index');
    Route::get('/addPets', 'add')->name('addPet');
    Route::post('pet/add', 'store')->name('savePet');
});


Route::get('profile/{user}/', 'ProfileController@show')->name('profile.show');
Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::get('chat/', 'ChatController@chatView')->middleware('auth')->name('chat');
Route::get('message/','MessageController@messageShow')->middleware('auth')->name('message');
Route::get('sendingMessage/{user}/','MessageController@sendingMessage')->middleware('auth')->name('sendingMessage');
Route::get('/admin', 'AdminController@index');
Route::get('/map', 'MapController@mapView')->middleware('auth')->name('map');
Route::get('/settings', 'SettingsController@settingsView')->middleware('auth')->name('settings');
Route::get('news', 'NewsController@index')->middleware('auth')->name('news');
Route::get('savedPosts', 'SavePostController@savedPosts')->middleware('auth')->name('savedPosts');

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

Route::get('registration/', 'AuthController@getSigUp')->middleware('guest')->name('registration.getSigUp');
Route::post('registration/', 'AuthController@postSigUp')->middleware('guest')->name('registration.postSigUp');
Route::get('login/', 'AuthController@getSigin')->middleware('guest')->name('login.getSigin');
Route::post('login/', 'AuthController@postSigin')->middleware('guest')->name('login.postSigin');
Route::get('logout/', 'AuthController@getSigout')->name('logout.getSigout');

Route::post('avatar/add', 'UserController@addAvatar')->middleware('auth')->name('avatar.addAvatar');
Route::get('friendRequest/{user}', 'UserController@friendRequest')->middleware('auth')->name('friendRequest.friendRequest');
Route::get('addFriend/{user}', 'UserController@addFriend')->middleware('auth')->name('addFriend.addFriend');
Route::get('friends', 'UserController@getFriends')->middleware('auth')->name('friends');
Route::get('pageFriends/{user}', 'UserController@pageFriendsJs')->middleware('auth');
Route::get('deleteFriend/{user}', 'UserController@deleteFriend')->middleware('auth')->name('deleteFriend');

Route::get('search/', 'SearchController@searchUser')->middleware('auth')->name('search.searchUser');
Route::get('allUser/', 'SearchController@allUser')->middleware('auth')->name('allUser.allUser');
Route::get('filter/', 'SearchController@filterUser')->middleware('auth')->name('filterUser');

Route::get('profile/{user}/', 'ProfileController@show')->middleware('auth')->name('profile.show');
//Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::get('chat/', 'ChatController@chatView')->middleware('auth')->name('chat');

//виведення всіх тварин
Route::get('/allpets', 'PetController@index');
//додавання тваринок
Route::get('/addPets', 'PetController@add')->name('addPet');
Route::post('pet/add', 'PetController@store')->name('savePet');

Route::get('message/','MessageController@messageShow')->middleware('auth')->name('message');
//добавив age/{us  було age{us 
Route::get('sendingMessage/{user}/','MessageController@sendingMessage')->middleware('auth')->name('sendingMessage');


Route::get('/admin', 'AdminController@index');

Route::get('/map', 'MapController@mapView')->middleware('auth')->name('map');

Route::get('/settings', 'SettingsController@settingsView')->middleware('auth')->name('settings');

Route::get('forgot/', 'AuthController@forgotPassword')->name('forgot.password');
Route::get('news', 'NewsController@index')->middleware('auth')->name('news');
Route::get('savedPosts', 'SavePostController@savedPosts')->middleware('auth')->name('savedPosts');

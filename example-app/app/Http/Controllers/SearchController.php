<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\MyPost;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Filters\UserFilter;
use Illuminate\Validation\Rule;
use App\Http\Requests\SearchRequest;
use App\Services\Search\SearchService;

class SearchController extends Controller
{
    /**
     * user search by name and nickname
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)     
    {
      $users = SearchService::searchUser($request);

      return view('home.usersFound',compact('users'));    
    }

     /**
     * user search 
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function filterUser(SearchRequest $request)     
    {
      $data = $request->validated();

      $filter = app()->make(UserFilter::class,['queryParams'=>array_filter($data)]);

      return User::filter($filter)->get();  
    }

    /**
     * output of all users with filtering (output of no friends)
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function allUser()     
    {
      $users= User::orderByDesc('id')->take(20)->get();
 
      return view('home.usersFound',compact('users'));  
    }

   /**
     * output of users included in the search radius 
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function getUsersMap()     
    {
        return SearchService::getUsersMap();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\MyPost;
use App\Http\Requests\MyPostRequest;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Services\MyPost\MyPostService;

class MyPostController extends Controller
{
  /**
   * post create 
   *
   * @param  Illuminate\Http\Request
   * @return App\Models\MyPost
   */
  public function store(MyPostRequest $request)
  {
    return MyPostService::store($request);
  }

  /**
   * get all posts
   *
   * @param Illuminate\Http\Request
   * @return App\Models\MyPost
   */
  public function index(Request $request)
  {
    return MyPostService::index($request);
  }

  /**
   * like the post 
   *
   * @param Illuminate\Http\Request
   * @return 
   */
  public function like(Request $request)
  {
    MyPostService::like($request);
  }

  /**
   * checking whether the post has already been liked
   *
   * @param Illuminate\Http\Request
   * @return 
   */
  public function isLiked(Request $request)
  {
    return MyPostService::isLiked($request);
  }

  /**
   * delete post
   *
   * @param Illuminate\Http\Request
   * @return App\Models\MyPost
   */
  public function delete(Request $request)
  {
    return MyPostService::delete($request);
  }

  /**
   * share the post
   *
   * @param Illuminate\Http\Request
   * @return App\Models\MyPost
   */
  public function sharePost(Request $request)
  {
    return MyPostService::sharePost($request);
  }
  
  /**
   * 
   * @param Illuminate\Http\Request
   * @return App\Models\User;
   */
  public function sharePostGetUser(Request $request)
  {
    return User::find($request->input('idUser'));
  }
}

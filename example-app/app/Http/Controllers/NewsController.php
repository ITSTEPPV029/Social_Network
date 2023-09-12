<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyPost;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\News\NewsService;

class NewsController extends Controller
{
    /**
     * @param Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.news');
    }

    /**
     * returning random posts from friends
     * if there are none, then we simply return random posts
     * 
     * @param Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function getPost(Request $request)
    {
       return  response()->json(NewsService::getPost($request));
    }
}

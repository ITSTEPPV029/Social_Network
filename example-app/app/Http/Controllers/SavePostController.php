<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavePostCategory;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\SavePost;
use App\Services\SavePost\SavePostService;

class SavePostController extends Controller
{
    /**
     * 
     * @param \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // return $request;
    }

    /**
     * 
     * @param \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function  addCategory(Request $request)
    {
        return  response()->json(SavePostService::addCategory($request));
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
       return  response()->json(SavePostCategory::where('user_id', Auth::user()->id)->get());
    }

    /**
     * 
     * @param \Illuminate\Http\Request 
     * @return 
     */
    public function savePostToCategory(Request $request)
    {
        SavePostService::savePostToCategory($request);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function savedPosts()
    {
        return view('home.savedPosts');
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function savePostGetCategory()
    {
        return  response()->json(SavePostCategory::with('savePost.myPost')->where('user_id', Auth::user()->id)->get());
    }
}

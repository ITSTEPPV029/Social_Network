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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return  $request;
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function  addCategory(Request $request)
    {
        return SavePostService::addCategory($request);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
       return SavePostCategory::where('user_id', Auth::user()->id)->get();
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function savePostToCategory(Request $request)
    {
        return SavePostService::savePostToCategory($request);
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
        return  SavePostCategory::with('savePost.myPost')->where('user_id', Auth::user()->id)->get();
    }
}

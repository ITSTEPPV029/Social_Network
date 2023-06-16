<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavePostCategory;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\SavePost;

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
        $category = new SavePostCategory();
        $category->text=$request->input('category');
        $category->user_id=Auth::user()->id;
        $category->my_post_id=$request->input('postId');
        $category->save();
    
        return SavePostCategory::where('user_id', Auth::user()->id)->get();      
    }
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function   getCategories()
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
        $savePost = new SavePost();
     
        $savePost->category_id= $request->input('category');
        $savePost->my_post_id= $request->input('postId');
        $savePost->user_id= Auth::user()->id;
        $savePost->save();

        return $request;      
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

       // return  SavePost::with('user','savePostCategory','myPost')->get();


    }
    

}

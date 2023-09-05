<?php

namespace App\Services\SavePost;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\MyPost;
use App\Models\SavePostCategory;
use App\Models\SavePost;

class SavePostService{

   /**
     * 
     * @param \Illuminate\Http\Request  
     * @return 
     */
    public static function  addCategory($request)
    {
        $category = new SavePostCategory();
        $category->text = $request->input('category');
        $category->user_id = Auth::user()->id;
        $category->save();

        return SavePostCategory::where('user_id', Auth::user()->id)->get();
    }

   /**
     * 
     * @param \Illuminate\Http\Request  
     * @return 
     */
    public static function savePostToCategory($request)
    {
        $savePost = new SavePost();

        $savePost->category_id = $request->input('category');
        $savePost->my_post_id = $request->input('postId');
        $savePost->user_id = Auth::user()->id;
        $savePost->save();

        return $request;
    }
}


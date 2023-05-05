<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyPost;
use App\Models\Comment;

class AdminController extends Controller
{
  /**
   * тест адмін
   *
   * @param  
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //$post = MyPost::with('comments.user')->get();

    
    //dd($post);
    $comment = new Comment();
    $comment->user_id=2;
    $comment->text="123";
    $comment->my_post_id=2;
    $comment->save();

    dd($comment);

   // return view('home.profile', compact('user'));
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * створення коментаря
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $comment = new Comment();
         $comment->user_id=Auth::user()->id;
         $comment->text=$request->input('comment');
         $comment->my_post_id=$request->input('idPost');
         $comment->save();

         $comment = Comment::find($comment->id); 
        return  $comment->load('user');
    }
}

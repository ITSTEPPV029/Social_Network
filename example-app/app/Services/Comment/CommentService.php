<?php

namespace App\Services\Comment;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentService 
{   
    /**
     *  
     *
     * @param \Illuminate\Http\Request  
     * @return App\Models\Comment;
     */
    public static function store($request)
    {
        // return Comment::create([
        //     'user_id' => Auth::user()->id,
        //     'text' => $request->input('comment'),
        //     'my_post_id' => $request->input('idPost'),
        // ]);

        $comment = new Comment();
        $comment->user_id=Auth::user()->id;
        $comment->text=$request->input('comment');
        $comment->my_post_id=$request->input('idPost');
        $comment->save();
        return $comment = Comment::find($comment->id);      
    }


   
}

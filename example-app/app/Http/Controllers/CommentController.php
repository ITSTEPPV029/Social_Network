<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Services\Comment\CommentService;

class CommentController extends Controller
{
    /**
     * creating a comment
     *
     * @param  \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = CommentService::store($request);
        return  $comment->load('user');
    }
}

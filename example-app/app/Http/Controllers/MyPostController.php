<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\MyPost;
use App\Http\Requests\MyPostRequest;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class MyPostController extends Controller
{
  /**
     * створення поста
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyPostRequest $request)     
    {
        $MyPost= new MyPost();
        if($request->file('file'))
        {
          $photoName = $request->file('file')->store('uploads','public');
          $MyPost->photo="/storage/".$photoName;
        }
         $MyPost->text=$request->input('text');
         $MyPost->user_id=Auth::user()->id;
         $MyPost->save();

          //$MyPost= MyPost::orderBy('id', 'desc')->get();
         // return $MyPost;
       return $this->index();
    }
/**
     * отримання всіх постів  
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    { 
        $MyPost= MyPost::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return $MyPost;
    }    
/**
     * ставимо лайк на пост 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request) 
    {  
      if(!Like::where('my_post_id', $request->input('id'))->where('user_id', Auth::user()->id)->first())
      {
        Like::create([
          'my_post_id' => $request->input('id'),
          'user_id' => Auth::user()->id,
        ]);
        MyPost::where('id', $request->input('id'))->increment('like');
      }
      else
      {
        Like::where('my_post_id', $request->input('id'))
        ->where('user_id', Auth::user()->id)->delete();
        MyPost::where('id', $request->input('id'))->where('like', '>', 0)->decrement('like');
      }

      //$MyPost= MyPost::orderBy('id', 'desc')->get();
     // return $MyPost;
      return $this->index();
    } 
    /**
     * видаляємо пост 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) 
    {
       $postId = $request->input('id');
       $myPost= MyPost::find($postId);
       if(MyPost::where('id',  $postId)->first())
       {
         Like::where('my_post_id', $postId)->delete();
         if(file_exists(public_path($myPost->photo)))
           unlink(public_path($myPost->photo));
                  
         MyPost::where('id', $postId)->delete();
         
       }
        //$MyPost= MyPost::orderBy('id', 'desc')->get();
        return $this->index();
    }
    
}

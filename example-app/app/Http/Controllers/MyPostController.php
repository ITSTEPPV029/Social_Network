<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\MyPost;
use App\Http\Requests\MyPostRequest;
use App\Models\Like;
use App\Models\Comment;
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
        //$MyPost->photo="/public/storage/".$photoName; //для хостинга
      }
      if($request->input('text')=='null')
      {
        $MyPost->text = 0;
      }
      else
        $MyPost->text=$request->input('text');

      $MyPost->user_id=Auth::user()->id;
      $MyPost->save();

      return  MyPost::with('comments.user')
      ->with(['user', 'user.myPost', 'repostedUser'])
      ->orderBy('id', 'desc')
      ->where('user_id', Auth::user()
      ->id)->take(2)->get(); 
        
    }
/**
     * отримання всіх постів  
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    { 
       $id=$request->input('id');
       $page= $request->input('page');
       if($page)
       {
         $MyPost= MyPost::with('comments.user')
         ->with(['user', 'user.myPost', 'repostedUser'])
         ->offset($page)
         ->orderBy('id', 'desc')
         ->where('user_id', $id)
         ->take(2)->get();
       }
       else
       $MyPost= MyPost::with('comments.user')
       ->with(['user', 'user.myPost', 'repostedUser'])
       ->orderBy('id', 'desc')
       ->where('user_id', $id)
       ->take(2)->get(); 

       return  $MyPost; 
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
     
      return true;
    } 

    /**
     * чи вже лайкав
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function isLiked(Request $request) 
    {
      if(Like::where('my_post_id', $request->input('id'))->where('user_id', Auth::user()->id)->first())
      {
        return 1;
      }
      return 0;
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
        // видалення поширених постів
       MyPost::where('reposted_user_id',Auth::user()->id)
       ->where('photo',  $myPost->photo)
       ->delete();

       if(MyPost::where('id',  $postId)->first())
       {
         Like::where('my_post_id', $postId)->delete();
         if(file_exists(public_path($myPost->photo)))
           unlink(public_path($myPost->photo));
                  
         MyPost::where('id', $postId)->delete();      
       }     

      

        return MyPost::with('comments.user')
        ->with(['user', 'user.myPost', 'repostedUser'])
        ->orderBy('id', 'desc')
        ->where('user_id', Auth::user()
        ->id)->take(2)->get();
    }
    
     /**
     * поширити пост 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function sharePost(Request $request) 
    {
      $myPost= MyPost::find($request->input('postId'));

      $newPost = new MyPost();

      $newPost->reposted_user_id=$myPost->user_id;
      $newPost->user_id=Auth::user()->id;
      $newPost->photo=$myPost->photo;
      $newPost->text=$myPost->text;
      $newPost->save();

      return $newPost;

    }
    
     /**
     * поширити пост 
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function sharePostGetUser(Request $request) {
      
    //  return User::find($request->input('idUser'));
    }
}

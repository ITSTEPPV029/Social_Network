<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\MyPost;
use App\Http\Requests\MyPostRequest;

class MyPostController extends Controller
{
  /**
     * 
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyPostRequest $request)     
    {
     // $data = $request->all();
       //$data = $request->json()->all();
   // dd($data);
        $MyPost= new MyPost();
        if($request->file('file'))
        {
          $photoName = $request->file('file')->store('uploads','public');
          $MyPost->photo="/storage/".$photoName;
        }
         $MyPost->text=$request->input('text');
         $MyPost->user_id=2;
         $MyPost->save();
         $MyPost= MyPost::orderBy('id', 'desc')->get();
 
     // view('home.profile',compact('user'));

       return $MyPost;
    }
    public function index() 
    {
        $MyPost= MyPost::orderBy('id', 'desc')->get();
        return $MyPost;
    }    




}

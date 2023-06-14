<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyPost;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class NewsController extends Controller
{

    /**
     * .
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('home.news');
    }

    /**
     * .
     *
     * @return \Illuminate\Http\Response
     */
    public function getPost(Request $request)
    {
        $id = $request->input('id');
        $page = $request->input('page');

        $user = User::find(Auth::user()->id);

        $friends = $user->friends()->pluck('id');
        $friendsOfMine = $user->friendsOfMine()->get()->pluck('id');

        $combinedFriends = $friends->union($friendsOfMine);//обєднуємо колекцію
      

        if ($page) {
            $MyPost = MyPost::with('comments.user')
            ->with(['user', 'user.myPost'])
            ->offset($page)
            ->orderBy('id', 'desc')
            ->where('user_id',  $combinedFriends)
            ->take(2)->get();

            

        } else
        {
            $MyPost = MyPost::with('comments.user')
            ->with(['user', 'user.myPost'])
            ->orderBy('id', 'desc')
            ->where('user_id',  $combinedFriends)
            ->take(2)->get();
        }

        if($MyPost->isEmpty()){
   
            $MyPostId = MyPost::inRandomOrder()->take(1)->pluck('user_id');
            $MyPost = MyPost::with('comments.user')
            ->with(['user', 'user.myPost'])
            ->orderBy('id', 'desc')
            ->whereIn('user_id', $MyPostId)
            ->inRandomOrder()
            ->take(2)
            ->get();
          //  ->offset($page)
        }

            //$MyPost = MyPost::with('comments.user')->with(['user', 'user.myPost'])->orderBy('id', 'desc')->where('user_id', $id)->take(2)->get();
            
        return  $MyPost;
    }
}

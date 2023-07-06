<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyPost;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class NewsController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.news');
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getPost(Request $request)
    {
        $page = $request->input('page');
    
        $user = User::find(Auth::user()->id);

        $friends = $user->friends()->pluck('id');
        $friendsOfMine = $user->friendsOfMine()->get()->pluck('id');

        $combinedFriends = $friends->union($friendsOfMine);//обєднуємо колекцію
       
        $MyPost = new MyPost();
        $index = 0;
        if ($page>0&&!$combinedFriends->isEmpty()) {
            $MyPost = MyPost::with('comments.user')
            ->with(['user', 'user.myPost'])
            ->with(['user', 'user.myPost', 'repostedUser'])
            ->offset($page)
            ->orderBy('id', 'desc')
            ->where('user_id',  $combinedFriends)
            ->take(2)->get();
            $index=1;
           
        } else if (!$combinedFriends->isEmpty())
        {   
            $MyPost = MyPost::with('comments.user')
            ->with(['user', 'user.myPost', 'repostedUser'])
            ->with(['user', 'user.myPost'])
            ->orderBy('id', 'desc')
            ->where('user_id',  $combinedFriends)
            ->take(2)->get();
            $index=+1;
        }
        if ($index==1)// вибираємо рандомний пост 
        {
            $additionalPosts = MyPost::inRandomOrder()
            ->with(['user', 'user.myPost', 'repostedUser'])
            ->with('comments.user')
            ->with(['user', 'user.myPost'])
            ->orderBy('id', 'desc')  
            ->inRandomOrder()
            ->take(1)
            ->get();
        
           $MyPost = $MyPost->concat($additionalPosts);
        }

        if ($index==0)// вибираємо рандомний пост 
        {
                $MyPost = MyPost::inRandomOrder()
                ->with(['user', 'user.myPost', 'repostedUser'])
                ->with('comments.user')
                ->with(['user', 'user.myPost'])
                ->orderBy('id', 'desc')  
                ->inRandomOrder()
                ->take(2)
                ->get();
        }

        return  $MyPost;
    }
}

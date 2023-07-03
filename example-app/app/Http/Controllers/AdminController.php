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
    dd(shell_exec('npm run dev'));
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
use App\Comment;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   public function index() {
        $posts=Post::orderBy('created_at','desc')->paginate(6,['*'],'p');
        $comments=Comment::all();
        $data=[
        'comments'=>$comments,
        'posts'=>$posts,
        ];
        return view('posts.index',$data);
		}
}

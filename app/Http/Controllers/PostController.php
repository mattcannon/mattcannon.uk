<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    public function show( $post)
    {
        return view('posts.show',compact('post'));
    }


}

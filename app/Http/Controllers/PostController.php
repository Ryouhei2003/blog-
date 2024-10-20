<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(3)]);
    }

    public function show(Post $post)
    {
        // dd($post); // ここをコメントアウト
        return view('posts.show')->with(['post' => $post]);
    }
}
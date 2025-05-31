<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PostService $postService)
    {
        $posts = $postService->get();
        // dd($posts);
        return view('index', compact('posts'));
    }
    public function show(Post $post)
    {
        $post->load('user:first_name,last_name');
        $post->created_at = $post->created_at->diffForHumans();
        return view('posts.show', compact('post'));
    }
}

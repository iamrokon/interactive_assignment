<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PostService $postService)
    {
        $posts = $postService->get();
        return view('index', compact('posts'));
    }
    public function show($id, PostService $postService)
    {
        $post = $postService->show($id);
        return view('posts.show', compact('post'));
    }
}

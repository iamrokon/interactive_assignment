<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostService $postService)
    {
        $posts = $postService->get();
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('posts.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $postService)
    {
        // dd($request->file('image'));
        $postService->store(
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );
        return redirect()->back()->with('msg', 'Post inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post = $postService->show($id);
        $post->load('user:first_name,last_name');
        $post->created_at = $post->created_at->diffForHumans();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('user:first_name,last_name');
        $post->created_at = $post->created_at->diffForHumans();
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post, PostService $postService)
    {
        $postService->update(
            $request->validated(),
            $post,
            $request->hasFile('image') ? $request->file('image') : null
        );
        return redirect(route('posts.show', $post->id))->with('msg', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostService $postService)
    {
        $deleted = $postService->destroy($post);
        if ($deleted) {
            return redirect(route('home'))->with('msg', 'Post deleted successfully.');
        } else {
            return redirect(route('home'))->with('error', 'Post not found.');
        }
    }
}

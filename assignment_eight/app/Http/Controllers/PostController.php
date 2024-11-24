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
        $postService->store($request->validated());
        return redirect()->back()->with('msg', 'Post inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, PostService $postService)
    {
        $post = $postService->show($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, PostService $postService)
    {
        $post = $postService->show($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id, PostService $postService)
    {
        $postService->update($request->validated(), $id);
        return redirect(route('posts.show', $id))->with('msg', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, PostService $postService)
    {
        $deleted = $postService->destroy($id);
        if ($deleted) {
            return redirect(route('home'))->with('msg', 'Post deleted successfully.');
        } else {
            return redirect(route('home'))->with('error', 'Post not found.');
        }
    }
}

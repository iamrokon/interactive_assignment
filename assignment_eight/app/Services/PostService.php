<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use DB;

class PostService
{
    public function get()
    {
        // $posts = Post::latest()->get();
        $posts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.content', 'posts.id', 'posts.user_id', 'posts.created_at', 'users.first_name', 'users.last_name')
                ->get();
        $posts->map(function($post){
            $post->created_at = Carbon::make($post->created_at)->diffForHumans();
        });
        // dd($posts);
        return $posts;
    }
    public function store($data)
    {
        DB::transaction(function() use($data){
            DB::table('posts')->insert([
                'user_id' => auth()->user()->id,
                'content' => $data['content'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }, 5);
    }
    public function show($id)
    {
        $post = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.content', 'posts.id', 'posts.user_id', 'posts.created_at', 'users.first_name', 'users.last_name')
                ->where('posts.id', $id)
                ->first();

        $post->created_at = Carbon::make($post->created_at)->diffForHumans();

        return $post;
    }
    public function update($data, $id)
    {
        DB::transaction(function() use($data, $id){
            DB::table('posts')
                ->where('posts.id', $id)
                ->update([
                    'content' => $data['content'],
                    'updated_at' => now()
                ]);
        }, 5);
    }
    public function destroy($id)
    {
        $deleted = DB::table('posts')
                ->where('id', '=', $id)
                ->delete();
        return $deleted;
    }
}

<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use DB;

class PostService
{
    public function get()
    {
        $posts = Post::select('id', 'content', 'user_id', 'created_at')
                // ->with(['user:first_name,last_name,email'])
                ->with('user')
                ->latest()
                ->whereNull('deleted_at')
                ->get();
        $posts->map(function($post){
            $post->created_at = Carbon::make($post->created_at)->diffForHumans();
        });
        // dd($posts);
        return $posts;
    }
    public function store($data, $image)
    {
        DB::transaction(function() use($data, $image){
            $data = array_merge($data, [
                'user_id' => auth()->user()->id
            ]);
            $post = Post::create($data);
            if($image){
                $post->addMedia($image)
                    ->toMediaCollection('image');
            }
        }, 5);
    }
    public function update($data, $post, $image = null)
    {
        DB::transaction(function() use($data, $post, $image){
            $data = array_merge($data, [
                'updated_at' => now()
            ]);
            $post->update($data);
            if($image){
                $post->clearMediaCollection('image');
                $post->addMedia($image)
                    ->toMediaCollection('image');
            }
        }, 5);
    }
    public function destroy($post)
    {
        $deleted = $post->update([
            'deleted_by' => auth()->user()->id,
            'deleted_at' => now()
        ]);
        return $deleted;
    }
}

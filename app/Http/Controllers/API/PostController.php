<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::with('user')->offset(0)->limit(3)->get();
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $post=Post::create([

        'title' => request()->title,
        'description' => request()->description,
        'user_id' => request()->post_creator,
        ]);

        return new PostResource($post);
    }

    public function show($postId)
    {
        $post=Post::find($postId);
        return new PostResource ($post);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store($postId)
    {
        $post = Post::find($postId);
        $body = request()->body;

        $post->comments()->create([
            'body' => $body
        ]);

        return to_route('posts.show', $postId);
    }


}

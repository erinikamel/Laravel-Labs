<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use Carbon\Carbon;



class PostController extends Controller
{

    // public function getPost($postId){

    //     $allPosts = Post::all();

    //     $matchedPost='';

    //     foreach ($allPosts as $p) {
    //         if($p['id'] == $postId){
    //             $matchedPost=$p;
    //             return $p;
    //         }
    //     }
    // }

    //invoke it like this in methods
    //'post' =>  $this->getPost($postId),


    public function index()
    {
        $allPosts = Post::paginate(7);

        // dd($allPosts);
        return view('posts.index', [
          'posts' => $allPosts
        ]);
    }

    public function create()
    {
        $allUsers = User::all();

        return view('posts.create',[
            'users' => $allUsers
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = request()->all();

        //you can save each separately as follows
        //$title = request()->title

        // save to model named Post
        Post::create([
            //you can define it any way from those
            //'title' => request()->title;
            //'title' => $title;
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);



        return to_route('posts.index');
    }

    public function show($postId)
    {
        return view('posts.show', [
          'post' =>  Post::find($postId)
        ]);

    }


    public function update(StorePostRequest $request, $postId){

        $data = request()->all();

        Post::find($postId)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return to_route('posts.index');
    }


    public function edit($postId)
    {
        $allUsers = User::all();

        return view('posts.edit', [
            'post' => Post::find($postId),
            'users' => $allUsers
          ]);

    }


    public function destroy($postId){

        Post::find($postId)->delete();

        return to_route('posts.index');
    }


}

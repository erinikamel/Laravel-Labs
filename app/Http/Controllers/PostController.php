<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(7);

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

        if(request()->file('image')){
        $image= request()->file('image')->getClientOriginalName();
        $path = request()->file('image')->storeAs('posts',$image,'laravelLab');
        }
        else {
        $path = null;
        }


        // save to model named Post
        Post::create([
            //you can define it any way from those
            //'title' => request()->title;
            //'title' => $title;
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            'image' => $path
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

            if (request()->file('image')){

                $oldImage=Post::find($postId)->image;

                $lastStandingImgArray =  DB::select( DB::raw("select image from posts group by image having count(*) = 1"));

                foreach ($lastStandingImgArray as $element)
                {
                if ($element->image == $oldImage)
                    {
                    File::delete('imgs/'.$oldImage);
                    }
                }
                $image= request()->file('image')->getClientOriginalName();

                $path = request()->file('image')->storeAs('posts',$image,'laravelLab');

                Post::find($postId)->update([
                    'image' =>$path
                ]);

        }

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

        $oldImage=Post::find($postId)->image;

        $lastStandingImgArray =  DB::select( DB::raw("select image from posts group by image having count(*) = 1"));

        foreach ($lastStandingImgArray as $element)
        {
            if ($element->image == $oldImage)
                {
                    File::delete('imgs/'.$oldImage);

                }
        }

        Post::find($postId)->delete();
        return to_route('posts.index');

    }

}

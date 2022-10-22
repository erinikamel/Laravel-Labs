<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function getPost($postId){
        $allPosts = [
            ['id' => 1 , 'title' => 'Learn PHP', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2 , 'title' => 'Solid Principles', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
            ['id' => 3 , 'title' => 'Design Patterns', 'posted_by' => 'Ali', 'creation_date' => '2018-04-13'],
        ];

        $matchedPost='';

        foreach ($allPosts as $p) {
            if($p['id'] == $postId){
                $matchedPost=$p;
                return $p;
            }
        }
    }

    public function index()
    {
        $allPosts = [
            ['id' => 1 , 'title' => 'Learn PHP', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
            ['id' => 2 , 'title' => 'Solid Principles', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
            ['id' => 3 , 'title' => 'Design Patterns', 'posted_by' => 'Ali', 'creation_date' => '2018-04-13'],
        ];

        return view('posts.index', [
          'posts' => $allPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return redirect ()->route ('posts.index');
    }

    public function show($postId)
    {

        return view('posts.show', [
          'post' =>  $this->getPost($postId)
        ]);

    }


    public function update(){
        return redirect ()->route ('posts.index');
    }

    public function edit($postId)
    {
        return view('posts.edit', [
            'post' =>  $this->getPost($postId)
          ]);

    }


    public function destroy($postId){
        return "<h3>Post deleted!</h3>";
    }


}

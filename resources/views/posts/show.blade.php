@extends('layouts.app')

@section('title') Show @endsection
@section('content')
<br><br>
<div class="card">
  <h5 class="card-header">Info</h5>
  <div class="card-body">
    <h5 class="card-title">Title: {{$post['title']}}</h5>
    <p class="card-text">Description: {{$post['description']}}</p>
  </div>
</div>
<br>
    @if ($post->image)
    <img src="/imgs/{{$post['image']}}" class="img-thumbnail rounded mx-auto d-block" style="width:100%; height:auto">
    @endif

<br>
<div class="card">
  <h5 class="card-header">Post Creator Info</h5>
  <div class="card-body">
    <h5 class="card-title">Name: {{$post->user?->name}}</h5>
    <h5 class="card-title">Email: {{$post->user?->email}}</h5>
    <h5 class="card-title">Created At: {{\Carbon\Carbon::parse($post['created_at'])->format('l dS \of F Y h:i:s A')}}</h5>

  </div>
</div>
<br> <br>
<div class="card border-primary mb-3">
  <div class="card-header">Comments</div>
  <div class="card-body text-dark">
  <form method="POST" action="{{route('posts.comments.store',$post->id)}}">
    @csrf
    <textarea name="body" class="form-control"></textarea>
    <br>
    <input type="submit" value="Post Comment" class="btn btn-dark ">
    <br><br>
    </form>


@foreach ($post->comments as $comment)
    <div class="border border-light border-2 p-2">{{$comment->body}}

        <br> <small class="text-muted">Posted in: {{\Carbon\Carbon::parse($comment['created_at'])->format('F Y')}}</small>
    </div>
    <br>
@endforeach

@endsection

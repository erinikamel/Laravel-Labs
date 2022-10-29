@extends('layouts.app')

@section('title') Index @endsection
@section('content')
<div class="text-center">
  <a href="{{route('posts.create')}}" class="btn btn-light" style="width:300px;box-shadow:4px 5px 7px 2px lightgrey;">Create Post</a>
</div>
<table class="table my-3">
  <thead>
    <tr >
      <th  scope="col">#</th>
      <th  scope="col">Title</th>
      <th  scope="col">Posted By</th>
      <th  scope="col">Created At</th>
      <th  scope="col">Slug</th>
      <th  scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
      <tr>
        <td>{{$post['id']}}</th>
        <td>{{$post->title}}</td>
        @if($post->user)
          <td>{{$post->user->name}}</td>
        @else
          <td>Not Defined</td>
        @endif

        <td>{{\Carbon\Carbon::parse($post['created_at'])->format('Y-m-d')}}</td>

        <td>{{$post->slug}}</td>

        <td>

    <div class="actions d-md-block d-lg-flex">
            <a href="{{route('posts.show', $post['id'])}}" class="btn btn-secondary">View</a>
            <!-- {{-- <a href="{{route('posts.show', ['post' =>$post['id']])}}" class="btn btn-info">View</a> --}} -->

            <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>

            <form method="post" action="{{route('posts.destroy', $post['id'])}}">
            @method("delete")
            @csrf
                 <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
            </form>
            </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection
@section('paginator')
<div class="d-flex justify-content-center align-items-center bg-dark pt-3">
{{ $posts->links() }}
</div>
@endsection

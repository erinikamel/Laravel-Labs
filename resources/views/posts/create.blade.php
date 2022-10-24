@extends('layouts.app')

@section('title') Create @endsection
@section('content')
<br> <br>
<div class="container txt-center">
        <form method="POST" action="{{route('posts.store')}}">
          @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Title</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title"
              value="{{ old('title') }}">
            </div>

            @if ($errors->has('title'))
            @foreach ($errors->get('title') as $error)

            <div class="alert-danger">
            <p>{{ $error }}</p>
            </div>

            @endforeach
            @endif

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" >Description</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="description"
                value="{{ old('description') }}">
              </div>

            @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)

            <div class="alert-danger">
            <p>{{ $error }}</p>
            </div>


            @endforeach
            @endif

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Post Creator</label>
                <select class="form-control" name="post_creator">
                <option> All</option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
              </div>

            @if ($errors->has('post_creator'))
            @foreach ($errors->get('post_creator') as $error)

            <div class="alert-danger">
            <p>{{ $error }}</p>
            </div>

            @endforeach
            @endif


            <button type="submit" class="btn btn-success">Create</button>
          </form>
          </div>
@endsection

@extends('layouts.app')

@section('title') Update @endsection
@section('content')
<br> <br>


        <form method="POST" action="{{route('posts.update', $post['id'])}}">
        @method("PUT")
          @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Title</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post['title']}}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Post Creator</label>
                <select class="form-control">
                    <option>{{$post['posted_by']}}</option>
                </select>
              </div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>



@endsection

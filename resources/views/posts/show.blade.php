@extends('layouts.app')

@section('title') Show @endsection
@section('content')
<br><br>


<div class="card">
  <h5 class="card-header">Post Info</h5>
  <div class="card-body">
    <h5 class="card-title">Title: {{$post['title']}}</h5>
    <p class="card-text">Description: With supporting text below as a natural lead-in to additional content.</p>
  </div>
</div>

<br>
<div class="card">
  <h5 class="card-header">Post Creator Info</h5>
  <div class="card-body">
    <h5 class="card-title">Name: {{$post['posted_by']}}</h5>
    <h5 class="card-title">Email: Special title treatment</h5>
    <h5 class="card-title">Created at: {{$post['creation_date']}}</h5>

  </div>
</div>

@endsection

@extends('master')

@section('content')

<?php
$movie_actors = [];
foreach ($movie->actors as $movie_actor) {
  array_push($movie_actors, $movie_actor->id);
}
?>

<ul class="nav nav-tabs">
 <li class="inactive">
  <a href="/movie">Movies</a>
 </li>
 <li class="inactive">
  <a href="/actor">Actors</a>
 </li>
</ul>

<div class="row">
 <div class="col-md-12">
  <br />
  @if(count($errors) > 0)
  <div class="alert alert-danger">
         <ul>
         @foreach($errors->all() as $error)
          <li>{{$error}}</li>
         @endforeach
         </ul>
  @endif

  <form method="post" action="{{route('movie.update', $id)}}" onsubmit="myFunction()">
   {{csrf_field()}}
   <input type="hidden" name="_method" value="PATCH" />
   <h5>Title:</h5>
   <div class="form-group">
    <input type="text" name="title" class="form-control" value="{{$movie->title}}" placeholder="Enter Title" />
   </div>
   <h5>Release Date:</h5>
   <div class="form-group">
    <input type="date" name="release_date" class="form-control" value="{{$movie->release_date}}" placeholder="Enter Release Date" />
   </div>
   <div class="form-group">
   <h5>Description:</h5>
    <input type="text" name="description" class="form-control" value="{{$movie->description}}" placeholder="Enter Description" />
   </div>
   <h5>Genre Type:</h5>
   <div class="form-group">
    <input type="text" name="genre_type" class="form-control" value="{{$movie->genre_type}}" placeholder="Enter Genre Type" />
   </div>
   <h5>Trailer:</h5>
   <div class="form-group">
    <input type="text" name="trailer" class="form-control" value="{{$movie->trailer}}" placeholder="Enter link" />
   </div>
   <h5>Actors:</h5>
   <div class="form-group">
    <select name="actors[]" class="form-control" multiple>
     @foreach($actors as $actor)
      <option value="{{ $actor['id'] }}" <?php if(in_array($actor['id'], $movie_actors)) echo "selected"; ?>>{{ $actor['name'] }}</option>
     @endforeach
    </select>
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Edit" />
   </div>
  </form>
 </div>
</div>

@endsection
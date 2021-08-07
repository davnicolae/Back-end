@extends('master')

@section('content')

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
  </div>
  @endif

  @if(\Session::has('success'))
  <div class="alert alert-success">
   <p>{{ \Session::get('success') }}</p>
  </div>
  @endif

  <form method="post" action="{{url('movie')}}">
   {{csrf_field()}}
   <h5>Title:</h5>
   <div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="Enter Title" />
   </div>
   <h5>Release Date:</h5>
   <div class="form-group">
    <input type="date" name="release_date" class="form-control" placeholder="Enter Release Date" />
   </div>
   <h5>Description:</h5>
   <div class="form-group">
    <input type="text" name="description" class="form-control" placeholder="Enter Description" />
   </div>
   <h5>Genre Type:</h5>
   <div class="form-group">
    <input type="text" name="genre_type" class="form-control" placeholder="Enter Genre Type" />
   </div>
   <h5>Trailer:</h5>
   <div class="form-group">
    <input type="text" name="trailer" class="form-control" placeholder="Enter link" />
   </div>
   <h5>Actors:</h5>
   <div class="form-group">
    <select name="actors[]" class="form-control" multiple>
     @foreach($actors as $actor)
      <option value="{{ $actor['id'] }}" >{{ $actor['name'] }}</option>
     @endforeach
    </select>
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Movie" />
   </div>
  </form>
 </div>
</div>

@endsection
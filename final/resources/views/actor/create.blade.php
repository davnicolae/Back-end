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

  <form method="post" action="{{url('actor')}}">
   {{csrf_field()}}
   <div class="form-group">
    <input type="text" name="name" class="form-control" placeholder="Enter Name" />
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Actor" />
   </div>
  </form>
 </div>
</div>

@endsection
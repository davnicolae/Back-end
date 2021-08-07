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
  @endif

  <form method="post" action="{{route('actor.update', $id)}}">
   {{csrf_field()}}
   <input type="hidden" name="_method" value="PATCH" />
   <div class="form-group">
    <input type="text" name="name" class="form-control" value="{{$actor->name}}" placeholder="Enter Title" />
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Edit" />
   </div>
  </form>
 </div>
</div>

@endsection
@extends('master')

@section('content')

<ul class="nav nav-tabs">
 <li class="inactive">
  <a href="/movie">Movies</a>
 </li>
 <li class="active">
  <a href="/actor">Actors</a>
 </li>
</ul>

<div class="row">
 <div class="col-md-12">
  <br />

  @if($message = Session::get('success'))
  <div class="alert alert-success">
   <p>{{$message}}</p>
  </div>
  @endif

  <div align="right">
   <a href="{{route('actor.create')}}" class="btn btn-primary">Add Actor</a>
   <br />
   <br />
  </div>
  <table class="table table-bordered table-striped">
   <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Delete</th>
   </tr>
   @foreach($actors as $row)
   <tr>
    <td>{{$row['id']}}</td>
    <td><a href="{{route('actor.edit', $row['id'])}}">{{$row['name']}} <span class="glyphicon glyphicon-edit"></span></a></td>
    <td>
     <form method="post" class="delete_form" action="{{route('actor.destroy', $row['id'])}}">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="DELETE" />
      <button type="submit" class="btn btn-danger">Delete</button>
     </form>
    </td>
   </tr>
   @endforeach

  </table>
 </div>
</div>

<script>
$(document).ready(function(){
 $('.delete_form').on('submit', function(){
  if(confirm("Are you sure you want to delete it?")) {
   return true;
  } else {
   return false;
  }
 });
});
</script>

@endsection
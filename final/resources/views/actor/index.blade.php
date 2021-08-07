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


<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Actors</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('actor.create') }}"> Create New Actor</a>
            </div>
            
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($actors as $actor)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $actor->image }}" width="100px"></td>
            <td>{{ $actor->name }}</td>
            <td>{{ $actor->detail }}</td>
            <td>
                <form action="{{ route('actor.destroy',$actor->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('actor.show',$actor->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('actor.edit',$actor->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $actors->links() !!}
        
@endsection
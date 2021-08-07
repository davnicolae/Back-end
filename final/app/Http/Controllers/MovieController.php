<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Actor;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies= Movie::where([
            ['title' , '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('title','LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
          ->orderBy('id', 'desc')
          ->paginate(10);
          return view('movie.index', compact('movies'))
              ->with('i',(request()->input('page',1)-1)*5);
        // dd("hello");

        // $movies = Movie::all();
        // return view('movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $actors = Actor::all()->toArray();
        return view('movie.create', compact('actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title'         =>  'required',
            'release_date'  =>  'required',
            'description'   =>  'required',
            'genre_type'    =>  'required',
            // 'genre_type'    =>  array('Action','Crime','Comedy','Thriller','Fantasy'),
            'trailer'       =>  'required',
            
        ]);
        $movie = new Movie([
            'title'         =>  $request->get('title'),
            'release_date'  =>  $request->get('release_date'),
            'description'   =>  $request->get('description'),
            // 'genre_type'    =>  $request->get('Action','Crime','Comedy','Thriller','Fantasy'),
            'genre_type'    =>  $request->get('genre_type'),
            'trailer'       =>  $request->get('trailer')
        ]);
        $movie->save();
        $actor = Actor::find($request->get('actors'));
        $movie->actors()->attach($actor);
        return redirect()->route('movie.index')->with('success', 'Movie Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movie.show',compact('movie'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd("hello");
        $movie = Movie::find($id);
        $actors = Actor::all()->toArray();
        return view('movie.edit', compact('movie', 'id', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required',
            'release_date'  =>  'required',
            'description'   =>  'required',
            'genre_type'    =>  'required',
            'trailer'       =>  'required',
            'actors'        =>  'required',
        ]);
        $movie = Movie::find($id);
        $movie->title = $request->get('title');
        $movie->release_date = $request->get('release_date');
        $movie->description = $request->get('description');
        $movie->genre_type = $request->get('genre_type');
        $movie->trailer = $request->get('trailer');
        $movie->actors()->detach();
        $actor = Actor::find($request->get('actors'));
        $movie->actors()->attach($actor);

        $movie->save();
        return redirect()->route('movie.index')->with('success', 'Movie Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->actors()->detach();
        $movie->delete();
        return redirect()->route('movie.index')->with('success', 'Movie Deleted');
    }
}

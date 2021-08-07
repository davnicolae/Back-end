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
    public function index()
    {
        $movies = Movie::all();
        return view('movie.index',compact('movies'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actors = Actor::all()->toArray();
        return view('movie.create',compact('actors'));
        //
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
            'title'          =>  'required',
            'relase_date'    =>  'required',
            'description'    =>  'required',
            'genre_type'     =>  'required',
        ]);

        $movie = new Movie([
            'title'         =>  $request->get('title'),
            'release_date'  =>  $request->get('release_date'),
            'description'   =>  $request->get('description'),
            'genre_type'    =>  $request->get('genre_type')
        ]);

        $movie->save();
        $actor = Actor::find($request->get('actors'));
        $movie->actors()->attach($actor);
        return redirect()->route('movie.index')->with('success','Movie Added');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $movie = Movie::find($id);
        $actors = Actor::all()->toArray();
        return view('movie.edit',compact('movie','id','actors'));
        //
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
            'title'          =>  'required',
            'relase_date'    =>  'required',
            'description'    =>  'required',
            'genre_type'     =>  'required',
            'actors'         =>  'required',
        ]);
        $movie = Movie::find($id);
        $movie->title = $request->get('title');
        $movie->relase_date = $request->get('relase_date');
        $movie->description = $request->get('description');
        $movie->genre_type = $request->get('genre_type');
        $movie->actors()->detach();
        $actor = Actor::find($request->get('actors'));
        $movie->actors()->attach($actor);

        $movie->save();
        return redirect()->route('movie.index')->with('success','Movie Updated');
        //
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
        return redirect()->route('movie.index')->with('success','Movie Deleted');
        //
    }
}

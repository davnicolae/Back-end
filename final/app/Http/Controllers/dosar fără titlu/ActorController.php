<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Models\Movie;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::all()->toArray();
        return view('actor.index', compact('actors'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actor.create');
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
            'name' => 'required'
        ]);
        $actor = new Actor([
            'name' => $request->get('name')
        ]);
        $actor->save();
        return redirect()->route('actor.index')->with("success",'Actor Added');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Actor  $actor
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Actor  $actor
    //  * @return \Illuminate\Http\Response
    //  */

       /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $actor = Actor::find($id);
        return view('actor.edit', compact('actor','id'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // * @param  \App\Models\Actor  $actor
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $actor = Actor::find($id);
        $actor->title = $request->get('name');
        $actor->save();
        return redirect()->route('actor.index')->with('success','Actor Updated');
        //
    }

    // * @param  \App\Models\Actor  $actor
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);
        $actor->movies()->detach();
        $actor->delete();
        return redirect()->route('actor.index')->with('success','Actor Deleted');
        //
    }
}

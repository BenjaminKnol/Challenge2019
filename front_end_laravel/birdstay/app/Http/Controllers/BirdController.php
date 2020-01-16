<?php

namespace App\Http\Controllers;

use App\Bird;
use App\Location;
use App\Tracker;
use Illuminate\Http\Request;

class BirdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birds = Bird::all();

        $outOfAreaBirds = location::join('birds', 'birds.tracker_id', '=', 'locations.tracker_id')->where("is_found", false)->orderBy('time_received', 'desc')->get();
        $outOfAreaBirds = $outOfAreaBirds->unique('tracker_id');
        $amountOfOutOfAreaBirds = $outOfAreaBirds->count();

        return view('birds.index', compact('birds', 'outOfAreaBirds', 'amountOfOutOfAreaBirds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('birds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'tracker_id' => 'required | unique:birds',
            'name' => 'required',
            'is-female' => 'required',

        ]);

        Tracker::firstOrCreate(['id' => request('tracker_id')]);
        Bird::create(request(['tracker_id', 'name', 'is - female']));

        return redirect(route('birds.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Bird $bird
     * @return \Illuminate\Http\Response
     */
    public function show(Bird $bird)
    {
        return view('birds.index', compact('bird'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Bird $bird
     * @return \Illuminate\Http\Response
     */
    public function edit(Bird $bird)
    {
        return view('birds.edit', compact('bird'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Bird $bird
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bird $bird)
    {
        request()->validate([
            'tracker_id' => 'required',
            'name' => 'required',
            'is - female' => 'required'
        ]);

        $bird->update(request(['tracker_id', 'name', 'is - female']));
        return redirect(route('birds.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Bird $bird
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bird $bird)
    {
        $bird->delete();
        return redirect(route('birds.index'));
    }

    public function found(Bird $bird)
    {

        location::where('tracker_id', '=', $bird->tracker_id)->update(['is_found' => true]);
        return redirect(route('birds.index'));

    }
}

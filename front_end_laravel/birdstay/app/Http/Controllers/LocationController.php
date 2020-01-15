<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Mapper;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        //TODO voeg manier toe om nieuwe coordinaten vanuit de database in te voeren als nieuwe markers
    {
        {
            Mapper::map(60.381128999999990000, -2.470085000000040000); //crashed zonder dit, dit is de begin laad stand.
//
//            Mapper::marker(53.381128999999990000, -1.470085000000040000, ['symbol' => 'circle', 'scale' => 1000]);
//            Mapper::marker(1, 1, ['symbol' => 'circle', 'scale' => 1000]);
            Mapper::polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]]);

            Mapper::map(52.381128999999990000, 0.470085000000040000)->polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2]);

            return view('locations.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}

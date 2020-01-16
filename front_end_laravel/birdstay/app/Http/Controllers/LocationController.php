<?php

namespace App\Http\Controllers;

use App\Location;
use Cornford\Googlmapper\Models\Map;
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
    {
        {
            Mapper::map(52.1561113, 5.3878266, ['marker' => false]);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        Mapper::map(52.1561113, 5.3878266, ['marker' => false]);
        $locations = Location::where('tracker_id', $location->tracker_id)->get();
        $counter = 0;
        foreach ($locations as $location){
            Mapper::marker($location->gps_latitude, $location->gps_longitude);
            $counter++;
            if($counter < $locations->count()){
                Mapper::polyline([['latitude' => $location->gps_latitude, 'longitude' => $location->gps_longitude], ['latitude' => $locations[$counter]->gps_latitude, 'longitude' => $locations[$counter]->gps_longitude]]);
            }
        }

        return view('locations.show');
//        dd(Location::find($location));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}

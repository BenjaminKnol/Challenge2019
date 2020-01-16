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

        /* INFO INFO INFO
        https://developers.google.com/maps/documentation/javascript/overlays
        https://github.com/bradcornford/Googlmapper#polyline

        Polyline
        The polyline method allows a polyline to be added to a map, with coordinates, and optional parameters for options.

        Mapper::polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]]);
        Mapper::polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['editable' => 'true']);
        Mapper::map(52.381128999999990000, 0.470085000000040000)->polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2]);
        */


//        Mapper::map(52.1561113, 5.3878266, ['marker' => false]);
//        $locations = Location::where('tracker_id', $location->tracker_id)->get();
//        $counter = 0;
//        foreach ($locations as $location){
//            Mapper::marker($location->gps_latitude, $location->gps_longitude);
//            $counter++;
//            if($counter < $locations->count()){
//                Mapper::polyline([['latitude' => $location->gps_latitude, 'longitude' => $location->gps_longitude], ['latitude' => $locations[$counter]->gps_latitude, 'longitude' => $locations[$counter]->gps_longitude]]);
//            }
//        }

        

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

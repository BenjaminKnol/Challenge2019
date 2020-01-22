@extends('layouts.layout')
@section('title'){{'Map'}}@endsection
@section('style')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        body {
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

    </style>
@endsection
@section('main')

    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-halv">
                <h5>Out of area bids</h5>
                <table class="w3-table w3-striped w3-white">
                    <tr>
                        <td>Tracker id</td>
                        <td>Bird name</td>
                        <td>Last update</td>
                        <td>Map</td>
                        <td>Found</td>
                    </tr>
                    @foreach($outOfAreaBirds as $outOfAreaBird)
                        <tr>
                            <td>{{ $outOfAreaBird->tracker_id }}</td>
                            <td>{{ $outOfAreaBird->name }}</td>
                            <td>{{ \Carbon\Carbon::now()->diff($outOfAreaBird->time_received)->format('%h:%i') }}</td>
                            <td>
                                <a href="{{ route('locations.show', ['location' => $outOfAreaBird->locationId]) }}">Map</a>
                            </td>
                            <td>
                                @if($outOfAreaBird->is_found)
                                    <i class="fas fa-check" style="color: green"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach()
                </table>
            </div>
        </div>
    </div>

    <div id="map" style="width: 100%; height: 100%;">
        {!! Mapper::render() !!}
    </div>

@endsection


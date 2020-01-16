@extends('layout')
@section('title'){{'Birds'}}@endsection
@section('main')

    <div class="w3-row-padding w3-margin-bottom" style="padding-top: 1em">
        <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fab fa-twitter fa-3x"></i></div>
                <div class="w3-right">
                    <h3>{{ $birds->count() }}</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Birds</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-check-square w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>5</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Status</h4>
            </div>
        </div>

        <a href="{{ route('locations.index') }}">
            <div class="w3-quarter">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><i class="fa fa-map w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>{{$amountOfOutOfAreaBirds}}</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Map</h4>

                </div>
            </div>
        </a>
        <div class="w3-quarter">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>3</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Notifications</h4>
            </div>
        </div>
    </div>

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
                        <td>found</td>
                    </tr>
                    @foreach($outOfAreaBirds as $outOfAreaBird)
                        <tr>
                            <td>{{  $outOfAreaBird->tracker_id }}</td>
                            <td>{{ $outOfAreaBird->name }}</td>
                            <td>{{ \Carbon\Carbon::now()->diff($outOfAreaBird->time_received)->format('%h:%i') }}</td>
                            <td>
                                <a href="{{ route('locations.show', ['location' => $outOfAreaBird->id]) }}">Map</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('birds.found', ['bird' => $outOfAreaBird->id]) }}">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-danger">Found</button>
                                        </div>
                                    </div>
                                </form>

                            </td>
                        </tr>
                    @endforeach()
                </table>
            </div>
        </div>
    </div>



    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-halv">
                <h5>In area bids</h5>
                <table class="w3-table w3-striped w3-white">
                    <tr>
                        <td>Bird number</td>
                        <td>Bird name</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Status</td>
                    </tr>
                    @foreach($birds as $bird)
                        <tr>
                            <td>{{ $bird->tracker_id }}</td>
                            <td>{{ $bird->name }}</td>
                            <td><i class="fa fa-expand fa-fw"></i>
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="bird2">
                                    Expand
                                </button>
                            </td>
                            <td><i class="fa fa-pencil fa-fw"></i><a
                                    href="{{ route('birds.edit', ['bird' => $bird->id]) }}">Edit</td>
                            <td>
                                <form method="post" action="{{ route('birds.destroy', ['bird' => $bird->id]) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td><font color="green">OK</font></td>
                        </tr>
                    @endforeach()
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layout')

@section('main')
    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fa fa-twitter w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>52</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Birds</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-check-square w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>2</h3>
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
                        <h3>1</h3>
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
                        <td>Bird number</td>
                        <td>Bird name</td>
                        <td>Last update</td>
                    </tr>
                    <tr>
                        <td>193</td>
                        <td>Flamingo</td>
                        <td><i>8 mins</i></td>
                    </tr>
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
                        <td>Status</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Flamingo</td>
                        <td><i class="fa fa-expand fa-fw"></i>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="bird2">
                                Expand
                            </button>
                        </td>
                        <td><i class="fa fa-pencil fa-fw"></i>edit</td>
                        <td><font color="green">OK</font></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Duif</td>
                        <td><i class="fa fa-expand fa-fw"></i>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="bird2">
                                Expand
                            </button>
                        </td>
                        <td><i class="fa fa-pencil fa-fw"></i>edit</td>
                        <td><font color="orange">New update avalible</font></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Mus</td>
                        <td><i class="fa fa-expand fa-fw"></i>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="bird3">
                                Expand
                            </button>
                        </td>
                        <td><i class="fa fa-pencil fa-fw"></i>edit</td>
                        <td><font color="red">Low battery</font></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Vink</td>
                        <td><i class="fa fa-expand fa-fw"></i>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="bird4">
                                Expand
                            </button>
                        </td>
                        <td><i class="fa fa-pencil fa-fw"></i>edit</td>
                        <td><font color="green">OK</font></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

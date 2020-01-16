@extends('layouts.layout')

@section('main')
    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter" align="center">
            <div class="w3-container w3-red w3-padding-16">
                <div align="center">
                    <div class="card" align="center">




                        <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

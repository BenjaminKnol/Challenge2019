@extends('layouts.topBar')


<div align="center" style='position:  relative; top:55px;'>
    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter" align="center">
            <div class="w3-container w3-red w3-padding-16">
                <div align="center">
                    <div class="card" align="center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html style="height: 100%">
<title>@yield('title', 'Birdstay')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Raleway", sans-serif
    }
</style>


<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="w3-light-grey" style="height: 100%">

<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <span class="w3-bar-item w3-right">Birdstay</span>
</div>

<div id="app">
    <div align="center" style='position:  relative; top:55px;'>
        <div class="w3-row-padding w3-margin-bottom">
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
</body>
</html>

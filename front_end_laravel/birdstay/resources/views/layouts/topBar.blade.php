<!doctype html>

<html style="height: 100%">
<title>@yield('title', 'Birdstay')</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/9e8d2c6531.js" crossorigin="anonymous"></script>

<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Raleway", sans-serif
    }
</style>

@yield('style')
<body class="w3-light-grey" style="height: 100%">
<div id="app">

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
                <span class="w3-bar-item w3-right">Logo</span>
            </div>
        </div>
    </nav>
    @yield('main')

</div>
</body>
</html>




<!DOCTYPE html>
<html style="height: 100%">
<title>@yield('title', 'Birdstay')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1">
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

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i
            class="fa fa-bars"></i> Menu
    </button>
    <span class="w3-bar-item w3-right">Birdstay</span>
</div>


<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s4">
            <i class="fas fa-user-circle fa-4x"></i>
        </div>
        <div class="w3-col s8 w3-bar" style="margin-top: 8%">
            <span>Welcome, <strong>{{Auth::user()->name}}</strong></span><br>
            <form method="post" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button">Log out</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="w3-container">
        <h5>Dashboard</h5>
    </div>
    <div class="w3-bar-block">

        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black"
           onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> Close Menu</a>
        <a href="{{ route('birds.index') }}"
           class="w3-bar-item w3-button w3-padding w3-{{ Route::is('birds.index') ? '' : 'active' }}blue"><i
                class="fab fa-twitter"></i> Birds</a>
        <a href="{{ route('locations.index') }}"
           class="w3-bar-item w3-button w3-padding w3-{{ Route::is('locations.index') ? '' : 'active' }}blue"><i
                class="fa fa-map fa-fw"></i> Map</a>
{{--        <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i> Notifications</a>  // Temporarely removed option because Notifications page is not working--}}
        <a href="{{ route('contact') }}"
           class="w3-bar-item w3-button w3-padding w3-{{ Route::is('contact') ? '' : 'active' }}blue"><i
                class="fa fa-envelope fa-fw"></i>
            Contact</a>
        <a href="{{ route('birds.create') }}"
           class="w3-bar-item w3-button w3-padding w3-{{ Route::is('birds.create') ? '' : 'active' }}blue"><i
                class="fa fa-plus fa-fw"></i> Create Bird</a><br><br>

    </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
     title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px; height: 100%">

    <!-- Header -->
    {{--    <header class="w3-container" style="padding-top:22px">--}}
    {{--        <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>--}}
    {{--    </header>--}}
    @yield('main')


</div>

<script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }
    @yield('js')
</script>

</body>
</html>

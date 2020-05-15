<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminpro-custon-icon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/data-table/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/c3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css')}}">
    
    <script src="{{ asset('assets/admin/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body class="materialdesign mini-navbar">
    <div class="wrapper-pro">
        {{-- <div class="left-sidebar-pro">
            <nav id="sidebar" class="active">
                <div class="sidebar-header">
                    <a href="#"><img src="{{ asset('assets/admin/img/message/1.jpg')}}" alt="" />
                    </a>
                    <h3>A D M I N</h3>
                    <p>Developer</p>
                    <strong>AD</strong>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    @include('admin.includes.sidebar')
                </div>
            </nav>
        </div> --}}
        {{-- <div class="content-inner-all"> --}}
           <!-- HEADAER -->
           
            {{-- <div class="google-maps-area mg-b-15"> --}}
                @include('admin.includes.header')
                <div class="container-fluid">
                     @yield('content')
                </div>
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
    <script src="{{ asset('assets/admin/js/vendor/jquery-1.11.3.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.meanmenu.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.sticky.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/counterup/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/google.maps/google.maps-active.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiNUO68DkrsFKFz744_LWMqCNI_GqYciQ&callback=initMap" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/main.js')}}"></script>
</body>

</html>
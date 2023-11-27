<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('home_assets/images/favicon.ico') }}">

    <title>{{ $title }} | {{ getenv('APP_NAME') }}</title>
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('home_assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- tiny slider -->
    <link href="{{ asset('home_assets/css/tiny-slider.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('home_assets/css/swiper.min.css') }}" type="text/css" />


    <!-- Materialdesign icons css -->
    <link href="{{ asset('home_assets/css/materialdesignicons.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('home_assets/css/style.css') }}" rel="stylesheet">
    
    @yield('css')
  
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-navlist" data-bs-offset="71">

    <!--Navbar Start-->
    @include('layouts.home.partials.navbar')
    <!-- Navbar End -->

    @yield('content')
    
    <!-- start footer -->
    @include('layouts.home.partials.footer')
    <!-- end footer -->

    <!-- bootstrap -->
    <script src="{{ asset('home_assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('home_assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('home_assets/js/swiper.min.js') }}"></script>

    <!-- counter -->
    <script src="{{ asset('home_assets/js/counter.init.js') }}"></script>

    <!-- Custom -->
    <script src="{{ asset('home_assets/js/app.js') }}"></script>
    
    @yield('js')

</body>

</html>
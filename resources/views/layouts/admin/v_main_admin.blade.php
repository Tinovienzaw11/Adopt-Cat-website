<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('home_assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('dashboard_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/sweet-alert.js') }}"></script>

    @yield('styles')

</head>

<body data-topbar="colored" >

<!-- Begin page -->
<div id="layout-wrapper">

@include('layouts.admin.partials.topbar')

<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('contents')

        @include('layouts.admin.partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include('layouts.admin.partials.sidebar')

<!-- JAVASCRIPT -->
<script src="{{ asset('dashboard_assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ asset('dashboard_assets/js/app.js') }}"></script>

@yield('scripts')

</body>
</html>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <!-- Favicon -->
        <link rel="icon" href="{{url('uploads/settings/source/'.$configration->app_logo)}}" type="image/x-icon"/>

        <!-- Title -->
        <title>{{trans('home.login')}}</title>

        <!---Fontawesome css-->
        <link href="{{URL::To('resources/assets/back/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

        <!---Ionicons css-->
        <link href="{{URL::To('resources/assets/back/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

        <!---Typicons css-->
        <link href="{{URL::To('resources/assets/back/plugins/typicons.font/typicons.css')}}" rel="stylesheet">

        <!---Feather css-->
        <link href="{{URL::To('resources/assets/back/plugins/feather/feather.css')}}" rel="stylesheet">

        <!---Falg-icons css-->
        <link href="{{URL::To('resources/assets/back/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">

        <!---Style css-->
        @if(app()->getlocale() == 'en')
            <link href="{{URL::To('resources/assets/back/css/style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css/custom-style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css/skins.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css/dark-style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css/custom-dark-style.css')}}" rel="stylesheet">
        @else
            <link href="{{URL::To('resources/assets/back/css-rtl/style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css-rtl/custom-style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css-rtl/skins.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css-rtl/dark-style.css')}}" rel="stylesheet">
            <link href="{{URL::To('resources/assets/back/css-rtl/custom-dark-style.css')}}" rel="stylesheet">
        @endif

    </head>

    <body class="main-body">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{URL::To('resources/assets/back/img/loader.gif')}}" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    @yield('content')

    <!-- Jquery js-->
    <script src="{{URL::To('resources/assets/back/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{URL::To('resources/assets/back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Ionicons js-->
    <script src="{{URL::To('resources/assets/back/plugins/ionicons/ionicons.js')}}"></script>

    <!-- Rating js-->
    <script src="{{URL::To('resources/assets/back/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- Custom js-->
    <script src="{{URL::To('resources/assets/back/js/custom.js')}}"></script>

    </body>
    </html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{url('resources/assets/back/img/b-group.webp')}}" type="image/x-icon"/>
    <title>{{trans('home.translation')}}</title>
    <link rel="stylesheet" href="{{ url('resources/assets/back/translation/css/main.css') }}">
</head>
<body>

    <div id="app">

        @include('translation::nav')
        @include('translation::notifications')

        @yield('body')

    </div>

    <script src="{{ url('resources/assets/back/translation/js/app.js') }}"></script>
</body>
</html>

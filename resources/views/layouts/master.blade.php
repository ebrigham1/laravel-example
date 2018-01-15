<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Laravel Demo')</title>
        @section('css')
            <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        @show
    </head>
    <body>
        <div id="app">
            @include('header')
            <div id="content" class="container">
                @include('alerts')
                @yield('content')
            </div>
            @include('footer')
        </div>
        @section('js')
            <script src="{{ mix('/js/manifest.js') }}"></script>
            <script src="{{ mix('/js/vendor.js') }}"></script>
            <script src="{{ mix('/js/app.js') }}"></script>
        @show
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="{{ asset('css/vendor/ckeditor.js') }}"></script>
    <script src="{{ asset('css/vendor/jquery.min.js') }}"></script>
</head>
<body >

    
    <div id="app">
        

        <main class="py-4">
            @yield('content')
            <link rel="stylesheet" href="{{ asset('css/vendor/toastr.min.css') }}">
        </main>
    </div>
    <script src="{{ asset('css/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('css/vendor/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    
</body>
</html>

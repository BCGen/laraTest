<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- meta -->
        @stack('meta')

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        @stack('css_cdn')
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @stack('css')
    </head>

    <body>
        <div id="app">
            @yield('content')
        </div>

        <!-- Scripts -->
        @stack('js_cdn')
        <script src="{{ mix('js/app.js') }}" defer></script>
        @stack('js')
    </body>

</html>

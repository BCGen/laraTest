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

        <!-- Fonts -->
        {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- Styles -->
        @stack('css_cdn')
        <link rel="stylesheet" href="{{ mix(File::exists(public_path('css/admin.css')) ? 'css/admin.css' : 'css/app.css') }}">
        @stack('css')

    </head>

    <body>
        <div id="app">
            @section('nav')
                @include('layouts.admin.nav')
            @show
            <main class="py-4" v-cloak>
                @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        @stack('js_cdn')
        @if (File::exists(public_path('js/vendor.js')))
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        @endif

        <script src="{{ mix(File::exists(public_path('js/admin.js')) ? 'js/admin.js' : 'js/app.js') }}"></script>
        @stack('js')
    </body>
</html>

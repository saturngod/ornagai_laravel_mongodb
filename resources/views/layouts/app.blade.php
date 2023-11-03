<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css','resources/js/app.js'])
        
        @yield('header')
        @yield('script')
        
        <title>{{ $title  ?? "Ornagai"}}</title>
    </head>
    <body>
        <div class="">
            @yield('content')
        </div>
    </body>
</html>
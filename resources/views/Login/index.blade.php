<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <title>{{config('app.name', 'School')}}</title>
    </head>
    <body>
        <div class="container">
          @yield('content')
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

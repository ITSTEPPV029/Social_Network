<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">  
        <title>Pet Life</title> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
          <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">           
    </head>
    <body >

    @include("inc.header")
    @yield('content')

   
    <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>

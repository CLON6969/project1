<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">


   <!-- fontawsome -->
   <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- this is tailwind -->
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">



       <!-- Bootstrap CSS -->
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

   <!-- tailwind CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- CSS -->
<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/nav1.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/footer.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/home.css') }}" rel="stylesheet">

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


   <title>Kumoyo</title>
</head>


<body>
    
<!-- Nav1 Content -->
    <x-nav1 />

    <!-- Dynamic Content -->
 
        @yield('content')

    

<!-- footer Content -->
    <x-footer />


    
<!-- Bootstrap JS (before closing </body>) -->


<!-- JS -->

<script src="{{ asset('resources/js/clock.js') }}" defer></script>
</body>
</html>

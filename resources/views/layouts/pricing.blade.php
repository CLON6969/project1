<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

      <!-- icon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">



   <!-- fontawsome -->
<link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">

   <!-- tailwind CSS -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   


<!-- CSS -->
<link href="{{ asset('resources/css/nav1.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/footer.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/partners.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/pricing.css') }}" rel="stylesheet">

<!-- JS -->
<script src="{{ asset('resources/js/app.js') }}" defer></script>

   @stack('styles') <!-- <- Extra styles will be injected here -->
   
   <title>Kumoyo - Pricing</title>
</head>

<body>

<!-- Navigation -->
<x-nav1 />

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Partners -->
<x-partiners />

<!-- Footer -->
<x-footer />


</body>
</html>

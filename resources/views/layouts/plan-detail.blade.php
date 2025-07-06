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
   <link href="/public/vendor/fontawesome/css/all.min.css" rel="stylesheet">
       <!-- fontawsome back up-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

      <!-- tailwind CSS -->
<link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">



       <!-- CSS -->
       <link href="{{ asset('/public/resources/css/app.css') }}" rel="stylesheet">
          <link href="{{ asset('/public/resources/css/more-nav.css') }}" rel="stylesheet">
       <link href="{{ asset('/public/resources/css/footer.css') }}" rel="stylesheet">
       <link href="{{ asset('/public/resources/css/partners.css') }}" rel="stylesheet">
       <link href="{{ asset('/public/resources/css/premium.css') }}" rel="stylesheet">
       
       
   <!-- JS Scripts -->


@stack('styles') <!-- <- Extra styles will be injected here -->

   <title>Kumoyo - Premium Plan</title>
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

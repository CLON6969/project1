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

        <!-- Bootstrap JS (before closing </body>) -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- CSS -->
<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/nav1.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/footer.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/partners.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/services.css') }}" rel="stylesheet">



   <title>Kumoyo</title>
</head>


<body>
<!-- Nav1 Content -->
    <x-nav1 />

    <!-- Dynamic Content -->
    <main>
        @yield('content')
    </main>
    
 <!-- partiners Content -->
    <x-partiners />
    
<!-- footer Content -->
    <x-footer />

        <!-- Bootstrap JS (before closing </body>) -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- JS -->
<script src="{{ asset('resources/js/app.js') }}" defer></script>

</body>
</html>

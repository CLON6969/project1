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

   <!-- CSS Scripts -->
   <link href="{{ asset('resources/css/dashboard.css') }}" rel="stylesheet">
   
   <!--JS Scripts -->
<script src="{{ asset('resources/js/admin_profile.js' }}" defer></script>
   <title>Kumoyo</title>
</head>


<body>
<!-- Nav1 Content -->
 

    <!-- Dynamic Content -->
    <main>
        @yield('content')
    </main>




</body>
</html>

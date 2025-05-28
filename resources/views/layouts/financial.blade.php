<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

      <!-- icon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}">


<!-- fontawsome -->
<link href="vendor/fontawesome/css/all.min.css" rel="stylesheet">

   <!-- tailwind CSS -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

       <!-- Bootstrap CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- CSS -->
<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">

   <!--JS Scripts -->

  <title>Make Payment</title>

</head>


<body>
<!-- Nav1 Content -->


    <!-- Dynamic Content -->
    <main>
        @yield('content')
    </main>
    


<!-- footer Content -->

                <!-- Bootstrap JS (before closing </body>) -->
                <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>

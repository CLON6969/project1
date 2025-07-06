
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

      <!-- icon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
       <!-- fontawsome back up-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">


   <!-- CSS Scripts -->
   <link href="{{ asset('/public/resources/css/sigin.css') }}" rel="stylesheet">
   
   <!--JS Scripts -->

   <title>Kumoyo | Sigin</title>
</head>


<body>


    <!-- Dynamic Content -->
    <main>
        @yield('content')
    </main>
    

    
            <!-- Bootstrap JS (before closing </body>) -->
            <script src="{{ asset('/public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

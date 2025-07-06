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
   <link href="https://cdn.tailwindcss.com" rel="stylesheet">


<!-- CSS -->


<link href="{{ asset('/public/resources/css/update_form.css') }}" rel="stylesheet">



   <title>Kumoyo</title>
</head>


<body>
<!-- Nav1 Content -->


    <!-- Dynamic Content -->
    <main>
           {{-- Include session alerts --}}
@include('partials.alerts')
        @yield('content')
    </main>
    


    
</body>
</html>

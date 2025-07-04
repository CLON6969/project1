<!DOCTYPE html>
<html lang="en" class="bg-white text-black">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Kumoyo | About Us</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">





     <link href="{{ asset('resources/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/more-nav.css') }}" rel="stylesheet">
     <link href="{{ asset('resources/css/about.css') }}" rel="stylesheet">

</head>
<body >
<!-- Nav1 Content -->
    <x-nav1 />

 
            @yield('content')


    
<!-- footer Content -->
    <x-footer />
</body>
</html>
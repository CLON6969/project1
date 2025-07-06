<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   



       <!-- icon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


   <!-- fontawsome -->
   <link href="/public/vendor/fontawesome/css/all.min.css" rel="stylesheet">
       <!-- fontawsome back up-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

      <!-- Bootstrap CSS -->
       <link href="{{ asset('/public/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


  
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen">
    

        <main class="p-6">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
</body>
</html>

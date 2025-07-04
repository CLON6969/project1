<!DOCTYPE html>
<html lang="en" class="bg-white text-black">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <title>Kumoyo | privacy</title>

    <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/more-nav.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/partners.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/css/legal.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Nav1 Content -->
    <x-nav1 />

    <div class="flex flex-1">
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

     <!-- partiners Content -->
    <x-partiners />
    
<!-- footer Content -->
    <x-footer />
</body>
</html>
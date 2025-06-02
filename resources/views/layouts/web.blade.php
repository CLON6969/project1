<!DOCTYPE html>
<html lang="en" class="bg-white text-black">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="min-h-screen flex flex-col">
    <div class="flex flex-1">
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
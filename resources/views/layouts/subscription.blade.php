<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Font Awesome -->
    <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen flex flex-col">


    <!-- Main content wrapper -->
    <div class="flex flex-1">
        <!-- Sidebar (Optional) -->
        {{-- <aside class="w-64 p-4 border-r bg-gray-50">Sidebar Links</aside> --}}

        <!-- Page content -->
        <main class="flex-1 p-6">
                {{-- Include session alerts --}}
@include('partials.alerts')
            @yield('content')
        </main>
    </div>
</body>

</html>

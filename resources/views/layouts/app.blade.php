<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', 'Kuharaki')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        @include('components.header')

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')
    </div>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
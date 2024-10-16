<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">

    <div
        class="flex-col min-h-screen bg-gray-100 dark:bg-gray-900 w-full md:flex md:flex-row md:min-h-screen">
        @yield('content')
    </div>
    @livewireScripts
    <!-- jQuery -->
    <script rel="preload" type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" as="script"></script>
    @stack("scripts")
</body>
</html>

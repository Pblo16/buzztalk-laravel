<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Make sure this is after Vite -->
    @livewireStyles

</head>

<body
    class="font-sans antialiased bg-gray-50 transition-all duration-300 lg:hs-overlay-layout-open:ps-[260px] dark:bg-[#252525] min-h-dvh flex flex-col">
    <livewire:ui.navigation />
    <!-- Main content wrapper -->
    <div class="flex flex-1 h-full">
        <!-- Page Content -->
        <main class="lg:ps-60 dark:bg-[#252525]/100 w-full flex-1">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    @stack('modals')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
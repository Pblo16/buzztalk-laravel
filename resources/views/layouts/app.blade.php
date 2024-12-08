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
    class="font-sans antialiased bg-gray-50 transition-all duration-300 lg:hs-overlay-layout-open:ps-[260px] dark:bg-black">
    <livewire:ui.navigation />
    <!-- Page Content -->
    <main class=" lg:ps-60 h-full overflow-y-hidden dark:bg-[#252525]/100">
        {{ $slot }}
    </main>

    @livewireScripts
    @stack('modals')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.connector.pusher.connection.bind('connected', () => {
                console.log('Connected to WebSocket');
            });

            window.Echo.connector.pusher.connection.bind('error', (error) => {
                console.error('WebSocket connection error:', error);
            });

            Livewire.on('friend-request-sent', () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Friend request sent successfully',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            });
        });
    </script>
</body>

</html>
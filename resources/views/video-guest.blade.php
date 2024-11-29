
<x-guest-layout>
    <div class="min-h-screen bg-gray-900">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex min-h-[calc(100vh-4rem)] flex-col items-center justify-center p-4">
            <div class="w-full max-w-6xl aspect-video bg-gray-800 rounded-lg shadow-lg">
                <!-- Aquí irá tu reproductor de video -->
                <div class="w-full h-full flex items-center justify-center text-white text-xl">
                    Video Player
                </div>
            </div>
            <div class="mt-4 w-full max-w-6xl">
                <h1 class="text-2xl font-bold text-white">Título del Video</h1>
                <p class="mt-2 text-gray-400">Descripción del video...</p>
            </div>
        </main>
    </div>
</x-guest-layout>
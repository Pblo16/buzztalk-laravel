<div class="md:hidden">
    <!-- ========== HEADER ========== -->
    <header
        class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[48] w-full bg-white  text-sm py-2.5d dark:bg-[#333]/60 }">
        <nav class="lg:ps-60 px-4 py-4 sm:px-6 flex basis-full items-center w-full mx-auto">

            <div class="w-full flex items-center justify-end ms-auto gap-x-1 md:gap-x-3">

                <div class="flex flex-row items-center justify-end gap-2">

                    <livewire:search-users />

                    @auth
                    <a wire:navigate href="{{ route('chats') }}"
                        class="flex flex-col items-center text-gray-800 dark:text-white {{ Route::is('chats') ? 'text-blue-600' : '' }}">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                    </a>
                    @else
                    @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}"
                            class="transition-colors bg-gray-200 text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium dark:text-white dark:bg-[#252525] dark:hover:bg-white dark:hover:text-black">Log
                            in</a>

                        @endauth
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
</div>
<div>

    <!-- Sidebar -->
    <div id="hs-application-sidebar"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform fixed top-0 start-0 bottom-0 z-[60] w-60 bg-white pt-4 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-[#333]">
        <div class="relative flex flex-col h-full max-h-full">
            <div class="px-6 pt-4 flex justify-center items-center">
                <!-- Logo -->
                <a wire:navigate
                    class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80 dark:text-white"
                    href="{{ route('video')}}" aria-label="Preline">
                    <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                    <span class="sr-only">Activity</span>
                </a>
                <!-- End Logo -->
            </div>

            <!-- Content -->
            <div
                class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                    <ul class="flex flex-col space-y-1">
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('video') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('video') }}">
                                <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Inicio
                            </a>
                        </li>
                        @auth
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
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('chats') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('chats') }}">
                                <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>

                                Chats
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('post.upload') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('post.upload') }}">
                                <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Crear
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('post.feed') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('post.feed') }}">
                                <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                </svg>
                                Galerry
                            </a>

                        </li>
                        <li>

                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('friends') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('friends') }}">
                                <svg class="shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                Friends
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-1xl text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:bg-gray-400 dark:text-white {{ Route::is('profile.index') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}"
                                href="{{ route('profile.index') }}">
                                <img class="w-6 h-6 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                Profile
                            </a>

                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Theme Switcher -->
        <div class="absolute bottom-0 w-full p-4">
            <button type="button"
                class="hs-dark-mode-active:hidden block w-full hs-dark-mode group items-center text-gray-600 hover:text-blue-600 font-medium dark:text-gray-400 dark:hover:text-gray-500"
                data-hs-theme-click-value="dark">
                <span class="group inline-flex items-center gap-x-2">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                    </svg>
                </span>
            </button>
            <button type="button"
                class="hs-dark-mode-active:block hidden w-full hs-dark-mode group items-center text-gray-600 hover:text-blue-600 font-medium dark:text-gray-400 dark:hover:text-gray-500"
                data-hs-theme-click-value="light">
                <span class="group inline-flex items-center gap-x-2">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4" />
                        <path d="M12 2v2" />
                        <path d="M12 20v2" />
                        <path d="m4.93 4.93 1.41 1.41" />
                        <path d="m17.66 17.66 1.41 1.41" />
                        <path d="M2 12h2" />
                        <path d="M20 12h2" />
                        <path d="m6.34 17.66-1.41 1.41" />
                        <path d="m19.07 4.93-1.41 1.41" />
                    </svg>
                </span>
            </button>
        </div>
        <!-- End Theme Switcher -->
    </div>
    <!-- End Sidebar -->
</div>

<!-- Initialize theme functionality -->
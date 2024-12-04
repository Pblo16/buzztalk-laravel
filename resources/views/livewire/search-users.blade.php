<div class="relative max-w-[600px]">
    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
        <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
        </svg>
    </div>
    <input type="text" wire:model.live.debounce.300ms="search"
        class="py-2 ps-10 pe-16 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
        placeholder="Search users...">

    @if($showResults && $users->count() > 0)
    <div
        class="absolute mt-2 w-full bg-white dark:bg-neutral-800 rounded-lg shadow-lg border dark:border-neutral-700 z-50 cursor-pointer">
        @foreach($users as $user)
        <a href="/profile/{{ $user->name }}" wire:navigate
            class="p-3 hover:bg-gray-100 dark:hover:bg-neutral-700 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ $user->profile_photo_url }}" class="size-8 rounded-full mr-3">
                <span class="text-gray-800 dark:text-white">{{ $user->name }}</span>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
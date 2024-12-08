@props(['conversation'])
<div class="p-4 flex items-center gap-3 border-b dark:border-gray-800 dark:bg-[#333]">

    @if($conversation->users()->count() === 2)
    {{-- Individual conversation --}}
    <a wire:navigate href="/profile/{{ $conversation->users()->where('id', '!=', auth()->id())->first()->name }}"
        class="hover:cursor-pointer flex gap-4">
        <div class="h-10 aspect-square rounded-full bg-gray-300">
            <img src="{{ $conversation->users()->where('id', '!=', auth()->id())->first()->profile_photo_url }}"
                class="h-full w-full rounded-full object-cover">
        </div>
        <div>
            <h2 class="font-bold">{{ $conversation->users()->where('id', '!=', auth()->id())->first()->name }}</h2>
        </div>
    </a>
    @else
    {{-- Group conversation --}}
    <div class="flex gap-4">
        <div class="h-10 aspect-square rounded-full bg-gray-300">
            {{-- Group avatar placeholder --}}
        </div>
        <div>
            <h2 class="font-bold">{{ $conversation->name ?: 'Group Chat' }}</h2>
            <p class="text-sm text-gray-500">
                {{ $conversation->users()->where('id', '!=', auth()->id())->pluck('name')->join(', ') }}
            </p>
        </div>
    </div>
    @endif
</div>
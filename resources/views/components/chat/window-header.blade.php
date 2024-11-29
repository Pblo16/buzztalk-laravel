@props(['conversation'])

<div class="p-4 flex items-center gap-3 border-b dark:border-gray-800 dark:bg-gray-950">
    <div class="h-10 aspect-square rounded-full bg-gray-300">
        @if($conversation->users()->count() === 2)
        <img src="{{ $conversation->users()->where('id', '!=', auth()->id())->first()->profile_photo_url }}"
            class="h-full w-full rounded-full object-cover">
        @endif
    </div>
    <div>
        <h2 class="font-bold">{{ $conversation->name }}</h2>
        <p class="text-sm text-gray-500">
            {{ $conversation->users()->where('id', '!=', auth()->id())->pluck('name')->join(', ') }}
        </p>
    </div>
</div>
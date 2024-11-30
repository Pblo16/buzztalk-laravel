<div class="flex flex-col">
    <div 
        wire:key="contact-{{ $conversation->id }}-{{ $active ? 'active' : 'inactive' }}" 
        wire:click="selectConversation"
        class="flex items-center gap-3 p-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 {{ $active ? 'bg-gray-100 dark:bg-gray-900' : '' }}"
    >
        <img src="{{ $conversation->users->where('id', '!=', auth()->id())->first()?->profile_photo_url ?? 'https://www.gravatar.com/avatar/?d=mp' }}"
            alt="{{ $conversation->name }}" class="w-12 h-12 rounded-full object-cover">
        <div class="flex-1">
            <h3 class="font-medium">{{ $conversation->name }}</h3>
            <p class="text-sm text-gray-500 truncate">{{ $conversation->lastMessage?->content ?? 'No messages yet' }}</p>
        </div>
    </div>
</div>
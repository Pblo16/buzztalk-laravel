<div class="flex flex-col">
    @forelse($conversations as $key => $conversation)
        <livewire:chat.contact-item 
            :conversation="$conversation"
            :active="$activeConversationId === $conversation->id"
            :wire:key="$conversation->id . '-' . ($activeConversationId === $conversation->id ? 'active' : 'inactive')" />
    @empty
        <div class="flex flex-col items-center justify-center p-4">
            <p class="text-gray-500">No conversations yet</p>
        </div>
    @endforelse
</div>
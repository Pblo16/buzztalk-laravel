@props(['conversations', 'currentConversation'])

<div class="h-full dark:bg-gray-950 border-r border-gray-400 dark:border-black">
    <div class="overflow-y-auto ">
        @foreach($conversations as $conversation)
        <div wire:key="conversation-{{ $conversation->id }}" @if($currentConversation?->id !== $conversation->id)
            wire:click="setActiveConversation({{ $conversation->id }})"
            @endif>
            <x-chat.contact-item :conversation="$conversation"
                :active="$currentConversation?->id === $conversation->id" />
        </div>
        @endforeach
    </div>
</div>
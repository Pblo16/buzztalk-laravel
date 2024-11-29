@props(['conversations', 'currentConversation'])

<div class="h-full dark:bg-gray-950 border-r border-gray-400 dark:border-black">
    <div class="overflow-y-auto" wire:ignore>
        @foreach($conversations as $conversation)
            <livewire:chat.contact-item 
                :wire:key="'contact-item-'.$conversation->id"
                :conversation="$conversation"
                :active="$currentConversation?->id === $conversation->id" />
        @endforeach
    </div>
</div>
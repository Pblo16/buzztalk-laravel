@props(['conversation'])

<div class="flex flex-col h-full">
    <x-chat.window-header :conversation="$conversation" />

    <div class="flex-1 overflow-hidden">
        <livewire:chat.message-list :conversation="$conversation" :key="'chat-'.$conversation->id" />
    </div>

    <livewire:chat.message-input :conversation="$conversation" :key="'input-'.$conversation->id" />
</div>
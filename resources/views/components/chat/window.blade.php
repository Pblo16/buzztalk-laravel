@props(['conversation'])

<div class="flex flex-col max-h-[calc(100vh-80px)] min-h-[calc(100vh-80px)]">
    <x-chat.window-header :conversation="$conversation" />

    <livewire:chat.message-list :conversation="$conversation" :key="'chat-'.$conversation->id" />

    <livewire:chat.message-input :conversation="$conversation" :key="'input-'.$conversation->id" />
</div>
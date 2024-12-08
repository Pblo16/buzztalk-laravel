@props(['currentConversation'])

<div class="h-full dark:bg-[#252525] border-r-2 border-gray-300 dark:border-black overflow-y-auto">

    @livewire('chat.contact-list')

    <livewire:chat.new-conversation />
</div>
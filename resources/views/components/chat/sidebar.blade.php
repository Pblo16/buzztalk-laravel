@props(['currentConversation'])

<div class="h-full flex flex-col dark:bg-[#252525] border-r-2 border-gray-300 dark:border-black overflow-hidden">
    <div class="flex-1 overflow-y-auto">
        @livewire('chat.contact-list')
    </div>

    <div class="flex-none border-t dark:border-neutral-700">
        <livewire:chat.new-conversation />
    </div>
</div>
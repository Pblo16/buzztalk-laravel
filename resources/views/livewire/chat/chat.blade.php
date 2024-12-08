<div class="dark:text-white ">
    <div class="grid grid-cols-[350px_1fr] h-[calc(100dvh-78px)]">
        <x-chat.sidebar :conversations="$conversations" :currentConversation="$currentConversation" />
        <div class="h-full">
            @if($currentConversation)
            <x-chat.window :conversation="$currentConversation" />
            @else
            <div class="flex items-center justify-center h-full">
                <p>Select a conversation to start chatting</p>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="dark:text-white h-[calc(100dvh-120px)] md:h-full overflow-hidden">
    <div class="md:grid grid-cols-[350px_1fr] h-full relative">
        <div class="{{ $showMobileChat ? 'hidden' : 'block' }} md:block h-full overflow-hidden">
            <x-chat.sidebar :conversations="$conversations" :currentConversation="$currentConversation" />
        </div>

        <div
            class="h-full overflow-hidden {{ $showMobileChat ? 'fixed inset-0 z-50 bg-white dark:bg-[#252525] pb-16' : 'hidden' }} md:block">
            @if($currentConversation)
            <div class="flex flex-col h-full">
                <div class="p-4 bg-gray-100 dark:bg-[#252525] md:hidden">
                    <button wire:click="hideMobileChat" class="text-gray-500">
                        ← Back
                    </button>
                </div>
                <x-chat.window :conversation="$currentConversation" />
            </div>
            @else
            <div class="flex items-center justify-center h-full">
                <p>Select a conversation to start chatting</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const handleResize = () => {
                @this.dispatch('screen-resized', { width: window.innerWidth })
            };
            
            window.addEventListener('resize', handleResize);
            
            // Initial check
            handleResize();
            
            // Cleanup on component disconnect
            document.addEventListener('livewire:disconnected', () => {
                window.removeEventListener('resize', handleResize);
            });
        });
    </script>
</div>
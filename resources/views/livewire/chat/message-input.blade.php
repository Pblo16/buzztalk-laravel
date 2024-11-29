
<div class="p-4 border-t dark:border-gray-800">
    <form wire:submit="sendMessage" class="flex items-center gap-2">
        <input type="text" 
               wire:model="message" 
               class="w-full rounded-full bg-gray-100 dark:bg-gray-800 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Type a message...">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
        </button>
    </form>
</div>
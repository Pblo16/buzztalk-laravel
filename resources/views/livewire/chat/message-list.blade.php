<div class="flex-1 overflow-y-auto p-4 space-y-4 max-h-[calc(100vh-80px)]" 
    wire:poll.3s 
    x-data="{ 
        scrollToBottom() { 
            this.$el.scrollTop = this.$el.scrollHeight 
        } 
    }" 
    x-init="scrollToBottom()" 
    @message-received.window="scrollToBottom()"
    wire:key="message-list-{{ $conversation->id }}">
    @foreach($messages as $message)
    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
        <div
            class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700' }} rounded-lg p-3">
            @if($message->user_id !== auth()->id())
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $message->user->name }}</p>
            @endif
            <p class="text-sm">{{ $message->content }}</p>
            <p
                class="text-xs text-right {{ $message->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                {{ $message->created_at->format('H:i') }}
            </p>
        </div>
    </div>
    @endforeach
</div>
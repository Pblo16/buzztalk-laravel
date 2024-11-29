<div class="flex-1 overflow-y-auto p-4 space-y-4 max-h-[calc(100vh-80px)]" wire:poll.3s x-data="{ 
        scrollToBottom() { 
            this.$el.scrollTop = this.$el.scrollHeight 
        } 
    }" x-init="scrollToBottom()" @message-received.window="scrollToBottom()"
    wire:key="message-list-{{ $conversation->id }}">
    @foreach($messages as $message)
    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}"
        wire:key="message-{{ $message->id }}">
        <div
            class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-gray-300 dark:bg-gray-700 text-white' : 'bg-gray-300 dark:bg-gray-700' }} rounded-lg p-3">
            @if($message->user_id !== auth()->id())
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $message->user->name }}</p>
            @endif

            @if($message->attachments && $message->attachments->count() > 0)
            @foreach($message->attachments as $attachment)
            @if($attachment && $attachment->path)
            @if(Str::startsWith($attachment->type, 'image/'))
            <div class="max-w-72 w-min-72 aspect-square overflow-hidden mb-2 rounded-lg">
                <img src="{{ Storage::url($attachment->path) }}" alt="Attachment" class="w-full">
            </div>
            @else
            <div
                class="flex items-center gap-2 mb-2 p-2 bg-gray-200 dark:bg-gray-600 rounded text-black dark:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-sm underline ">
                    {{ $attachment->name }}
                </a>
            </div>
            @endif
            @endif
            @endforeach
            @endif

            @if($message->content)
            <p class="text-sm">{{ $message->content }}</p>
            @endif

            <p
                class="text-xs text-right {{ $message->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                {{ $message->created_at->format('H:i') }}
            </p>
        </div>
    </div>
    @endforeach
</div>
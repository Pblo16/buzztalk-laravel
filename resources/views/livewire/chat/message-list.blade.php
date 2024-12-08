<div class="flex-1" x-data="{ 
        showModal: false,
        currentImage: '',
        images: [],
        currentIndex: 0,
        zoomLevel: 1,
        offsetX: 0,
        offsetY: 0,
        isDragging: false,
        startX: 0,
        startY: 0
    }" x-init="
        await new Promise(resolve => {
            let waitForEcho = setInterval(() => {
                if (window.Echo) {
                    clearInterval(waitForEcho);
                    resolve();
                }
            }, 100);
        });
        
        let channel = Echo.private(`conversation.${@js($conversationId)}`);
        channel.listen('.MessageSent', (e) => {
            $wire.handleNewMessage(e);
        });
        
        channel.error((error) => {
            console.error('Echo connection error:', error);
        });

        Echo.connector.pusher.connection.bind('connected', () => {
            console.log('Successfully connected to Reverb');
        });

        Echo.connector.pusher.connection.bind('error', (error) => {
            console.error('Reverb connection error:', error);
        });
    " @scrollToBottom.window="$nextTick(() => { 
        $el.querySelector('.messages-container').scrollTop = $el.querySelector('.messages-container').scrollHeight;
    })" @keydown.window.escape="showModal = false">

    <div class="flex-1 overflow-y-auto p-4 space-y-4 max-h-[calc(100vh-220px)] messages-container" x-data="{ 
            scrollToBottom() { 
                this.$el.scrollTop = this.$el.scrollHeight 
            } 
        }" x-init="scrollToBottom()" @message-received.window="scrollToBottom()">
        @foreach($messages as $message)
        <div class="flex  {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}"
            wire:key="message-{{ $message->id }}">
            <div
                class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-[#9377F1]' : 'bg-gray-300 dark:bg-[#333333]/60' }} rounded-lg p-3">
                @if($message->user_id !== auth()->id())
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-semibold">{{ $message->user->name }}</p>
                @endif

                @if($message->attachments && $message->attachments->count() > 0)
                @foreach($message->attachments as $attachment)
                @if($attachment && $attachment->path)
                @if(Str::startsWith($attachment->type, 'image/'))
                <div class="max-w-72 w-min-72 overflow-hidden mb-2 rounded-lg">
                    <img src="{{ Storage::url($attachment->path) }}" alt="Attachment" class="w-full cursor-pointer"
                        @click="showModal = true; currentImage = '{{ Storage::url($attachment->path) }}'; images = {{ $message->attachments->pluck('path') }}; currentIndex = {{ $loop->index }}">
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
                <p
                    class="text-sm {{ $message->user_id === auth()->id() ? 'text-white' : 'text-gray-800 dark:text-white' }}">
                    {{ $message->content }}
                </p>
                @endif

                <p
                    class="text-xs text-right mt-1 {{ $message->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                    {{ $message->created_at->format('H:i') }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-[#333] z-[70] "
        @wheel="zoomLevel = Math.min(Math.max(1, zoomLevel + $event.deltaY * -0.001), 5)">
        <button @click="showModal = false" class="absolute top-0 right-0 m-4 text-white text-2xl">&times;</button>
        <div class="relative flex justify-center ">
            <img :src="currentImage"
                :style="{ transform: 'scale(' + zoomLevel + ') translate(' + offsetX + 'px, ' + offsetY + 'px)' }"
                class="max-w-[70%] max-h-full"
                @mousedown="isDragging = true; startX = $event.clientX - offsetX; startY = $event.clientY - offsetY"
                @mousemove="if(isDragging) { offsetX = $event.clientX - startX; offsetY = $event.clientY - startY }"
                @mouseup="isDragging = false" @mouseleave="isDragging = false"
                @touchstart="isDragging = true; startX = $event.touches[0].clientX - offsetX; startY = $event.touches[0].clientY - startY"
                @touchmove="if(isDragging) { offsetX = $event.touches[0].clientX - startX; offsetY = $event.touches[0].clientY - startY }"
                @touchend="isDragging = false">
            <div class="absolute inset-0 flex items-center justify-between px-4">
                <button
                    @click="currentIndex = (currentIndex - 1 + images.length) % images.length; currentImage = '{{ Storage::url('') }}' + images[currentIndex]"
                    class="text-white text-3xl">&larr;</button>
                <button
                    @click="currentIndex = (currentIndex + 1) % images.length; currentImage = '{{ Storage::url('') }}' + images[currentIndex]"
                    class="text-white text-3xl">&rarr;</button>
            </div>
        </div>
    </div>
</div>
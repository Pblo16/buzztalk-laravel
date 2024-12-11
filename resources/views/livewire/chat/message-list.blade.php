<div>
    <div class="flex-1 overflow-y-auto p-4 flex flex-col-reverse messages-container min-h-[calc(100dvh-250px)] max-h-[calc(100dvh-250px)]   md:min-h-[calc(100dvh-160px)] md:max-h-[calc(100dvh-160px)]"
        id="messages-container">
        @if($messages && $messages->count() > 0)
        <div class="flex flex-col-reverse gap-4">
            @foreach($messages as $message)
            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}"
                wire:key="message-{{ $message->id }}">
                <div
                    class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-[#9377F1]' : 'bg-gray-300 dark:bg-[#333333]/60' }} rounded-lg p-3">
                    @if($message->user_id !== auth()->id())
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-semibold">{{ $message->user->name }}
                    </p>
                    @endif

                    @if($message->attachments && $message->attachments->count() > 0)
                    @foreach($message->attachments as $attachment)
                    @if($attachment && $attachment->path)
                    @if(Str::startsWith($attachment->type, 'image/'))
                    <div class="max-w-72 w-min-72 overflow-hidden mb-2 rounded-lg">
                        <img src="{{ Storage::url($attachment->path) }}" alt="Attachment" class="w-full cursor-pointer"
                            wire:click="openImageModal({{ json_encode([
                                        'image' => Storage::url($attachment->path),
                                        'images' => $message->attachments->pluck('path')->toArray(),
                                        'index' => $loop->index
                                    ]) }})">
                    </div>
                    @elseif(Str::startsWith($attachment->type, 'video/'))
                    <div class="max-w-72 w-min-72 overflow-hidden mb-2 rounded-lg">
                        <video controls class="w-full">
                            <source src="{{ Storage::url($attachment->path) }}" type="{{ $attachment->type }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    @else
                    <div class="flex items-center gap-2 mb-2 p-2 bg-gray-200 dark:bg-gray-600 rounded">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <a href="{{ Storage::url($attachment->path) }}" target="_blank"
                            class="text-sm text-blue-500 dark:text-blue-400 hover:underline">
                            {{ $attachment->name }}
                        </a>
                    </div>
                    @endif
                    @endif
                    @endforeach
                    @endif

                    @if($message->content)
                    <p
                        class="text-sm break-words break-all {{ $message->user_id === auth()->id() ? 'text-white' : 'text-gray-800 dark:text-white' }}">
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
        @endif
    </div>
    <livewire:chat.image-modal />
</div>
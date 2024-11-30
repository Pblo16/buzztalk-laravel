<div class="p-4 border-t dark:border-gray-800">
    @if($attachments && count($attachments) > 0)
    <div class="mt-2 text-sm text-gray-500 absolute -translate-y-11 flex overflow-x-auto">
        @foreach($attachments as $attachment)
        <div>
            {{ $attachment->getClientOriginalName() }}
            <button wire:click="removeAttachment({{ $loop->index }})" class="text-red-500 ml-2">&times;</button>
        </div>
        @endforeach
    </div>
    @endif
    <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
        <div class="relative">
            <input type="file" id="attachment" wire:model="attachments" x-ref="fileInput" class="hidden"
                accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,image/*" multiple>
            <label for="attachment" x-data @click.prevent="$refs.fileInput.click()"
                class="cursor-pointer hover:bg-gray-600 text-white rounded-sm p-2 inline-block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                </svg>
            </label>
        </div>

        <input type="text" wire:model.defer="message" wire:key="message-input-{{ now() }}"
            class="w-full bg-transparent px-4 py-2 focus:outline-none border-0" placeholder="Type a message...">

        <button type="submit" class=" hover:bg-gray-600 text-white p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
        </button>
    </form>


</div>
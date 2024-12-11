<div class="px-2 py-4 border-t dark:border-gray-800 bg-[#D4D4D8]/40 dark:bg-[#333333]/60 mx-2 rounded-lg mb-12 md:mb-0">
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
        <textarea wire:model.defer="message" wire:key="message-input-{{ now() }}" x-data="{
                resize() {
                    $el.style.height = '40px';
                    $el.style.height = $el.scrollHeight + 'px'
                }
            }" x-init="resize()" @input="resize()"
            class="w-full rounded-lg px-4 py-2 focus:outline-none border-0 bg-white dark:bg-[#252525] resize-none overflow-y-auto"
            style="max-height: 150px; min-height: 40px;" placeholder="Type a message..." rows="1"></textarea>
        <div class="flex mb-0 align-bottom">
            <input type="file" id="attachment" wire:model="attachments" x-ref="fileInput" class="hidden"
                accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.txt" multiple>
            <label for="attachment" x-data @click.prevent="$refs.fileInput.click()"
                class="cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-600 text-black dark:text-white rounded-sm p-2 ">
                <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M9 10C10.1046 10 11 9.10457 11 8C11 6.89543 10.1046 6 9 6C7.89543 6 7 6.89543 7 8C7 9.10457 7.89543 10 9 10Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M2.66992 18.9501L7.59992 15.6401C8.38992 15.1101 9.52992 15.1701 10.2399 15.7801L10.5699 16.0701C11.3499 16.7401 12.6099 16.7401 13.3899 16.0701L17.5499 12.5001C18.3299 11.8301 19.5899 11.8301 20.3699 12.5001L21.9999 13.9001"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <button type="submit"
                class="hover:bg-gray-300 dark:hover:bg-gray-600hover:bg-gray-300 dark:hover:bg-gray-600 text-white p-2 rounded-lg">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.2899 9.17005L7.6999 3.07005C4.9499 1.62005 1.9599 4.55005 3.3499 7.33005L4.9699 10.57C5.4199 11.47 5.4199 12.53 4.9699 13.43L3.3499 16.67C1.9599 19.45 4.9499 22.37 7.6999 20.93L19.2899 14.83C21.5699 13.63 21.5699 10.37 19.2899 9.17005Z"
                        stroke="#9377F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </form>
</div>
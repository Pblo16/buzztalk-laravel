<div class="flex flex-1 items-center justify-center min-h-[calc(100vh-5rem)]">
    <div x-data="{ 
        step: 1,
        uploading: false,
        progress: 0,
        handleDrop(e) {
            e.preventDefault();
            const input = this.$refs.mediaInput;
            input.files = e.dataTransfer.files;
            input.dispatchEvent(new Event('change'));
        }
    }" x-on:media-uploaded.window="step = 2" class="max-w-4xl w-full">
        <!-- Step 1: Media Upload -->
        <div x-show="step === 1" class="bg-white dark:bg-[#333] rounded-lg shadow-md p-6 h-96">
            <h2 class="text-xl font-semibold mb-4 dark:text-white">Create new post</h2>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center"
                @dragover.prevent="$el.classList.add('border-blue-500')"
                @dragleave.prevent="$el.classList.remove('border-blue-500')"
                @drop.prevent="handleDrop($event); $el.classList.remove('border-blue-500')">

                <input type="file" wire:model="media" x-ref="mediaInput"
                    accept="video/mp4,video/quicktime,image/jpeg,image/png,image/gif" class="hidden" id="mediaInput">

                <label for="mediaInput" class="cursor-pointer w-full h-full flex flex-col items-center justify-center">
                    <div class="space-y-4">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                        <p class="text-gray-500">Drag photos and videos here</p>
                        <button type="button" onclick="document.getElementById('mediaInput').click()"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Select from computer
                        </button>
                    </div>
                </label>
            </div>

            <!-- Progress Bar -->
            <div wire:loading wire:target="media" class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full w-full animate-pulse"></div>
                </div>
                <p class="text-sm text-center mt-2">Uploading...</p>
            </div>
        </div>

        <!-- Step 2: Preview and Edit -->
        <div x-show="step === 2" class="bg-white dark:bg-[#333] rounded-lg shadow-md h-96">
            <div class="flex">
                <div class="w-1/3 max-h-96 bg-black">
                    @if ($media)
                    @if (str_starts_with($media->getMimeType(), 'video/'))
                    <video controls class="w-full h-full object-contain">
                        <source src="{{ $media->temporaryUrl() }}" type="video/mp4">
                    </video>
                    @else
                    <img src="{{ $media->temporaryUrl() }}" class="w-full h-full object-contain">
                    @endif
                    @endif
                </div>
                <div class="w-2/3 p-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <img src="{{ auth()->user()->profile_photo_url }}" class="w-8 h-8 rounded-full">
                            <span class="ml-2 font-semibold dark:text-white">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                    <textarea wire:model="caption"
                        class="w-full h-32 p-2 border rounded-md resize-none dark:bg-[#252525] dark:text-white"
                        placeholder="Write a caption..."></textarea>
                </div>
            </div>
            <div class="p-4 border-t flex justify-between">
                <button type="button" x-on:click="step = 1" class="px-4 py-2 text-gray-600 hover:text-[#333]">
                    Back
                </button>
                <button type="button" wire:click="save"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Share
                </button>
            </div>
        </div>
    </div>
</div>
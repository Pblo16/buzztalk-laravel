<div class="flex h-full items-center justify-center">
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="max-w-96 min-h-80 mx-auto p-4 bg-white shadow-md rounded-lg">
            <textarea wire:model="caption" placeholder="Add a caption..."
                class="block w-full mt-2 p-2 border rounded-md resize-none"></textarea>
            @error('caption') <span class="error text-red-500">{{ $message }}</span> @enderror

            <div x-data="{ uploading: false, progress: 0, preview: null }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                @if ($media)
                <div class="flex space-x-2 mt-4">
                    @if (str_starts_with($media->getMimeType(), 'video/'))
                    <video controls class="w-full aspect-square object-cover rounded">
                        <source src="{{ $media->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @else
                    <img src="{{ $media->temporaryUrl() }}" class="w-full aspect-square object-cover rounded">
                    @endif
                </div>
                @endif

                <input type="file" wire:model="media"
                    accept=".mp4,.mov,.jpg,.jpeg,.png,.gif"
                    class="w-full text-sm text-gray-500 mt-4 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                <!-- Barra de Progreso -->
                <div x-show="uploading" class="mt-3">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                            x-bind:style="`width: ${progress}%`"></div>
                    </div>
                    <p class="text-sm text-gray-500 text-center" x-text="`${progress}%`"></p>
                </div>

                @error('media') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Save</button>
        <div wire:loading wire:target="save" class="text-center mt-2 text-blue-500">Processing...</div>
    </form>
</div>
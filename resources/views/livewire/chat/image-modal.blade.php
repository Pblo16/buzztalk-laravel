<div>
    @if($show)
    <div class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-[70]"
         x-init="document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                @this.closeModal()
            }
         })"
    >
        <div class="fixed inset-0 transform transition-opacity" 
             wire:click="closeModal">
            <div class="absolute inset-0 bg-black opacity-75"></div>
        </div>

        <div class="relative flex justify-center items-center w-full h-full">
            <button type="button" 
                    wire:click="closeModal"
                    class="absolute top-4 right-4 text-white text-2xl z-[71] hover:text-gray-300">
                &times;
            </button>

            <img src="{{ $currentImage }}" 
                 class="max-w-[90%] max-h-[90vh] object-contain"
                 alt="Modal image">

            @if(count($images) > 1)
            <div class="absolute inset-x-0 bottom-4 flex justify-center gap-4">
                <button type="button" 
                        wire:click="previousImage"
                        class="p-2 text-white bg-black/50 rounded-full hover:bg-black/75">
                    &larr;
                </button>
                <button type="button" 
                        wire:click="nextImage"
                        class="p-2 text-white bg-black/50 rounded-full hover:bg-black/75">
                    &rarr;
                </button>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
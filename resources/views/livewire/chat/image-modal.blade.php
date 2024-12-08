<div>
    @if($show)
    <div class="fixed inset-0 z-[70] flex items-center justify-center bg-black/75">
        <button wire:click="closeModal" class="absolute top-4 right-4 text-white text-2xl z-[71]">&times;</button>

        <div class="relative flex justify-center items-center w-full h-full">
            <img src="{{ $currentImage }}" class="max-w-[90%] max-h-[90vh] object-contain">

            <div class="absolute inset-x-0 bottom-4 flex justify-center gap-4">
                <button wire:click="previousImage" class="p-2 text-white bg-black/50 rounded-full">&larr;</button>
                <button wire:click="nextImage" class="p-2 text-white bg-black/50 rounded-full">&rarr;</button>
            </div>
        </div>
    </div>
    @endif
</div>
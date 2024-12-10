<div class="flex flex-col items-center gap-4 h-full w-full overflow-y-auto snap-y snap-mandatory px-4 sm:px-0" x-data="{ 
        observeVideo(videoElement) {
            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        videoElement.play();
                        @this.incrementViews(videoElement.dataset.postId);
                    } else {
                        videoElement.pause();
                    }
                });
            }, { threshold: 0.7 });
            
            observer.observe(videoElement);
        }
     }">
    @if(count($videos) > 0)
    @foreach($videos as $video)
    <div
        class="snap-start sm:min-h-[calc(100dvh-130px)] md:min-h-[calc(100dvh-10px)] min w-full sm:max-w-[480px] md:max-w-[480px] aspect-[9/16] relative">
        <video class="w-full h-full object-cover rounded-lg shadow-lg" x-init="observeVideo($el)"
            data-post-id="{{ $video->id }}" loop controls playsinline
            src="{{ Storage::url($video->media_path) }}"></video>

        <div class="absolute bottom-0 left-0 p-4 w-full bg-gradient-to-t from-black/60 to-transparent text-white">
            <div class="flex items-center gap-2">
                <img src="{{ $video->user->profile_photo_url }}" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full">
                <span class="font-bold text-sm sm:text-base">{{ $video->user->name }}</span>
            </div>
            <p class="mt-2 text-sm sm:text-base">{{ $video->caption }}</p>
            <div class="text-xs sm:text-sm mt-1 opacity-75">{{ $video->views }} views</div>
        </div>
    </div>
    @endforeach

    @if($hasMorePages)
    <div class="py-8 w-full flex items-center justify-center -translate-y-24" wire:key="loader">
        <div x-intersect.threshold.50="$wire.loadMore()" class="h-10 flex items-center">
            <div wire:loading.remove wire:target="loadMore">
                <span class="text-gray-500">Cargando más videos...</span>
            </div>
            <div wire:loading wire:target="loadMore">
                <svg class="animate-spin h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="flex items-center justify-center h-full">
        <p class="text-gray-500">No hay videos disponibles</p>
    </div>
    @endif
</div>
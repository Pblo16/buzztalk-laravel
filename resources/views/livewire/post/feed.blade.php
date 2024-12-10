<div class="max-w-7xl  md:mx-20 lg:mx-40">
    <!-- Header del evento -->
    <div class="shadow mb-6 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-center mb-2 dark:text-white">BuzzTalk Gallery</h1>
        <p class="text-gray-600 dark:text-gray-400 text-center">Explora todo el contenido de la comunidad</p>
    </div>

    <!-- Grid de contenido -->
    <div class="grid grid-cols-3 gap-4 px-4">
        @foreach($posts as $post)
        <div class="group relative rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
            wire:click="showPostModal({{ $post->id }})">
            <div class="aspect-square">
                @if($post->media_type === 'video')
                <video class="w-full h-full object-cover" muted loop preload="metadata" x-data="{}"
                    @mouseenter="$el.play()" @mouseleave="$el.pause(); $el.currentTime = 0;">
                    <source src="{{ $post->media_url }}" type="video/mp4">
                </video>
                <div class="absolute top-2 right-2 bg-black bg-opacity-50 rounded-full p-2">
                    <i class="fas fa-play text-white"></i>
                </div>
                @else
                <img src="{{ $post->media_url }}" alt="Post" class="w-full h-full object-cover">
                @endif
            </div>

            <!-- Overlay con información -->
            {{-- <div
                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 text-white text-center">
                    <div class="flex items-center space-x-4">
                        <div>
                            <i class="fas fa-heart"></i>
                            <span>{{ $post->likes_count ?? 0 }}</span>
                        </div>
                        <div>
                            <i class="fas fa-comment"></i>
                            <span>{{ $post->comments_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        @endforeach
    </div>

    <livewire:profile.post-modal />
</div>
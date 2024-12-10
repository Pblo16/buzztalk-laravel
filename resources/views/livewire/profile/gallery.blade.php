<div>
    <div class="grid grid-cols-3 sm:grid-cols-3 gap-2 px-6 lg:px-0">
        @foreach($posts as $post)
        <div class="aspect-square relative group cursor-pointer" wire:click="showPostModal({{ $post->id }})">
            @if($post->media_type === 'video')
            <video class="w-full h-full object-cover" muted loop preload="metadata" x-data="{}" @mouseenter="$el.play()"
                @mouseleave="$el.pause(); $el.currentTime = 0;">
                <source src="{{ $post->media_url }}" type="video/mp4">
            </video>
            <div class="absolute top-2 right-2">
                <i class="fas fa-video text-white"></i>
            </div>
            @else
            <img src="{{ $post->media_url }}" alt="Post" class="w-full h-full object-cover">
            @endif
        </div>
        @endforeach
    </div>

    @livewire('profile.post-modal')
</div>
<div>
    <div x-data="{ 
            show: @entangle('show'),
            resetContent() {
                if (this.show) {
                    $nextTick(() => {
                        const video = this.$el.querySelector('video');
                        if (video) {
                            video.load();
                            video.currentTime = 0;
                        }
                    });
                }
            }
        }" x-show="show" x-on:keydown.escape.window="show = false" x-effect="resetContent()"
        class="fixed inset-0 z-[70] overflow-y-auto flex items-center justify-center" style="display: none;">
        <div class="min-h-screen w-full px-4 text-center flex items-center justify-center">
            <div x-show="show" class="fixed inset-0 transition-opacity" x-on:click="show = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="inline-block w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg text-left shadow-xl transform transition-all align-middle">
                @if($post)
                <div class="flex max-h-[85vh]">
                    <div class="w-2/3 bg-black flex items-center justify-center">
                        @if($post->media_type === 'video')
                        <video class="w-full h-full object-contain" controls>
                            <source src="{{ $post->media_url }}" type="video/mp4" :key="'{{ $post->id }}'">
                        </video>
                        @else
                        <img src="{{ $post->media_url }}" alt="Post" class="w-full h-full object-contain"
                            :key="'{{ $post->id }}'">
                        @endif
                    </div>
                    <div class="w-1/3 p-4 overflow-y-auto">
                        <div class="flex items-center mb-4">
                            <a href="/profile/{{ $post->user->name }}">
                                <img src=" {{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}"
                                    class="w-10 h-10 rounded-full">
                            </a>
                            <span class="ml-2 font-semibold dark:text-white">{{ $post->user->name }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300">{{ $post->caption }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
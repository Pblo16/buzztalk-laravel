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
                        <div class="flex items-center justify-between mb-4">
                            <a class="inline-flex items-center" href="/profile/{{ $post->user->name }}">
                                <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}"
                                    class="w-10 h-10 rounded-full">
                                <span class="ml-2 font-semibold dark:text-white">{{ $post->user->name }}</span>
                            </a>

                            @if($post && $post->user_id === auth()->id())
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="p-2 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800 z-50">
                                    <a href="#" wire:click.prevent="editPost({{ $post->id }})"
                                        class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Edit post
                                    </a>
                                    <a href="#" wire:click.prevent="deletePost({{ $post->id }})"
                                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Delete post
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($isEditing)
                        <div class="mt-4">
                            <textarea wire:model="editableCaption"
                                class="w-full p-2 border rounded-md resize-none dark:bg-gray-700 dark:text-white"
                                rows="4">{{ $editableCaption }}</textarea>
                            <div class="mt-2 flex justify-end space-x-2">
                                <button wire:click="cancelEdit" class="px-3 py-1 text-gray-600 hover:text-gray-800">
                                    Cancel
                                </button>
                                <button wire:click="saveEdit"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Save
                                </button>
                            </div>
                        </div>
                        @else
                        <p class="text-gray-700 dark:text-gray-300">{{ $post->caption }}</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
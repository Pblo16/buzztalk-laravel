<div class="fixed inset-0 z-50 overflow-y-auto" style="display: {{ $show ? 'block' : 'none' }}">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true" wire:click="close">
            <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        </div>

        <div class="inline-block w-full max-w-6xl overflow-hidden align-middle transition-all transform bg-white shadow-xl sm:rounded-lg dark:bg-gray-950"
            style="max-height: 90vh">
            <div class="flex h-full">
                <!-- Media Section -->
                <div class="w-2/3 bg-black" style="max-height: 90vh">
                    @if($postData)
                    @if($postData['media_type'] === 'video')
                    <video class="w-full h-full object-contain" controls>
                        <source src="{{ $postData['media_url'] }}" type="video/mp4">
                    </video>
                    @else
                    <img src="{{ $postData['media_url'] }}" alt="Post" class="w-full h-full object-contain">
                    @endif
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="w-1/3 overflow-y-auto" style="max-height: 90vh">
                    @if($postData)
                    <div class="p-4">
                        <!-- User Info -->
                        <div class="flex items-center mb-4">
                            <img src="{{ $postData['user']['profile_photo_url'] }}" class="w-10 h-10 rounded-full">
                            <div class="ml-3">
                                <div class="font-bold">{{ $postData['user']['name'] }}</div>
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <div class="ml-3">
                                <div class="font-bold">{{ $postData['caption'] }}</div>
                            </div>
                        </div>

                        <!-- Comments Section - Temporarily removed -->
                        <div class="h-96 overflow-y-auto">
                            <!-- Comments will be added later -->
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
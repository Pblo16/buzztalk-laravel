<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4 dark:text-white">Friend Requests</h2>

            @if($pendingRequests->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No pending friend requests.</p>
            @else
            <div class="space-y-4">
                @foreach($pendingRequests as $request)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-neutral-700 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $request->sender->profile_photo_url }}" alt="{{ $request->sender->name }}"
                            class="size-10 rounded-full">
                        <div>
                            <h3 class="text-lg font-medium dark:text-white">{{ $request->sender->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sent you a friend request</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button wire:click="acceptRequest({{ $request->id }})"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Accept
                        </button>
                        <button wire:click="rejectRequest({{ $request->id }})"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-neutral-600 dark:text-white dark:hover:bg-neutral-500">
                            Reject
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<div>
    <div wire:click="toggleModal" class="fixed bottom-0 m-4 p-2 rounded-full bg-[#9377F1] hover:cursor-pointer">
        <svg width="35" height="32" viewBox="0 0 35 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.125 29.3334H21.875C29.1666 29.3334 32.0833 26.6667 32.0833 20.0001V12.0001C32.0833 5.33341 29.1666 2.66675 21.875 2.66675H13.125C5.83329 2.66675 2.91663 5.33341 2.91663 12.0001V20.0001C2.91663 26.6667 5.83329 29.3334 13.125 29.3334Z"
                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M10.6896 19.3199L14.1604 15.1999C14.6562 14.6133 15.575 14.5066 16.2167 14.9599L18.8854 16.8799C19.5271 17.3333 20.4458 17.2266 20.9417 16.6533L24.3104 12.6799"
                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-[70] flex items-center justify-center">
        <div class="bg-white dark:bg-[#252525] rounded-lg p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold dark:text-white">New Conversation</h3>
                <button wire:click="toggleModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="mb-4">
                <label class="flex items-center dark:text-white">
                    <input type="checkbox" wire:model.live="isGroup" class="mr-2">
                    Create Group Chat
                </label>
            </div>

            @if($isGroup)
            <div class="mb-4">
                <input type="text" wire:model="groupName" placeholder="Group Name"
                    class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>
            @endif

            <div class="mb-4">
                <input type="text" wire:model.live="searchTerm" placeholder="Search users..."
                    class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <div class="max-h-60 overflow-y-auto mb-4">
                @foreach($this->availableUsers as $user)
                <div wire:click="toggleUserSelection({{ $user->id }})"
                    class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer flex items-center">
                    <input type="checkbox" @checked(in_array($user->id, $selectedUsers))
                    class="mr-2">
                    <img src="{{ $user->where('id', '=', $user->id )->first()?->profile_photo_url ?? 'https://www.gravatar.com/avatar/?d=mp' }}"
                        alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover mr-2">
                    <span class="dark:text-white">{{ $user->name }}</span>

                </div>
                @endforeach
            </div>

            <button wire:click="createConversation"
                class="w-full bg-[#9377F1] text-white py-2 px-4 rounded hover:bg-[#7559d1]">
                Create Conversation
            </button>
        </div>
    </div>
    @endif
</div>
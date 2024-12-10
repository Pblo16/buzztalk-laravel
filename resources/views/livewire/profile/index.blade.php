<div class="max-w-4xl mx-auto py-8 dark:text-white sm:px-2">
    <!-- Header -->
    <div class="flex items-center gap-8 mb-8 px-10">
        <!-- Profile Image -->
        <div class="w-32 h-32">
            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                class="w-full h-full rounded-full object-cover">
        </div>

        <!-- Profile Info -->
        <div class="flex-1">

            <div class="flex">
                <div>
                    <div class="font-semibold">{{ $user->name }}</div>
                    <p class="text-gray-600">{{ $user->bio ?? 'No bio yet' }}</p>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <h1 class="text-2xl font-semibold">{{ $user->username }}</h1>
                    @if($isOwner)
                    <a href="{{route('profile.show')}}"
                        class="px-4 py-1.5 bg-gray-100 rounded-md font-semibold text-black">Edit Profile</a>
                    

                    @else
                    @switch($requestStatus)
                    @case('pending')
                    <button wire:click="toggleFollow"
                        class="px-4 py-1.5 bg-gray-300 text-black rounded-md font-semibold">Pending</button>
                    @break
                    @case('accepted')
                    <button wire:click="toggleFollow"
                        class="px-4 py-1.5 bg-gray-100 rounded-md font-semibold text-black">Following</button>
                    @break
                    @default
                    <button wire:click="toggleFollow"
                        class="px-4 py-1.5 bg-blue-500 text-white rounded-md font-semibold">Follow</button>
                    @endswitch
                    @endif
                </div>
            </div>

            <div class="flex gap-8 mb-4">
                <div><strong>{{ $user->posts()->count() }}</strong> posts</div>
                <div><strong>{{ $user->followers()->count() }}</strong>
                    <button wire:click="toggleFollowersModal">followers</button>
                </div>
                <div><strong>{{ $user->following()->count() }}</strong>
                    <button wire:click="toggleFollowingModal">following</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Gallery -->
    <livewire:profile.gallery :user="$user" />

    <!-- Followers Modal -->
    <div x-show="$wire.showFollowersModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg max-w-md w-full">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Followers</h2>
                <button wire:click="toggleFollowersModal" class="text-4xl">&times;</button>
            </div>
            <div class="space-y-4">
                @foreach($followers as $follower)
                <div class="flex items-center gap-4">
                    <img src="{{ $follower->profile_photo_url }}" class="w-10 h-10 rounded-full">
                    <div>
                        <div class="font-semibold">{{ $follower->name }}</div>
                        <div class="text-sm text-gray-500">{{ $follower->username }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Following Modal -->
    <div x-show="$wire.showFollowingModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg max-w-md w-full">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Following</h2>
                <button wire:click="toggleFollowingModal" class="text-4xl">&times;</button>
            </div>
            <div class="space-y-4">
                @foreach($following as $follows)
                <div class="flex items-center gap-4">
                    <img src="{{ $follows->profile_photo_url }}" class="w-10 h-10 rounded-full">
                    <div>
                        <div class="font-semibold">{{ $follows->name }}</div>
                        <div class="text-sm text-gray-500">{{ $follows->username }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
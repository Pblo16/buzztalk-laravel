<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use App\Models\FriendRequest;

class Index extends Component
{
    public User $user;
    public $showFollowersModal = false;
    public $showFollowingModal = false;
    public $username;
    public $isFollowing = false;
    public $requestStatus = null;
    public $isOwner = false;  // Add this property

    public function mount($username = null)
    {
        if ($username) {
            $this->user = User::where('name', $username)->firstOrFail();
        } else {
            $this->user = auth()->user();
        }

        $this->isOwner = auth()->check() && $this->user->id === auth()->id();

        if (auth()->check() && !$this->isOwner) {
            $request = FriendRequest::where('sender_id', auth()->id())
                ->where('receiver_id', $this->user->id)
                ->first();
            
            $this->requestStatus = $request ? $request->status : null;
            $this->isFollowing = $request && $request->status === 'accepted';
        }
    }

    public function render()
    {
        $followers = $this->user->followers()->get();
        $following = $this->user->following()->get();

        return view('livewire.profile.index', [
            'followers' => $followers,
            'following' => $following,
            'isOwner' => $this->isOwner,
            'isFollowing' => $this->isFollowing,
            'requestStatus' => $this->requestStatus
        ]);
    }

    public function toggleFollowersModal()
    {
        $this->showFollowersModal = !$this->showFollowersModal;
    }

    public function toggleFollowingModal()
    {
        $this->showFollowingModal = !$this->showFollowingModal;
    }

    public function toggleFollow()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $existingRequest = FriendRequest::where('sender_id', auth()->id())
            ->where('receiver_id', $this->user->id)
            ->first();

        if (!$existingRequest) {
            FriendRequest::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $this->user->id,
                'status' => 'pending'
            ]);
            $this->requestStatus = 'pending';
        } else {
            $existingRequest->delete();
            $this->requestStatus = null;
        }
    }
}

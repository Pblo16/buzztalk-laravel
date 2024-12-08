<?php

namespace App\Livewire\Friends;

use App\Models\FriendRequest as FriendRequestModel;
use Livewire\Component;

class FriendRequest extends Component
{
    public function acceptRequest($requestId)
    {
        $request = FriendRequestModel::find($requestId);
        if ($request && $request->receiver_id === auth()->id()) {
            $request->status = 'accepted';
            $request->save();
        }
    }

    public function rejectRequest($requestId)
    {
        $request = FriendRequestModel::find($requestId);
        if ($request && $request->receiver_id === auth()->id()) {
            $request->delete();
        }
    }

    public function render()
    {
        $pendingRequests = FriendRequestModel::with('sender')
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('livewire.friends.friend-request', [
            'pendingRequests' => $pendingRequests
        ]);
    }
}

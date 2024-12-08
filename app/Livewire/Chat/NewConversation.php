<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;

class NewConversation extends Component
{
    public $showModal = false;
    public $isGroup = false;
    public $groupName = '';
    public $selectedUsers = [];
    public $searchTerm = '';

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
        $this->reset(['isGroup', 'groupName', 'selectedUsers', 'searchTerm']);
    }

    public function toggleUserSelection($userId)
    {
        if (in_array($userId, $this->selectedUsers)) {
            $this->selectedUsers = array_diff($this->selectedUsers, [$userId]);
        } else {
            $this->selectedUsers[] = $userId;
        }
    }

    public function createConversation()
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        $conversation = new Conversation();
        if ($this->isGroup) {
            if (empty($this->groupName)) {
                return;
            }
            $conversation->name = $this->groupName;
        }
        $conversation->save();

        // Add current user and selected users to conversation
        $userIds = array_merge($this->selectedUsers, [auth()->id()]);
        $conversation->users()->attach($userIds);

        $this->dispatch('conversation-created', $conversation->id);
        $this->toggleModal();
        return redirect()->route('chats');
    }

    public function getAvailableUsersProperty()
    {
        // Base query for accepted friends
        $query = User::where(function($query) {
                $query->whereHas('sentFriendRequests', function($q) {
                    $q->where('receiver_id', auth()->id())
                      ->where('status', 'accepted');
                })->orWhereHas('receivedFriendRequests', function($q) {
                    $q->where('sender_id', auth()->id())
                      ->where('status', 'accepted');
                });
            })
            ->where('name', 'like', "%{$this->searchTerm}%")
            ->where('id', '!=', auth()->id());

        // If not creating a group, exclude users with existing conversations
        if (!$this->isGroup) {
            $usersWithConversations = Conversation::whereNull('name')
                ->whereHas('users', function($q) {
                    $q->where('users.id', auth()->id());
                })
                ->with('users')
                ->get()
                ->flatMap(fn($conv) => $conv->users->where('id', '!=', auth()->id())->pluck('id'))
                ->unique()
                ->toArray();

            $query->whereNotIn('id', $usersWithConversations);
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.chat.new-conversation', [
            'availableUsers' => $this->availableUsers
        ]);
    }
}

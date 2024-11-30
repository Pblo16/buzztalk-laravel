<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;

class ContactList extends Component
{
    public $activeConversationId = null;
    public $conversations;

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $this->conversations = auth()->user()
            ->conversations()
            ->with(['users', 'lastMessage'])
            ->latest('updated_at')
            ->get();
    }

    #[On('conversation-selected')]
    public function handleConversationSelected($conversationId)
    {
        $this->activeConversationId = $conversationId;
        $this->dispatch('active-conversation-changed', conversationId: $conversationId);
    }

    public function render()
    {
        return view('livewire.chat.contact-list', [
            'conversations' => $this->conversations
        ]);
    }
}

<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class ContactItem extends Component
{
    public Conversation $conversation;
    public bool $active = false;

    public function mount(Conversation $conversation, bool $active = false)
    {
        $this->conversation = $conversation;
        $this->active = $active;
    }

    public function selectConversation()
    {
        $this->active = true;
        $this->dispatch('conversation-selected', $this->conversation->id);
    }

    #[On('active-conversation-changed')]
    public function handleActiveConversationChanged($conversationId)
    {
        $this->active = $this->conversation->id === $conversationId;
    }

    public function dehydrate()
    {
        $this->conversation->load(['users', 'lastMessage']);
    }

    public function shouldSkipRender(): bool
    {
        return true;
    }

    #[Locked]
    public function render()
    {
        return view('livewire.chat.contact-item');
    }
}

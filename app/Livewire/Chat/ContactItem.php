<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Livewire\Attributes\Computed;

class ContactItem extends Component
{
    public $conversation;
    public $active;
    public $conversationId;

    public function mount(Conversation $conversation, $active = false)
    {
        $this->conversation = $conversation;
        $this->conversationId = $conversation->id;
        $this->active = $active;
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->conversationId},MessageSent" => 'refreshConversation',
            'active-conversation-changed' => 'handleActiveChange'
        ];
    }

    public function refreshConversation()
    {
        $this->conversation = Conversation::with(['lastMessage', 'users'])->find($this->conversationId);
    }

    public function handleActiveChange($conversationId)
    {
        $this->active = $this->conversationId == $conversationId;
    }

    public function setActiveConversation()
    {
        $this->dispatch('conversation-selected', conversationId: $this->conversationId);
    }

    public function render()
    {
        return view('livewire.chat.contact-item');
    }
}

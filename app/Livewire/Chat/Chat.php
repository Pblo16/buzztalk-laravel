
<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;

class Chat extends Component
{
    // ...existing code...

    public function onConversationSelected($conversationId)
    {
        $this->currentConversation = Conversation::findOrFail($conversationId);
    }

    #[On('conversation-selected')]
    public function setActiveConversation($conversationId)
    {
        $this->onConversationSelected($conversationId);
    }

    // ...existing code...
}
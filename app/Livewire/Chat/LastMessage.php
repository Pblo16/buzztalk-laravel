<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Livewire\Attributes\On;

class LastMessage extends Component
{
    public $conversationId;
    public $lastMessage;

    public function mount(Conversation $conversation)
    {
        $this->conversationId = $conversation->id;
        $this->updateLastMessage($conversation);
    }

    private function updateLastMessage($conversation)
    {
        $this->lastMessage = $conversation->lastMessage?->content ?? 'No messages yet';
    }

    #[On('refresh-contact')]
    #[On('conversations-refreshed')]
    public function refreshMessage()
    {
        $conversation = Conversation::find($this->conversationId);
        if ($conversation) {
            $conversation->load('lastMessage');
            $this->updateLastMessage($conversation);
        }
    }

    public function getListeners()
    {
        return [
            "echo-private:conversation.{$this->conversationId},MessageSent" => 'refreshMessage',
            'conversations-refreshed' => 'refreshMessage',
            'messages-updated' => 'refreshMessage'
        ];
    }

    public function render()
    {
        return view('livewire.chat.last-message');
    }
}

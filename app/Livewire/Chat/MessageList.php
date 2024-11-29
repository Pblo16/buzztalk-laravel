<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;

class MessageList extends Component
{
    public $conversation;

    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->conversation->id},MessageSent" => 'refreshMessages',
        ];
    }

    public function refreshMessages()
    {
        $this->conversation = $this->conversation->fresh(['messages.user']);
    }

    public function render()
    {
        return view('livewire.chat.message-list', [
            'messages' => $this->conversation->messages()
                ->with(['user', 'attachments' => function($query) {
                    $query->whereNotNull('path');
                }])
                ->orderBy('created_at', 'asc')
                ->get()
        ]);
    }
}

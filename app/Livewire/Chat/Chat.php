<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public ?Conversation $currentConversation = null;

    protected $listeners = [
        'conversation-selected' => 'setActiveConversation'
    ];

    public function getListeners()
    {
        return [
            "echo-private:conversation.{$this->currentConversation?->id},MessageSent" => 'refreshMessages',
            'conversation-selected' => 'setActiveConversation',
        ];
    }

    public function mount()
    {
        $firstConversation = Auth::user()
            ->conversations()
            ->latest()
            ->first();

        if ($firstConversation) {
            $this->setActiveConversation($firstConversation->id);
        }
    }

    public function setActiveConversation($conversationId)
    {
        if ($this->currentConversation && $this->currentConversation->id == $conversationId) {
            return;
        }

        try {
            $this->currentConversation = auth()->user()
                ->conversations()
                ->where('conversations.id', $conversationId)
                ->with(['users'])
                ->firstOrFail();
        } catch (\Exception $e) {
            $this->currentConversation = null;
        }
    }

    public function render()
    {
        return view('livewire.chat.chat', [
            'conversations' => $this->conversations ?? []
        ]);
    }
}

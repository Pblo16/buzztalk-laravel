<?php

namespace App\Livewire\Pages;

use App\Models\Conversation;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class Chat extends Component
{
    public $currentConversation = null;
    public $message = '';

    public function getListeners()
    {
        return $this->currentConversation ? [
            "echo-private:chat.{$this->currentConversation->id},MessageSent" => 'refreshMessages',
        ] : [];
    }

    public function refreshMessages()
    {
        // Only refresh messages, not the entire component
        $this->dispatch('messages-updated');
    }

    public function mount($conversationId = null)
    {
        if ($conversationId) {
            $this->setActiveConversation($conversationId);
        } else {
            $this->currentConversation = Auth::user()->conversations()->latest()->first();
        }
    }

    #[On('conversation-selected')]
    public function setActiveConversation($conversationId)
    {
        $this->currentConversation = Conversation::with(['messages', 'users'])->find($conversationId);
        $this->dispatch('active-conversation-changed', $conversationId);
    }

    public function sendMessage()
    {
        $this->validate(['message' => 'required|min:1']);

        $message = $this->currentConversation->messages()->create([
            'content' => $this->message,
            'user_id' => Auth::id(),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->message = '';
        $this->dispatch('message-sent');
    }

    public function onConversationSelected($conversationId)
    {
        $this->currentConversation = Conversation::findOrFail($conversationId);
    }

    public function render()
    {
        return view('livewire.pages.chat', [
            'conversations' => Auth::user()->conversations()->with(['lastMessage', 'users'])->latest()->get(),
            'messages' => $this->currentConversation
                ? $this->currentConversation->messages()->orderBy('created_at', 'asc')->get()
                : collect(),
        ]);
    }
}

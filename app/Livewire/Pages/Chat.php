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
            "echo-private:conversations.{$this->currentConversation->id},MessageSent" => 'refreshMessages',
        ] : [];
    }

    public function mount($conversationId = null)
    {
        if ($conversationId) {
            $this->setActiveConversation($conversationId);
        } else {
            $this->currentConversation = Auth::user()->conversations()->latest()->first();
        }
    }

    public function setActiveConversation($conversationId)
    {
        $this->currentConversation = Conversation::findOrFail($conversationId);
        $this->message = '';
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
        $this->dispatch('messageReceived');
    }

    #[On('messageReceived')]
    public function refreshMessages()
    {
        // This method is now automatically called when 'messageReceived' event is dispatched
    }

    public function render()
    {
        return view('livewire.pages.chat', [
            'conversations' => Auth::user()->conversations()->latest()->get(),
            'messages' => $this->currentConversation
                ? $this->currentConversation->messages()->orderBy('created_at', 'asc')->get()
                : collect(),
        ]);
    }
}

<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Livewire\Attributes\On;

class MessageList extends Component
{
    public $conversationId;
    public $conversation;
    public $messages;

    public function mount(Conversation $conversation)
    {
        $this->conversationId = $conversation->id;
        $this->conversation = $conversation;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->conversation) return;

        $this->messages = $this->conversation
            ->messages()
            ->with(['user', 'attachments'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getListeners()
    {
        if (!$this->conversationId) return [];
        
        return [
            "echo-private:conversation.{$this->conversationId},MessageSent" => 'handleNewMessage',
            'messageSent' => 'handleNewMessage',
            'messages-updated' => 'loadMessages',
            'open-image-modal' => 'openImageModal'
        ];
    }

    public function handleNewMessage($event = null)
    {
        $this->loadMessages();
        $this->dispatch('messages-updated');
        $this->dispatch('conversations-refreshed');
    }

    #[On('conversation-selected')]
    public function handleConversationChange($conversationId)
    {
        try {
            $newConversation = Conversation::with(['users', 'lastMessage'])->find($conversationId);
            if ($newConversation) {
                $this->conversationId = $conversationId;
                $this->conversation = $newConversation;
                $this->loadMessages();
                $this->dispatch('conversation-changed', $conversationId);
            }
        } catch (\Exception $e) {
            $this->conversation = null;
            $this->messages = collect([]);
        }
    }

    #[On('messages-updated')]
    public function refreshMessages()
    {
        $this->loadMessages();
        $this->dispatch('$refresh');
    }

    public function dehydrate()
    {
        if ($this->conversation) {
            $this->conversation->load(['users', 'lastMessage', 'messages.user', 'messages.attachments']);
        }
    }

    public function hydrate()
    {
        if ($this->conversation) {
            $this->conversation = Conversation::with(['users', 'lastMessage'])->find($this->conversation->id);
        }
    }

    public function render()
    {
        return view('livewire.chat.message-list', [
            'messages' => $this->messages
        ]);
    }

    public function placeholder()
    {
        return view('livewire.chat.message-list-placeholder');
    }

    public function openImageModal($data)
    {
        $this->dispatch('open-modal', 
            image: $data['image'], 
            allImages: $data['images'], 
            index: $data['index']
        );
    }
}

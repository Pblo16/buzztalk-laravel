<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

class MessageList extends Component
{
    public $conversationId;
    public $conversation;
    public $messages;
    protected $lastUpdate;

    public function mount(Conversation $conversation)
    {
        $this->conversationId = $conversation->id;
        $this->conversation = $conversation;
        $this->messages = new Collection(); // Inicializar como colección vacía
        $this->lastUpdate = now();
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->conversation) {
            $this->messages = new Collection();
            return;
        }

        $messages = $this->conversation
            ->messages()
            ->with(['user', 'attachments'])
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isNotEmpty()) {
            $this->messages = $messages;
            $this->lastUpdate = now();
            $this->dispatch('chat-messages-updated');
            $this->dispatch('scrollToBottom');
        }
    }

    public function getListeners()
    {
        if (!$this->conversationId) return [];

        return [
            "echo-private:conversation.{$this->conversationId},.MessageSent" => 'handleNewMessage',
            'messageSent' => 'handleNewMessage',
            'messages-updated' => 'loadMessages'
        ];
    }

    public function handleNewMessage($event = null)
    {
        try {
            $this->loadMessages();
            // Emitimos el evento después de que los mensajes se hayan cargado
            $this->dispatch('messages-received')->self();
            $this->dispatch('scrollToBottom');
        } catch (\Exception $e) {
            \Log::error('Error handling new message: ' . $e->getMessage());
        }
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
                $this->dispatch('scrollToBottom');
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
    }

    public function dehydrate()
    {
        // Eliminar la actualización automática en dehydrate
        if ($this->conversation) {
            $this->conversation->load(['users', 'lastMessage']);
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

    public function openImageModal($payload)
    {
        $image = $payload['image'];
        $images = is_array($payload['images']) ? $payload['images'] : $payload['images']->toArray();

        $images = array_map(function ($path) {
            return Storage::url($path);
        }, $images);

        $this->dispatch('show-image-modal', [
            'image' => $image,
            'images' => $images,
            'index' => $payload['index']
        ]);
    }
}

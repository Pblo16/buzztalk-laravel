<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessageInput extends Component
{
    use WithFileUploads;

    public $conversation;
    public $message = '';
    public $attachments = []; // Changed from $attachment to $attachments array

    public function mount($conversation)
    {
        $this->conversation = $conversation;
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'nullable|string',
            'attachments.*' => 'required_without:message|file|max:20480|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx,txt',
        ]);

        if (empty($this->message) && empty($this->attachments)) {
            return;
        }

        $message = $this->conversation->messages()->create([
            'content' => $this->message,
            'user_id' => Auth::id(),
        ]);

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('attachments', 'public');
                $message->attachments()->create([
                    'path' => $path,
                    'name' => $attachment->getClientOriginalName(),
                    'type' => $attachment->getMimeType(),
                    'size' => $attachment->getSize()
                ]);
            }
        }

        event(new MessageSent($message));

        $this->conversation = $this->conversation->fresh(['lastMessage', 'users']);
        $this->message = '';
        $this->attachments = [];
        
        // Update these dispatches
        $this->dispatch('messageSent');
        $this->dispatch('messages-updated');
        $this->dispatch('conversations-refreshed');
    }

    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function render()
    {
        return view('livewire.chat.message-input');
    }
}

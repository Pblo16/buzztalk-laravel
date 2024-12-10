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
        try {
            $this->validate([
                'message' => 'nullable|string',
                'attachments.*' => 'required_without:message|file|max:51200|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx,txt,mp4,mov,avi,wmv',
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

            try {
                broadcast(new MessageSent($message))->toOthers();
            } catch (\Exception $e) {
                // Log broadcasting error but continue with local updates
                \Log::error('Broadcasting error: ' . $e->getMessage());
            }

            $this->conversation = $this->conversation->fresh(['lastMessage', 'users']);
            $this->message = '';
            $this->attachments = [];
            
            $this->dispatch('messageSent');
            $this->dispatch('messages-updated');
            $this->dispatch('conversations-refreshed');

        } catch (\Exception $e) {
            \Log::error('Message sending error: ' . $e->getMessage());
            session()->flash('error', 'Failed to send message. Please try again.');
        }
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

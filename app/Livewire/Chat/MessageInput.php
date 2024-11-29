<?php
namespace App\Livewire\Chat;
use Livewire\Component;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessageInput extends Component
{
    public $conversation;
    public $message = '';

    public function mount($conversation)
    {
        $this->conversation = $conversation;
    }

    public function sendMessage()
    {
        $this->validate(['message' => 'required|min:1']);

        $message = $this->conversation->messages()->create([
            'content' => $this->message,
            'user_id' => Auth::id(),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->message = '';
        $this->dispatch('messageReceived');
    }

    public function render()
    {
        return view('livewire.chat.message-input');
    }
}

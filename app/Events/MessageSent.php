<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Message $message) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("conversation.{$this->message->conversation_id}")
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => array_merge(
                $this->message->toArray(),
                [
                    'user' => $this->message->user,
                    'attachments' => $this->message->attachments
                ]
            ),
            'conversation_id' => $this->message->conversation_id,
            'timestamp' => now()->toISOString()
        ];
    }

    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}

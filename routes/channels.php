<?php

use Illuminate\Support\Facades\Broadcast;

// ...existing code...

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    return $user->conversations()->where('conversations.id', $conversationId)->exists();
});

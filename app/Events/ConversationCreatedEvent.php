<?php

namespace App\Events;

use App\Conversation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversationCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $conversation;

    public function __construct (Conversation $conversation) {
        $this->conversation = $conversation;
    }

    public function broadcastOn () {
        return;
    }
}

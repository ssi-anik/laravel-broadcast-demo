<?php

namespace App\Events;

use App\Conversation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversationStartedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $conversation, $initiator, $receiver;

    public function __construct (Conversation $conversation, int $initiator, int $receiver) {
        $this->conversation = $conversation;
        $this->initiator = $initiator;
        $this->receiver = $receiver;
    }

    public function broadcastWith () {
        return [
            'type'            => 'connecting',
            'conversation_id' => $this->conversation->id,
            'initiator'       => $this->initiator,
        ];
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastAs () {
        return 'started';
    }

    public function broadcastOn () {
        return new PrivateChannel('conversation-phases-' . $this->receiver);
    }
}

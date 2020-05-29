<?php

namespace App\Events;

use App\Conversation;
use App\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageReceivedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $conversation;
    private $message;

    public function __construct (Conversation $conversation, Message $message) {
        $this->conversation = $conversation;
        $this->message = $message;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastAs () {
        return 'message-received';
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastWith () {
        return [
            'id'      => $this->conversation->id,
            'sender'  => $this->message->sender_id,
            'message' => $this->message->message,
            'on'      => $this->message->created_at->diffForHumans(),
        ];
    }

    public function broadcastOn () {
        return new PrivateChannel('conversation-' . $this->conversation->id);
    }
}

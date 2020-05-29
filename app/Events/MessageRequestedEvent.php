<?php

namespace App\Events;

use App\Conversation;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageRequestedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $sender, $conversation, $receiver;

    public function __construct (Conversation $conversation, int $sender) {
        $this->conversation = $conversation;
        $this->sender = $sender;
        $this->receiver = $conversation->by != $sender ? $conversation->by : $sender;
    }

    public function broadcastWith () {
        return [
            'sender_name' => User::find($this->sender)->name,
            'sender_id'   => $this->sender,
        ];
    }

    public function broadcastAs () {
        return 'message-received';
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastOn () {
        return new PrivateChannel('conversation-receiver-' . $this->receiver);
    }
}

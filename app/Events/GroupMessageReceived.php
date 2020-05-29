<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $data;

    public function __construct ($data) {
        $this->data = $data;
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastAs () {
        return 'group-message-received';
    }

    public function broadcastWith () {
        return $this->data;
    }

    public function broadcastOn () {
        return new PresenceChannel('group-conversation');
    }
}

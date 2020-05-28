<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $type, $user;

    public function __construct ($type, $user) {
        /*$this->queue = 'broadcasting';*/
        /*$this->broadcastQueue = 'broadcastQueue-variable';*/
        $this->type = $type;
        $this->user = $user;
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastWith () {
        return [
            'id'       => $this->user->id,
            'name'     => $this->user->name,
            'username' => $this->user->username,
            'action'   => ucfirst(strtolower($this->type)),
            'on'       => now()->toDateTimeString(),
        ];
    }

    public function broadcastOn () {
        return new PrivateChannel('activities');
    }
}

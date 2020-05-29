<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActiveUserCount implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function broadcastAs () {
        return 'counter';
    }

    public function broadcastQueue () {
        return 'broadcastable';
    }

    public function broadcastWith () {
        return [
            'active_count' => active_user_count(),
        ];
    }

    public function broadcastOn () {
        return new Channel('active-count');
    }
}

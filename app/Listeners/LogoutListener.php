<?php

namespace App\Listeners;

use App\Events\ActiveUserCount;
use App\Events\ActivityEvent;
use Illuminate\Auth\Events\Logout;

class LogoutListener
{
    public function handle (Logout $event) {
        event(new ActivityEvent('logged out', $event->user));
        decrease_active_user($event->user->id);
        event(new ActiveUserCount());

        /*app('log')->info(json_encode([
            'logout' => [
                'id'       => $event->user->id,
                'username' => $event->user->username,
                'time'     => now(),
            ],
        ]));*/
    }
}

<?php

namespace App\Listeners;

use App\Events\ActiveUserCount;
use App\Events\ActivityEvent;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    public function handle (Login $event) {
        event(new ActivityEvent('logged in', $event->user));
        increase_active_user($event->user->id);
        event(new ActiveUserCount());

        /*app('log')->info(json_encode([
            'login' => [
                'id'       => $event->user->id,
                'username' => $event->user->username,
                'time'     => now(),
            ],
        ]));*/
    }
}

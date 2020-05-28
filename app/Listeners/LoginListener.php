<?php

namespace App\Listeners;

use App\Events\ActivityEvent;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    public function handle (Login $event) {
        event(new ActivityEvent('logged in', $event->user));

        /*app('log')->info(json_encode([
            'login' => [
                'id'       => $event->user->id,
                'username' => $event->user->username,
                'time'     => now(),
            ],
        ]));*/
    }
}

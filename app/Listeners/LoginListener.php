<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LoginListener
{
    public function handle (Login $event) {
        Log::info(json_encode([
            'login' => [
                'id'       => $event->user->id,
                'username' => $event->user->username,
                'time'     => now(),
            ],
        ]));
    }
}

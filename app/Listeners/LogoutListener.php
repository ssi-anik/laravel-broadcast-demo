<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class LogoutListener
{
    public function handle (Logout $event) {
        Log::info(json_encode([
            'logout' => [
                'id'       => $event->user->id,
                'username' => $event->user->username,
                'time'     => now(),
            ],
        ]));
    }
}

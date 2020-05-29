<?php

namespace App\Listeners;

use App\Events\ConversationStartedEvent;

class ConversationStartedEventListener
{
    public function handle (ConversationStartedEvent $event) {
        app('log')->info([ 'conversation-started' => $event->conversation->toArray() ]);
    }
}

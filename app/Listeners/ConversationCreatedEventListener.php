<?php

namespace App\Listeners;

use App\Events\ConversationCreatedEvent;

class ConversationCreatedEventListener
{
    public function handle (ConversationCreatedEvent $event) {
        app('log')->info(json_encode([ 'conversation-created' => $event->conversation->toArray() ]));
    }
}

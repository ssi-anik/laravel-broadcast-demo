<?php

namespace App\Listeners;

use App\Events\MessageReceivedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageReceivedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageReceivedEvent  $event
     * @return void
     */
    public function handle(MessageReceivedEvent $event)
    {
        //
    }
}

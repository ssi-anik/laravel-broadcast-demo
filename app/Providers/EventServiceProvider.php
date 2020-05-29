<?php

namespace App\Providers;

use App\Events\ConversationCreatedEvent;
use App\Events\ConversationStartedEvent;
use App\Events\MessageReceivedEvent;
use App\Listeners\ConversationCreatedEventListener;
use App\Listeners\ConversationStartedEventListener;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use App\Listeners\MessageReceivedEventListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class               => [
            SendEmailVerificationNotification::class,
        ],
        Login::class                    => [
            LoginListener::class,
        ],
        Logout::class                   => [
            LogoutListener::class,
        ],
        ConversationCreatedEvent::class => [
            ConversationCreatedEventListener::class,
        ],
        ConversationStartedEvent::class => [
            ConversationStartedEventListener::class,
        ],
        MessageReceivedEvent::class     => [
            MessageReceivedEventListener::class,
        ],
    ];

    public function boot () {
        parent::boot();

        //
    }
}

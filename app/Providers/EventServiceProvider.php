<?php

namespace App\Providers;

use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class      => [
            LoginListener::class,
        ],
        Logout::class     => [
            LogoutListener::class,
        ],
    ];

    public function boot () {
        parent::boot();

        //
    }
}

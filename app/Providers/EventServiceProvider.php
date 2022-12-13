<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewsStoreEvent;
use App\Listeners\NewsStoreListeners;
use App\Events\NewsUpdateEvent;
use App\Listeners\NewsUpdateListeners;
use App\Events\NewsDeleteEvent;
use App\Listeners\NewsDeleteListeners;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewsStoreEvent::class => [
            NewsStoreListeners::class,
        ],
        NewsUpdateEvent::class => [
            NewsUpdateListeners::class,
        ],
        NewsDeleteEvent::class => [
            NewsDeleteListeners::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

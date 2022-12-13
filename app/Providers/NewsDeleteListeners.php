<?php

namespace App\Providers;

use App\Providers\NewsDeleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsDeleteListeners
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
     * @param  \App\Providers\NewsDeleteEvent  $event
     * @return void
     */
    public function handle(NewsDeleteEvent $event)
    {
        //
    }
}

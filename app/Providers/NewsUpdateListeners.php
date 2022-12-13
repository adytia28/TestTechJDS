<?php

namespace App\Providers;

use App\Providers\NewsUpdateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsUpdateListeners
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
     * @param  \App\Providers\NewsUpdateEvent  $event
     * @return void
     */
    public function handle(NewsUpdateEvent $event)
    {
        //
    }
}

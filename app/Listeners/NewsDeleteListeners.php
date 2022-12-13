<?php

namespace App\Listeners;

use App\Events\NewsDeleteEvent;
use App\Interfaces\ActivityRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsDeleteListeners
{

    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewsDeleteEvent  $event
     * @return void
     */
    public function handle(NewsDeleteEvent $event) {
        $this->activityRepository->deleteActivityLog($event);
    }
}

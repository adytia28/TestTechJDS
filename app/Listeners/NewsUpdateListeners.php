<?php

namespace App\Listeners;

use App\Events\NewsUpdateEvent;
use App\Interfaces\ActivityRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsUpdateListeners
{

    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewsUpdateEvent  $event
     * @return void
     */
    public function handle(NewsUpdateEvent $event) {
        $this->activityRepository->updateActivityLog($event);
    }
}

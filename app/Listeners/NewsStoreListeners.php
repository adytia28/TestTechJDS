<?php

namespace App\Listeners;

use App\Events\NewsStoreEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Interfaces\ActivityRepositoryInterface;

class NewsStoreListeners
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewsStoreEvent $event) {
        $this->activityRepository->createActivityLog($event);
    }
}

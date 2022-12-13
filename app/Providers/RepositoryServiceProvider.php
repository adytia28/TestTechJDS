<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\NewsRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Interfaces\RolesRepositoryInterface;
use App\Repositories\RolesRepository;
use App\Interfaces\ActivityRepositoryInterface;
use App\Repositories\ActivityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
            NewsRepositoryInterface::class, NewsRepository::class,
        );

        $this->app->bind(
            RolesRepositoryInterface::class, RolesRepository::class,
        );

        $this->app->bind(
            ActivityRepositoryInterface::class, ActivityRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

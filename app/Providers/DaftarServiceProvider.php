<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DaftarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Frontend\Event\EventContract::class,
            \App\Repositories\Frontend\Event\EloquentEventRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Event\EventContract::class,
            \App\Repositories\Backend\Event\EloquentEventRepository::class
        );

        $this->app->bind(
            \App\Repositories\Frontend\Participant\ParticipantContract::class,
            \App\Repositories\Frontend\Participant\EloquentParticipantRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Participant\ParticipantContract::class,
            \App\Repositories\Backend\Participant\EloquentParticipantRepository::class
        );
    }
}

<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /**
         * Frontend Events
         */

        /**
         * Authentication Events
         */
        \App\Events\Frontend\Auth\UserLoggedIn::class  => [
            \App\Listeners\Frontend\Auth\UserLoggedInListener::class,
        ],
        \App\Events\Frontend\Auth\UserLoggedOut::class => [
            \App\Listeners\Frontend\Auth\UserLoggedOutListener::class,
        ],
        \App\Events\Frontend\Auth\UserRegistered::class => [
            \App\Listeners\Frontend\Auth\UserRegisteredListener::class,
        ],

        /**
         * Agency Events
         */
        \App\Events\Frontend\Agency\AgencyRegistered::class => [
            \App\Listeners\Frontend\Agency\AgencyRegisteredListener::class,
        ],

        /**
         * Event Events
         */
        \App\Events\Frontend\Event\EventRegistered::class => [
            \App\Listeners\Frontend\Event\EventRegisteredListener::class,
            \App\Listeners\Frontend\Event\SendEmailToOwnerListener::class,
        ],

        /**
         * Participant add to event
         */
        \App\Events\Frontend\Event\EventParticipantRegistered::class => [
            \App\Listeners\Frontend\Event\SendEmailListener::class,
            \App\Listeners\Frontend\Event\UpdateTotalAttendantListener::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}

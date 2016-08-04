<?php

namespace App\Listeners\Frontend\Event;

use App\Events\Frontend\Event\EventRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventRegisteredListener
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
     * @param  EventRegistered  $event
     * @return void
     */
    public function handle(EventRegistered $event)
    {
        //
    }
}

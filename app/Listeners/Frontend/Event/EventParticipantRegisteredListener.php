<?php

namespace App\Listeners\Frontend\Event;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Event\EventParticipantRegistered;

class EventParticipantRegisteredListener
{
	use InteractsWithQueue;

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
     * @param  EventParticipantRegistered  $event
     * @return void
     */
    public function handle(EventParticipantRegistered $event)
    {
        \Log::info('Event with Participants Registered');
    }
}

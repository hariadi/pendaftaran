<?php

namespace App\Listeners\Frontend\Event;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Event\EventParticipantRegistered;

class UpdateTotalAttendantListener
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
     * @param  EventParticipantRegistered  $event
     * @return void
     */
    public function handle(EventParticipantRegistered $event)
    {
        // $e = $event->event;
        // $e->attendant = $e->participants->count();
        // $e->save();
    }
}

<?php

namespace App\Listeners\Frontend\Event;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Event\ParticipantRegistered;

class ParticipantRegisteredListener
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
     * @param  ParticipantRegistered  $event
     * @return void
     */
    public function handle(ParticipantRegistered $event)
    {
        \Log::info('Participant Registered: ' . $event->participant->name);
    }
}

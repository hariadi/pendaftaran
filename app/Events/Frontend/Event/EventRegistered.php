<?php

namespace App\Events\Frontend\Event;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class EventRegistered extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param $event
     * @return void
     */
    public function __construct($event)
    {
		$this->event = $event;
    }
}

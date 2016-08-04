<?php

namespace App\Events\Frontend\Event;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class EventParticipantRegistered extends Event
{
    use SerializesModels;

	public $event;
	public $participants;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $participants)
    {
		$this->event = $event;
		$this->participants = $participants;
    }
}

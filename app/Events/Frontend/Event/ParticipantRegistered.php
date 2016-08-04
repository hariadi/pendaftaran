<?php

namespace App\Events\Frontend\Event;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ParticipantRegistered extends Event
{
    use SerializesModels;

    /**
     * @var $participant
     */
	public $participant;

    /**
     * Create a new event instance.
     *
     * @param $participant
     * @return void
     */
    public function __construct($participant)
    {
		$this->participant = $participant;
    }
}

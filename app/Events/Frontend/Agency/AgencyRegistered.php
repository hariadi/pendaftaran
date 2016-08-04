<?php

namespace App\Events\Frontend\Agency;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class AgencyRegistered extends Event
{
    use SerializesModels;

    /**
     * @var $agency
     */
	public $agency;

    /**
     * Create a new event instance.
     *
     * @param $agency
     * @return void
     */
    public function __construct($agency)
    {
		$this->agency = $agency;
    }
}

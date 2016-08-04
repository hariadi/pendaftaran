<?php

namespace App\Listeners\Frontend\Agency;

use App\Events\AgencyRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Agency\AgencyRegistered;

class AgencyRegisteredListener
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
     * @param  AgencyRegistered  $event
     * @return void
     */
    public function handle(AgencyRegistered $event)
    {
        \Log::info('Agency Registered: ' . $event->agency->name);
    }
}

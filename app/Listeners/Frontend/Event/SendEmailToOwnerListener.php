<?php

namespace App\Listeners\Frontend\Event;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Event\EventRegistered;

class SendEmailToOwnerListener
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
        $subject = $event->event->name;

        Mail::send('frontend.event.emails.owner', [
        	'subject' => $subject, 'event' => $event->event
        ], function($message) use ($event) {

        	$event = $event->event;

        	$message->to($event->user->email, $event->user->name);
            $message->subject($event->name);

        });
    }
}

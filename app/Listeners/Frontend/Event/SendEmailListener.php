<?php

namespace App\Listeners\Frontend\Event;

use App\Models\Event\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Frontend\Event\EventParticipantRegistered;

class SendEmailListener
{
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  EventParticipantRegistered  $event
     * @return void
     */
    public function handle(EventParticipantRegistered $event)
    {
        $subject = $event->event->name;

        if ($event->event->options()->get('notification.owner') && $event->event->options()->get('notification.participant')) {

	        $this->mailer->send('frontend.event.emails.register', [
	            'subject' => $subject, 'event' => $event->event
	        ], function($message) use ($event) {

	        	if ($event->event->options()->get('notification.owner')) {
		            if ($secretariat = $event->event->user) {
		                $message->cc($secretariat->email, $secretariat->name);
		            }
	        	}

	            foreach ($event->participants as $participant) {
	                if (filter_var($participant->email, FILTER_VALIDATE_EMAIL )) {
	                    $message->to($participant->email, $participant->name);
	                }
	            }

	            $message->subject($event->event->name);

	        });

    	}
    }
}

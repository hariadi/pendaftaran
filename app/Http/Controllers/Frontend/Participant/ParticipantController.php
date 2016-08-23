<?php

namespace App\Http\Controllers\Frontend\Participant;

use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance\Attendance;
use App\Repositories\EventRepository;
use App\Models\Participant\Participant;
use App\Repositories\ParticipantRepository;
use App\Models\EventParticipant\EventParticipant;

class ParticipantController extends Controller
{
	protected $participants;
	protected $events;

	public function __construct(ParticipantRepository $participants, EventRepository $events)
	{
		$this->participants = $participants;
		$this->events = $events;
	}

	/**
     * Show the search results and listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
	{
		return redirect()->route('admin.participant.index');
	}

	/**
     * Update assessment thru ajax
     * @param  UpdateProfileRequest $request
     * @return mixed
     */
    public function ajaxAttend(Request $request)
    {
        if (!$request->ajax()) {
            return;
        }

        $inputs = $request->only(['event_id', 'participant_id', 'attend_at']);

        // Find id for pivot table event_participant
        $attend = EventParticipant::whereParticipantId($inputs['participant_id'])
        	->whereEventId($inputs['event_id'])
        	->first();

        if ($attend) {

        	// Check if we already have attendance for this pivot
        	$attendance = Attendance::whereEventParticipantId($attend->id)->whereDate('created_at', '=', Carbon::now()->toDateString())->first();

        	// If we have, delete it. Mean, user or admin toggle for attendance
        	if ($attendance) {

        		$attendance->delete();

	        	return response()->json([
		            'result' => true,
		            'action' => 'delete',
		            'subject' => 'Telah Dikemaskini!',
		            'event' => $inputs['event_id'],
		            'participant' => $inputs['participant_id'],
		            'status' => 'Kehadiran telah dihapus',
		        ]);

        	} else {

        		$attendance = new Attendance;
        		$attendance->event_participant_id = $attend->id;

        		$attend_at = (auth()->user() && $inputs['attend_at'])
	        		? Carbon::parse($inputs['attend_at'])
	        		: Carbon::now();

        		$attendance->created_at = $attend_at;
        		$attendance->save();

		        return response()->json([
		            'result' => true,
		            'action' => 'add',
		            'subject' => 'Hadir!',
		            'event' => $attend->event_id,
		            'participant' => $attend->participant_id,
		            'status' => 'Kehadiran telah disimpan',
		        ]);
        	}
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view('frontend.participant.edit')->withParticipant($participant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEvent(Participant $participant, Event $event)
    {
		$attendances = $participant->attendances;
		$attends = [];



    	foreach ($event->getDateRanges() as $date) {

    		$attends[$date->formatLocalized('%d %b %Y')] = $attendances->filter(function($attend) use ($date) {
				return $date->between($attend->created_at->startOfDay(), $attend->created_at->endOfDay());
			})->first();
    	}

        return view('frontend.participant.editevent')
        	->withParticipant($participant)
        	->withAttends($attends)
        	->withEvent($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $participant->update($request->all());

        return redirect()->back()->withFlashSuccess('Peserta telah dikemaskini');
    }
}

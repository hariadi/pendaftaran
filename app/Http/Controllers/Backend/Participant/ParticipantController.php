<?php

namespace App\Http\Controllers\Backend\Participant;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance\Attendance;
use App\Repositories\EventRepository;
use App\Models\Participant\Participant;
use App\Repositories\ParticipantRepository;
use App\Models\EventParticipant\EventParticipant;
use App\Http\Requests\Backend\Participant\UpdateParticipantRequest;
use App\Http\Requests\Backend\Participant\AjaxAttendParticipantsRequest;

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
    	$input = $request->only(['term', 'cat', 'when', 'view']);

    	$participants = $this->participants->search($input)->paginate();

        return view('backend.participant.index')
        	->withParticipants($participants)
        	->withRequests($input);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant, Request $request)
    {

    	$input = $request->only(['term', 'cat', 'when', 'view', 'by']);

        $events = $this->events->search($input)->paginate();

        return view('backend.participant.edit')
        	->withParticipant($participant)
        	->withEvents($events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        return view('backend.participant.show')->withParticipant($participant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->all());

        return redirect()->route('admin.participant.show', $participant->id)->withFlashSuccess('Maklumat peserta telah dikemaskini');
    }

    /**
     * Update assessment thru ajax
     * @param  UpdateProfileRequest $request
     * @return mixed
     */
    public function ajaxAttend(AjaxAttendParticipantsRequest $request)
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
            $attendance = Attendance::whereEventParticipantId($attend->id)->whereDate('created_at', '=', Carbon::parse($inputs['attend_at'])->toDateString())->first();

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

    public function ajaxAdd(Request $request)
	{
		if (!$request->ajax()) {
            return;
        }

        $inputs = $request->only(['event_id', 'participant_id']);

        // Find id for pivot table event_participant
        $participant = $this->participants->find($inputs['participant_id']);
        $event = $this->events->find($inputs['event_id']);

        if ($participant->isAttendees($event->id)) {
        	$participant->events()->detach($event->id);

        	return response()->json([
	            'result' => true,
	            'action' => 'delete',
	            'subject' => 'Telah Dikemaskini!',
	            'event' => $inputs['event_id'],
	            'participant' => $inputs['participant_id'],
	            'status' => 'Pendaftaran telah dihapus',
	        ]);

        } else {
        	$participant->events()->attach($event->id);

        	return response()->json([
	            'result' => true,
	            'action' => 'add',
	            'subject' => 'Tambah Program',
	            'event' => $event->id,
	            'participant' => $participant->id,
	            'status' => 'Pendaftaran telah disimpan',
	        ]);
        }
	}

	/**
     * Delete participant
     *
     * @param  App\Event  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('admin.participant.index')->withFlashSuccess('Peserta berjaya dihapus.');
    }
}

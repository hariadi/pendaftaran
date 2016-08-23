<?php

namespace App\Http\Controllers\Frontend\Event;

use App\Http\Requests;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Models\Agency\Agency;
use App\Models\Category\Category;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ParticipantRepository;
use App\Events\Frontend\Event\EventRegistered;
use App\Events\Frontend\Event\ParticipantRegistered;
use App\Http\Requests\Backend\Event\UpdateEventRequest;
use App\Http\Requests\Frontend\Event\StoreEventRequest;
use App\Events\Frontend\Event\EventParticipantRegistered;
use App\Http\Requests\Frontend\Event\AddParticipantsRequest;
use App\Http\Requests\Frontend\Event\StoreParticipantsRequest;

class EventController extends Controller
{
    protected $participants;
    protected $events;
    protected $categories;

    public function __construct(
        EventRepository $events,
        CategoryRepository $categories,
        ParticipantRepository $participants
    ) {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
            'addParticipantsByToken',
            'storeParticipantsByToken',
        ]]);

        $this->events = $events;
        $this->categories = $categories;
        $this->participants = $participants;
    }

    /**
     * Show the search results and listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->only(['term', 'cat', 'when', 'view', 'by']);

        $events = $this->events->search($input)->paginate(5);

        $categories = Category::has('events')->get();

        return view('frontend.event.index')
            ->withEvents($events)
            ->withWhens($this->events->getWhens())
            ->withCategories($categories)
            ->withRequests($input);
    }

    public function show($idOrSlug, Request $request)
    {
        $event = $this->events->show($idOrSlug, $request);

        $dates = $event->getDateRanges();

        return view('frontend.event.show')
            ->withEvent($event)
            ->withDates($dates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->events->store($request->all());

        if (!$event->save()) {
            throw new GeneralException('Maaf, aktiviti gagal disimpan.');
        }

        $event->categories()->sync($request->get('categories'));

        event(new EventRegistered($event));

        return redirect()->route('event.show', $event->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $options = $event->options;

        return view('frontend.event.edit')
            ->withEvent($event)
            ->withOptions($options);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        if ( $event->update($request->all()) ) {
            if ($request->get('categories')) {
                $event->categories()->sync($request->get('categories'));
            }

            $this->savePhoto($event, $request);
        }

        return redirect()->route('event.edit', $event->id)->withFlashSuccess('Aktiviti telah dikemaskini');
    }

    protected function savePhoto(Event $event, Request $request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = public_path('img/events');

            $photoname = time() . '_' . $photo->getClientOriginalName();

            $photo->move($destinationPath, $photoname);

            $event->photo = $photoname;
        }

        return $event->save();
    }

    /**
     * Show the form for adding a new participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function addParticipant($idOrSlug)
    {
        $event = $this->events->find($idOrSlug);

        return view('frontend.event.participant')->withEvent($event);
    }

    /**
     * Show the form for adding a new participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function addParticipants($idOrSlug)
    {
        $event = $this->events->find($idOrSlug);

        return view('frontend.event.participants')
            ->withEvent($event);
    }

    /**
     * Show the form for adding a new participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function addParticipantsByToken($token)
    {
        $event = $this->events->token($token);

        if (!$event) {
            return redirect()->route('frontend.index')->withFlashWarning(trans('auth.token_not_found'));
        }

        return view('frontend.event.participants')
            ->withEvent($event);
    }

    /**
     * Store a newly add participant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeParticipant($idOrSlug, Request $request)
    {
        $event = $this->events->find($idOrSlug);

        $inputs = $request->all();

        // Check if user entered new agency
        if (substr($inputs['agency_id'], 0, 4) == 'new:') {
            $userInputAgency = substr($inputs['agency_id'], 4);
            if (!empty($userInputAgency)) {
                $agency = Agency::create([
                    'name' => $userInputAgency,
                    'short' => shorten($userInputAgency)
                ]);
                $inputs['agency_id'] = $agency->id;
            } else {
                $inputs['agency_id'] = null;
            }
        }

        $participant = $this->participants->store($inputs);

        $event->participants()->save($participant);

        return redirect()->route('event.show', $event->id);
    }

    /**
     * Store a newly multiple participants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeParticipantsByToken($idOrSlug, StoreParticipantsRequest $request)
    {
    	return $this->storeParticipants($idOrSlug, $request);
    }

    /**
     * Store a newly multiple participants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeParticipants($idOrSlug, StoreParticipantsRequest $request)
    {
        if (!$event = $this->events->token($idOrSlug)) {
            $event = $this->events->find($idOrSlug);
        }

        $inputs = $request->input();

        // Check if user entered new agency
        if (substr($inputs['agency_id'], 0, 4) == 'new:') {
            $userInputAgency = substr($inputs['agency_id'], 4);
            if (!empty($userInputAgency)) {
                $agency = Agency::firstOrCreate(['name' => $userInputAgency]);
                $inputs['agency_id'] = $agency->id;
            }
        }

        $attendees = [];

        foreach ($inputs['participants'] as $participant) {
            $participant['agency_id'] = $inputs['agency_id'];
            $attendee = $this->participants->store($participant);
            $attendees[] = $attendee;

            // Make sure they only have unique per event
            $event->participants()->detach($attendee);
            $event->participants()->attach($attendee);
        }

        if ($event->options()->get('notification.owner') && $event->options()->get('notification.participant')) {
            event(new EventParticipantRegistered($event, $attendees));
        }

        // why this cause start_at reset to now()
        //$event = $this->countAttendant($event);

        return redirect()
            ->route('event.show', $event->id)
            ->withFlashSuccess('Peserta berjaya didaftarkan. Satu e-mel pemakluman berkenaan program akan dihantar oleh pihak Urus Setia Program.');
    }

    private function countAttendant(Event $event)
    {
        $event->attendant = $event->participants->count();
        $event->save();

        return $event;
    }

    /**
     * Delete event
     *
     * @param  App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('frontend.user.dashboard')->withFlashSuccess('Program berjaya dihapus.');
    }
}

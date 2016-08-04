<?php

namespace App\Http\Controllers\Backend\Event;

use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\CategoryRepository;
use App\Http\Requests\Backend\Event\StoreEventRequest;
use App\Http\Requests\Backend\Event\UpdateEventRequest;

class EventController extends Controller
{
    protected $events;
    protected $categories;

    public function __construct(EventRepository $events, CategoryRepository $categories)
    {
        $this->events = $events;
        $this->categories = $categories;
    }

    /**
     * Show the search results and listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modal()
    {
        return view('backend.event.modal');
    }

    /**
     * Show the search results and listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->only(['term', 'cat', 'when', 'view', 'by']);

        $events = $this->events->search($input)->paginate();

        $categories = Category::has('events')->get();

        return view('backend.event.index')
            ->withEvents($events)
            ->withWhens($this->events->getWhens())
            ->withCategories($categories)
            ->withRequests($input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('event.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return redirect()->route('event.edit', $event->id);
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
        $event->update($request->all());

        return redirect()->route('admin.event.show', $event->id)->withFlashSuccess('Aktiviti telah dikemaskini');
    }

    public function show(Event $event, Request $request)
    {
        $input = $request->only(['term']);

        if (!empty($input['term'])) {
            $validator = Validator::make($request->all(), ['term' => 'min:3']);

            if ($validator->fails()) {
                return redirect()->route('events.show', $event->id)->withErrors($validator)->withInput();
            }
        }

        $event->load(['user', 'participants' => function ($query) use ($input) {
            if ($term = $input['term']) {
                $query->search($term);
            }
            $query->orderBy('agency_id');
            $query->orderBy('created_at', 'desc');
        }]);

        // Group all participant with their attendance to save some queries
        $attendances = [];
        foreach ($event->participants as $participant) {
            $attendances[$participant->id] = $participant->attendances()
                ->whereEventId($event->id)
                ->get(['attendances.created_at'])
                ->lists('created_at')
                ->toArray();
        }

        $dates = $event->getDateRanges();

        return view('backend.event.show')
            ->withEvent($event)
            ->withAttendances($attendances)
            ->withDates($dates);
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

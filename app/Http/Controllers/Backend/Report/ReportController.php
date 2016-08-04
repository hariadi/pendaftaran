<?php

namespace App\Http\Controllers\Backend\Report;

use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Models\Agency\Agency;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\EventRepository;
use App\Services\Excel\ParticipantListExport;

class ReportController extends Controller
{
	protected $events;

	public function __construct(EventRepository $events)
	{
		$this->events = $events;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$input = $request->only(['term']);
    	$search = false;

    	$builder = Event::orderBy('end_at');

    	if ($term = $input['term']) {
    		$builder->search($term);
    		$search = true;
    	}

    	$this->events = $builder->paginate();

        return view('backend.report.index')
        	->withEvents($this->events)
        	->withSearch($search);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function event(Event $event, Request $request)
    {
    	$input = $request->only(['action']);
    	$print = ($input['action'] == 'print') ? true : false;

    	$summaries = [];

    	//dd($event->attendances()->whereDate('attendances.created_at', '=', Carbon::parse('03-04-2016')->toDateString())->toSql());

    	foreach ($event->getDateRanges() as $date) {
    		$attend = $event->attendances()->whereDate('attendances.created_at', '=', $date->toDateString());

    		$summaries['participant'][$date->formatLocalized('%d %b %Y')] = $attend->count();

    		$summaries['agency'][$date->formatLocalized('%d %b %Y')] = $attend->join('participants', 'event_participant.participant_id', '=','participants.id', 'left')->groupBy('participants.agency_id')->get()->count();
    	}


        return view('backend.report.event')
        	->withEvent($event)
        	->withPrint($print)
        	->withSummaries($summaries);
    }

    /**
     * Display list of participants.
     *
     * @param  object  $event
     * @return \Illuminate\Http\Response
     */
    public function participants(Event $event, Request $request)
    {
    	// get agencies not attending event for each day
    	$input = $request->only(['action' ,'attend']);
    	$attend = $input['attend'] ?: 1;
    	$print = ($input['action'] == 'print') ? true : false;

    	dd($event->participants->groupBy('agency_id'));

    	return view('backend.report.participant')
    		->withAttend($attend)
        	->withEvent($event)
        	->withPrint($print);
    }

    /**
     * Display list of agencies.
     *
     * @param  object  $event
     * @return \Illuminate\Http\Response
     */
    public function agencies(Event $event, Request $request)
    {
    	// get agencies not attending event for each day
    	$input = $request->only(['attend']);

    	$summaries = [];

    	foreach ($event->getDateRanges() as $date) {
    		$summaries[$date->formatLocalized('%d %b %Y')] = Agency::all();
    	}

    	dd($summaries);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cert(Event $event, Request $request)
    {
    	$input = $request->only(['action']);

    	$xls = ($input['action'] == 'xls') ? true : false;
    	$print = ($input['action'] == 'print') ? true : false;

    	$attendances = [];
		foreach ($event->participants as $participant) {
			$attendances[$participant->id] = $participant->attendances()
				->whereEventId($event->id)
				->orderBy('attendances.created_at')
				->get(['attendances.created_at'])
				->lists('created_at')
				->toArray();
		}

		$view = 'backend.report.cert';

		if ($input['action'] == 'xls') {

	    	$filename = 'sijil-' . $event->id;
	    	$title = 'Sijil Kehadiran ' . $event->name;

			Excel::create($filename, function($excel) use ($attendances, $event) {

				$excel->sheet('Kehadiran', function($sheet) use ($attendances, $event) {

					$sheet->loadView('backend.report.cert.excel')
						->withAttendances($attendances)
						->withEvent($event);;

				})->download('xlsx');

			});
		}

		if ($input['action'] == 'print') {
			$view = 'backend.report.cert.print';
		}

        return view($view)
        	->withAttendances($attendances)
        	->withEvent($event);
    }


}

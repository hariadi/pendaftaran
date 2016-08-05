<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Debug\Dumper;
use App\Repositories\EventRepository;
use App\Repositories\CategoryRepository;
use App\Models\EventParticipant\EventParticipant;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{
	protected $events;
	protected $categories;

	public function __construct(EventRepository $events, CategoryRepository $categories)
	{
		$this->events = $events;
		$this->categories = $categories;
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
    	$user = access()->user();
    	$input = $request->only(['by', 'term', 'cat', 'when', 'view', 'status']);

    	if ($input['by'] != 'all') {
    		$input['by'] = $user->id;
    	}

    	$builder = $this->events->search($input);
    	$events = $builder->paginate();

    	$reporting = $builder->get();

    	$reports = [
    		'activity' => $events->count(),
    		'participant' => 0,
    		'attendance' => 0,
    		'agency_total' => 0,
    		'agency_attend' => 0
    	];

    	foreach ($events as $event) {

			$reports['participant'] += $event->participants->count();
			$reports['attendance'] += $event->attendances()->groupBy('event_participant_id')->count();
			$reports['agency_total'] += $event->participants->groupBy('agency_id')->count();
			$reports['agency_attend'] += $event->attendances()->join('participants', 'event_participant.participant_id', '=','participants.id', 'left')->groupBy('participants.agency_id')->get()->count();

    	}

        return view('frontend.user.dashboard')
        	->withReports($reports)
        	->withEvents($events)
            ->withUser($user);
    }
}

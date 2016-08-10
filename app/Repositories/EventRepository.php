<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Models\Traits\SluggableTrait;
use App\Models\Participant\Participant;
use Illuminate\Support\Facades\Validator;

class EventRepository extends BaseRepository
{
	use SluggableTrait;

    /**
     * The Participant instance.
     *
     * @var App\Models\Participant\Participant
     */
    protected $participant;

    /**
     * Create a new EventRepository instance.
     *
     * @param  App\Models\Event\Event $event
     * @param  App\Models\Participant\Participant $participant
     * @param  App\Models\Comment $comment
     * @return void
     */
    public function __construct(Event $event, Participant $participant)
    {
        $this->model = $event;
        $this->participant = $participant;
    }

    /**
     * Create or update a event.
     *
     * @param  App\Models\Event\Event $event
     * @param  array  $inputs
     * @param  bool   $user_id
     * @return App\Models\Event\Event
     */
    private function saveEvent($inputs)
    {
        $event = new $this->model;
        $event->name = $inputs['name'];
        $event->location = $inputs['location'];
        $event->description = $inputs['description'];
        $event->start_at = $inputs['start_at'];
        $event->end_at = $inputs['end_at'];
        $event->options = $inputs['options'];

        if (isset($inputs['photo']) && $inputs['photo']->isValid()) {
            $file = $inputs['photo'];
            $destinationPath = public_path('img/events');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $event->photo = $filename;
        }

        $event->user_id = access()->id();

        $event->save();

        return $event;
    }

    public function search($input, $past = false)
    {
        $builder = $this->model->with('participants');

        if ($term = $input['term']) {
            $builder->search($term);
        }

        if ($category = $input['cat']) {
            $builder->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.name', 'like', '%' . $category .'%');
            });
        }

        if ($by = $input['by']) {
        	if ($by != 'all') {
        		$builder->whereUserId($by);
        	}
        }

        if ($input['when'] && in_array($input['when'], $this->model->whens)) {
            $builder->{$input['when']}();
        }

        if (!$past) {
            $builder->where('end_at', '>', Carbon::now());
        }

        return $builder->orderBy('end_at', 'desc');
    }

    public function show($idOrSlug, $request)
    {
    	// if (!$e = $this->model->whereSlug($idOrSlug)) {
    	// 	$e = $this->model->whereId($idOrSlug);
    	// }

    	$event = $this->model->findBySlugOrIdOrFail($idOrSlug);

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

        return $event;
    }

    public function token($token)
    {
        return $this->model->whereToken($token)->first();
    }

    public function find($idOrSlugOrToken)
    {
        return $this->model->findBySlugOrIdOrFail($idOrSlugOrToken);
    }

    public function update($inputs)
    {
        return $this->saveEvent($inputs);
    }

    public function store($inputs)
    {
        return $this->saveEvent($inputs);
    }

    public function getWhens()
    {
        return $this->model->whens;
    }
}

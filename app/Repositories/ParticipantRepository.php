<?php

namespace App\Repositories;

use App\Models\Event\Event;
use App\Models\Participant\Participant;

class ParticipantRepository extends BaseRepository {

    /**
     * Create a new ParticipantRepository instance.
     *
     * @param  App\Models\Event\Event $event
     * @param  App\Models\Participant\Participant $event
     * @param  App\Models\Comment $comment
     * @return void
     */
    public function __construct(Participant $participant)
    {
        $this->model = $participant;
    }

    /**
     * Create or update a event.
     *
     * @param  App\Models\Event\Event $event
     * @param  array  $inputs
     * @param  bool   $user_id
     * @return App\Models\Event\Event
     */
    private function saveParticipant($inputs)
    {
    	if ($participant = $this->model->where('name', 'LIKE', '%'. $inputs['name'] .'%')
			->orWhere('ic', $inputs['ic'])->first()) {
    		return $participant;
    	}

    	$participant = new $this->model;
        $participant->name = $inputs['name'];
        $participant->ic = $inputs['ic'];
        $participant->phone = $inputs['phone'];
        $participant->email = $inputs['email'];
        $participant->agency_id = $inputs['agency_id'];
        $participant->job_title = $inputs['job_title'];
        $participant->grade = $inputs['grade'];

        $participant->save();

        return $participant;
    }

    public function search($input)
    {
    	$builder = $this->model->with('agency');

    	if ($term = $input['term']) {
    		$builder->search($term);
    	}

    	return $builder->orderBy('created_at');
    }

    public function update($inputs)
    {
		return $this->saveParticipant($inputs);
    }

    public function find($idOrSlug)
    {
    	return $this->model->findBySlugOrIdOrFail($idOrSlug);
    }

    public function store($inputs)
    {
    	return $this->saveParticipant($inputs);
    }
}

<?php

namespace App\Repositories;

use App\Models\Agency\Agency;



class AgencyRepository extends BaseRepository {

	/**
     * The Agency instance.
     *
     * @var App\Models\Agency\Agency
     */
    protected $agency;

    /**
     * Create a new AgencyRepository instance.
     *
     * @param  App\Models\Event\Event $event
     * @param  App\Models\Agency\Agency $event
     * @param  App\Models\Comment $comment
     * @return void
     */
    public function __construct(Agency $agency)
    {
        $this->model = $agency;
    }

    /**
     * Create or update a event.
     *
     * @param  App\Models\Event\Event $event
     * @param  array  $inputs
     * @param  bool   $user_id
     * @return App\Models\Event\Event
     */
    private function saveAgency($inputs)
    {
    	if ($agency = $this->model->where('name', 'LIKE', '%'. $inputs['name'] .'%')->first()) {
    		return $agency;
    	}

    	$agency = new $this->model;
        $agency->parent_id = $inputs['parent_id'];
        $agency->name = $inputs['name'];
        $agency->short = $inputs['short'];

        $agency->save();

        return $agency;
    }

    public function update($inputs)
    {
		return $this->saveAgency($inputs);
    }

    public function find($idOrSlug)
    {
    	return $this->model->findBySlugOrIdOrFail($idOrSlug);
    }

    public function store($inputs)
    {
    	return $this->saveAgency($inputs);
    }
}

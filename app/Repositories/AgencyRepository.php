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

    	if ($inputs['parent_id']) {
    		$agency->parent_id = $inputs['parent_id'];
    	}

        $agency->name = $inputs['name'];

		$agency->short = empty($inputs['short']) ? shorten($inputs['name']) : $inputs['short'];

        $agency->save();

        return $agency;
    }

    public function search($input)
    {
    	$builder = $this->model;

		if ($term = $input['term']) {
            $builder->search($term);
        }

    	return $builder->orderBy('created_at', 'desc');
    }

    public function update($inputs)
    {
		return $this->saveAgency($inputs);
    }

    public function find($id)
    {
    	return $this->model->findOrFail($id);
    }

    public function store($inputs)
    {
    	return $this->saveAgency($inputs);
    }
}

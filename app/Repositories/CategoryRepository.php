<?php

namespace App\Repositories;

use App\Models\Category\Category;

class CategoryRepository extends BaseRepository {

	/**
     * The Category instance.
     *
     * @var App\Models\Category\Category
     */
    protected $category;

    /**
     * Create a new CategoryRepository instance.
     *
     * @param  App\Models\Event\Event $event
     * @param  App\Models\Category\Category $event
     * @param  App\Models\Comment $comment
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Create or update a event.
     *
     * @param  App\Models\Event\Event $event
     * @param  array  $inputs
     * @param  bool   $user_id
     * @return App\Models\Event\Event
     */
    private function saveCategory($inputs)
    {
    	if ($category = $this->model->where('name', 'LIKE', '%'. $inputs['name'] .'%')->first()) {
    		return $category;
    	}

    	$category = new $this->model;
        $category->name = $inputs['name'];
        $category->description = $inputs['description'];

        $category->save();

        return $category;
    }

    public function update($inputs)
    {
		return $this->saveCategory($inputs);
    }

    public function find($idOrSlug)
    {
    	return $this->model->findBySlugOrIdOrFail($idOrSlug);
    }

    public function store($inputs)
    {
    	return $this->saveCategory($inputs);
    }
}

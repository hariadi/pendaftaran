<?php

namespace App\Models\Category\Traits\Relationship;

use App\Models\Event\Event;

/**
 * Class CategoryRelationship
 * @package App\Models\Category\Traits\Relationship
 */
trait CategoryRelationship
{
    /**
     * The events that belong to the category.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}

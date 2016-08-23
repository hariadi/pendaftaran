<?php

namespace App\Models\Agency\Traits\Relationship;

use App\Models\Agency\Agency;
use App\Models\Participant\Participant;

/**
 * Class AgencyRelationship
 * @package App\Models\Agency\Traits\Relationship
 */
trait AgencyRelationship
{
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * One-to-One relations with Agency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Agency::class, 'parent_id');
    }

    /**
     * Has-Many relations with Agency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Agency::class, 'parent_id');
    }

    /**
     * Find Agency wuth their childs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopeHierarchies($query)
    {
        return $query->whereNull('parent_id')->with('childs')->get();
    }
}

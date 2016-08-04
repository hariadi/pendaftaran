<?php

namespace App\Models\Agency\Traits\Relationship;

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
}

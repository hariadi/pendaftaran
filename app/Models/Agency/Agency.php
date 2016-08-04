<?php

namespace App\Models\Agency;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agency\Traits\Attribute\AgencyAttribute;
use App\Models\Agency\Traits\Relationship\AgencyRelationship;

class Agency extends Model
{
    use AgencyAttribute, AgencyRelationship;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'short',
    ];
}

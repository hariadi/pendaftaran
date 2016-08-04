<?php

namespace App\Models\Event;

use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event\Traits\Attribute\EventAttribute;
use App\Models\Event\Traits\Relationship\EventRelationship;

class Event extends Model
{
    use EventRelationship, EventAttribute, SluggableTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'start_at'	=> 'date',
        'end_at'	=> 'date',
        'options'	=> 'json',
    ];

    /**
     * The attributes allow to be filtered.
     *
     * @var string[]
     */
    public $whens = [
		'today',
		'tomorrow',
		'week',
		'nextweek',
		'month',
		'nextmonth',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'location',
        'description',
        'start_at',
        'end_at',
        'attendant',
        'photo',
        'options',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'required',
        'location'	=> 'required',
        'start_at'  => 'bail|required|date',
        'end_at'   	=> 'bail|required|date',
    ];

    /**
     * Field to search.
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'description',
        'location',
    ];
}

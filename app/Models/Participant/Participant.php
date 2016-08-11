<?php

namespace App\Models\Participant;

use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant\Traits\Attribute\ParticipantAttribute;
use App\Models\Participant\Traits\Relationship\ParticipantRelationship;

class Participant extends Model
{
    use ParticipantAttribute, ParticipantRelationship, SluggableTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
	protected $fillable = [
		'name',
		'ic',
		'phone',
		'email',
		'agency_id',
		'job_title',
		'grade',
    ];

    protected $patronyms = [
		' binti ', ' Binti ', ' bin ', ' Bin ', ' bte ', ' Bte ',
		' Bte. ', ' bte. ',' bt ', ' bt. ', ' Bt ', ' Bt. ',
		' a/l ', ' a/p ', ' A/L ', ' A/P ', ' b ', ' b. ',
    ];

    protected $with = ['agency'];
}

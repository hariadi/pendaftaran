<?php

namespace App\Models\EventParticipant;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventParticipant\Traits\Attribute\EventParticipantAttribute;
use App\Models\EventParticipant\Traits\Relationship\EventParticipantRelationship;

class EventParticipant extends Model
{
    use EventParticipantAttribute, EventParticipantRelationship;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_participant';
}

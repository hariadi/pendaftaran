<?php

namespace App\Models\Participant\Traits\Relationship;

use App\Models\Event\Event;
use App\Models\Agency\Agency;
use App\Models\Attendance\Attendance;
use App\Models\EventParticipant\EventParticipant;

/**
 * Class ParticipantRelationship
 * @package App\Models\Participant\Traits\Relationship
 */
trait ParticipantRelationship
{
	/**
     * The agency that belong to the Agency.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * The events that belong to the Event.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function attends()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, EventParticipant::class, 'participant_id', 'event_participant_id');
    }
}

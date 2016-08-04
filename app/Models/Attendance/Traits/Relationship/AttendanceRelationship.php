<?php

namespace App\Models\Attendance\Traits\Relationship;

use App\Models\Participant\Participant;
use App\Models\EventParticipant\EventParticipant;

/**
 * Class AttendanceRelationship
 * @package App\Models\Attendance\Traits\Relationship
 */
trait AttendanceRelationship
{
    /**
     * Get the attender for the attendance.
     */
    public function attend()
    {
        return $this->belongsTo(EventParticipant::class, 'event_participant_id')
        	->with('participant');
    }
}

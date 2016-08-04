<?php

namespace App\Models\EventParticipant\Traits\Relationship;

use App\Models\Event\Event;
use App\Models\Attendance\Attendance;
use App\Models\Participant\Participant;

/**
 * Class EventParticipantRelationship
 * @package App\Models\EventParticipant\Traits\Relationship
 */
trait EventParticipantRelationship
{
    public function attends()
    {
        return $this->hasMany(Attendance::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

<?php

namespace App\Models\Event\Traits\Relationship;

use App\Models\Event\Options;
use App\Models\Access\User\User;
use App\Models\Category\Category;
use App\Models\Attendance\Attendance;
use App\Models\Participant\Participant;
use App\Models\EventParticipant\EventParticipant;

/**
 * Class EventRelationship
 * @package App\Models\Event\Traits\Relationship
 */
trait EventRelationship
{
    /**
    * Get the user options.
    *
    * @return Options
    */
    public function options()
    {
        return new Options($this->options, $this);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attendances that belong to the participant.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    /**
     * The categories that belong to the event.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attends()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, EventParticipant::class, 'event_id', 'event_participant_id');
    }
}

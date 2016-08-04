<?php

namespace App\Models\Event\Traits\Attribute;

use Carbon\Carbon;
use App\Models\Participant\Participant;

/**
 * Class EventAttribute
 * @package App\Models\Event\Traits\Attribute
 */
trait EventAttribute
{
    /**
     * Set the event's name along with their slug.
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        // Automatically set slug
        if ( ! $this->slug) {
            $this->attributes['slug'] = str_slug($value);
        }

        // Automatically set token
        if ( ! $this->token) {
            $this->attributes['token'] = md5(uniqid(mt_rand(), true));
        }
    }

    public function getPhotoAttribute($photo)
    {
        return $photo ? asset('img/events/' . $photo) : null;
    }

    /**
     * Scope a query to only include active events.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('end_at', '>', Carbon::now()->toDateTimeString());
    }

    /**
     * Scope a query for search.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', '%'. $term .'%')
            ->orWhere('description', 'LIKE', '%'. $term .'%')
            ->orWhere('location', 'LIKE', '%'. $term .'%');
    }

    /**
     * Scope a query for when.
     *
     * @param  array  $when
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhen($query, $when)
    {
        $start_at = Carbon::now();
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeToday($query)
    {
        return $query->whereBetween('start_at', [Carbon::today(), Carbon::today()->endOfDay()]);
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeTomorrow($query)
    {
        return $query->whereBetween('start_at', [Carbon::today()->addDay(), Carbon::today()->endOfDay()->addDay()]);
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeWeek($query)
    {
        return $query->whereBetween('start_at', [Carbon::today(), Carbon::today()->endOfDay()->addWeek()]);
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeNextWeek($query)
    {
        return $query->whereBetween('start_at', [Carbon::today()->addWeek(), Carbon::today()->addWeeks(2)->endOfDay()]);
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeMonth($query)
    {
        return $query->whereBetween('start_at', [Carbon::today(), Carbon::today()->addMonth()->endOfDay()]);
    }

    /**
    * @param $query
    * @return mixed
    */
    public function scopeNextMonth($query)
    {
        return $query->whereBetween('start_at', [Carbon::today()->addMonth(), Carbon::today()->addMonths(2)->endOfDay()]);
    }

    public function getTotalDay()
    {
        return $this->start_at->diffInDays($this->end_at, true);
    }

    public function getDurationAttribute()
    {
        return $this->start_at->diff($this->end_at)->format(
            '%d ' .  trans('site.event.days')
            . ' %h '  .  trans('site.event.hours')
            .' %i ' .  trans('site.event.minutes'));
    }

    public function getNameLabel()
    {
        return '<a href="' . route('event.show', $this->id) .'">' .$this->name . '</a>';
    }

    public function getNameEditLabel()
    {
        if (auth()->check() && auth()->user()->id == $this->user_id) {
            return '<a href="' . route('event.edit', $this->id) .'">' . $this->name . '</a>';
        }

        return $this->name;
    }

    public function getDescriptionLabel()
    {
        return $this->description;
    }

    public function getDateRanges($nextDayOnly = true)
    {
        $interval = new \DateInterval('P1D');
        $start = $this->start_at;
        $end = $this->end_at;

        $ranges = new \DatePeriod($start, $interval , $end);

        $dates = [];

        foreach ($ranges as $index => $date) {
            $dates[] = $date;
        }

        return $dates;
    }

    public function isAttend(Participant $participant, $date = null)
    {
        $date = $date ?: Carbon::now();

        if (! $eventParticipant = $this->attends()->whereParticipantId($participant->id)->first()) {
            return 0;
        }

        return $this->attendances()
            ->whereEventParticipantId($eventParticipant->id)
            ->whereDate('attendances.created_at', '=', $date->toDateString())
            ->count();
    }

    public function isOngoing()
    {
        return Carbon::now()->between($this->start_at->subHour(), $this->end_at);
    }

    public function isUpcoming()
    {
        return Carbon::now()->lt($this->end_at);
    }

    public function isPast()
    {
        return Carbon::now()->gt($this->end_at);
    }

    public function getWhens()
    {
        return $this->whens;
    }

    /**
     * Event options attribute
     */
    public function isSocialable()
    {
        if (!$this->options) {
            return false;
        }

        if (
            !array_has($this->options, 'share.facebook') &&
            !array_has($this->options, 'share.twitter') &&
            !array_has($this->options, 'share.gplus')
        ) {
            return false;
        }

        return $this->options()->get('share');
    }

    public function getFacebookShare()
    {
        if (!$this->isSocialable()) {
            return false;
        }

        if (!array_has($this->options, 'share.facebook')) {
            return false;
        }

        return '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode(route('event.show', $this->slug)) .'"><span class="fa fa-facebook-square"></span></a>';
    }

    public function getTwitterShare()
    {
        if (!$this->isSocialable()) {
            return false;
        }

        if (!array_has($this->options, 'share.twitter')) {
            return false;
        }

        return '<a href="https://twitter.com/share?url=' . urlencode(route('event.show', $this->slug)) .'&via=jpagov&text=' . $this->name . '"><span class="fa fa-twitter-square"></span></a>';
    }

    public function getGplusShare()
    {
        if (!$this->isSocialable()) {
            return false;
        }

        if (!array_has($this->options, 'share.gplus')) {
            return false;
        }

        return '<a href="https://plus.google.com/share?url=' . urlencode(route('event.show', $this->slug)) .'"><span class="fa fa-google-plus-square "></span></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-event')) {
            return '<a href="' . route('admin.event.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * Show delete button
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-event')) {
            return '<a href="' . route('admin.event.destroy', $this->id) . '"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }

    /**
     * Show add participants button
     * @return string
     */
    public function getAddParticipantButtonAttribute()
    {
        return '<a href="' . route('event.add.participants.token', $this->token) . '" class="btn btn-xs btn-success" data-toggle="tooltip" title="' . trans('buttons.backend.event.addparticipants') . '"><i class="fa fa-user-plus"></i></a> ';
    }

    /**
     * Show Status link
     * @return string
     */
    public function getStatusLinkAttribute()
    {
        return '<a href="' . route('admin.event.show', $this->id) . '">'. $this->name .'</a> ';
    }

    /**
     * Show Status button
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        if ($this->isPast()) {
            return '<a href="' . route('admin.event.show', $this->id) . '" class="btn btn-xs btn-success" data-toggle="tooltip" title="' . trans('buttons.backend.event.status.past') . '"><i class="fa fa-check"></i></a> ';
        } elseif ($this->isOngoing()) {
            return '<a href="' . route('admin.event.show', $this->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" title="' . trans('buttons.backend.event.status.ongoing') . '"><i class="fa fa-hourglass-1"></i></a> ';
        } elseif ($this->isUpcoming()) {
            return '<a href="' . route('admin.event.show', $this->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" title="' . trans('buttons.backend.event.status.upcoming') . '"><i class="fa fa-clock-o"></i></a> ';
        }

        return '';
    }

    /**
     * Show report button
     * @return string
     */
    public function getReportButtonAttribute()
    {
        if (access()->allow('report-event')) {
            return '<a href="' . route('admin.report.event', $this->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" title="' . trans('buttons.backend.event.status.upcoming') . '"><i class="fa fa-bar-chart"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getReportButtonAttribute() .
            $this->getEditButtonAttribute() .
            $this->getDeleteButtonAttribute();
    }
}

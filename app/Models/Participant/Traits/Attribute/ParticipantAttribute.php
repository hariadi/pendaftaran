<?php

namespace App\Models\Participant\Traits\Attribute;

use Carbon\Carbon;

/**
 * Class ParticipantAttribute
 * @package App\Models\Participant\Traits\Attribute
 */
trait ParticipantAttribute
{
	/**
     * Set the participant's name along with their slug.
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (!$this->slug) {
        	$value = str_replace($this->patronyms, ' ', $value);
        	$this->attributes['slug'] = str_slug($value);
        }
    }

	/**
     * Only show parts of Identification Number when no login
     *
     * @param  string  $value
     * @return string
     */
    public function getIcAttribute($ic)
    {
        return auth()->guest() ? substr($ic, -4) : $ic;
    }

    /**
     * Scope a query for search.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeSearch($query, $term)
	{
		return $query->where('name', 'LIKE', '%'. $term .'%')
			->orWhere('ic', 'LIKE', '%'. $term .'%')
			->orWhere('email', 'LIKE', '%'. $term .'%')
			->orWhere('phone', 'LIKE', '%'. $term .'%');
	}

	/**
     * Scope a query for exist.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeExist($query, $term)
	{
		return $query->where('name', 'LIKE', '%'. $term .'%')
			->orWhere('ic', $term);
	}

	public function isAttend($date = null)
	{
		$date = $date ? Carbon::parse($date) : Carbon::now();

		return $this->attendances->lists('created_at')->filter(function ($item) use ($date) {
				return $item->toDateString() == $date->toDateString();
			})->count();
	}

	public function isAttendees($event)
	{
	    return $this->events()->where('events.id', $event)->first();
	}

	/**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-participant')) {
            return '<a href="' . route('admin.participant.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-participant')) {
            return '<a href="' . route('admin.participant.destroy', $this->id) . '"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        	$this->getDeleteButtonAttribute();
    }
}

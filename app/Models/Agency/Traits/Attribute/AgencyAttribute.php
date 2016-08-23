<?php

namespace App\Models\Agency\Traits\Attribute;

/**
 * Class AgencyAttribute
 * @package App\Models\Agency\Traits\Attribute
 */
trait AgencyAttribute
{
	/**
     * Scope a query for search.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', '%'. $term .'%')
            ->orWhere('short', 'LIKE', '%'. $term .'%');
    }

    /**
     * Set the agency's name along with their short code.
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if( ! $this->short) {
        	$this->attributes['short'] = shorten($value);
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-agencies')) {
            return '<a href="' . route('admin.agencies.edit', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * Show delete button
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-agencies')) {
            return '<a href="' . route('admin.agencies.destroy', $this->id) . '"
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

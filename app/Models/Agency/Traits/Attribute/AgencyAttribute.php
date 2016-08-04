<?php

namespace App\Models\Agency\Traits\Attribute;

/**
 * Class AgencyAttribute
 * @package App\Models\Agency\Traits\Attribute
 */
trait AgencyAttribute
{
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
}

<?php

namespace App\Models\Category\Traits\Attribute;

/**
 * Class CategoryAttribute
 * @package App\Models\Category\Traits\Attribute
 */
trait CategoryAttribute
{
    /**
     * Set the category's name along with their slug.
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if( ! $this->slug) {
        	$this->attributes['slug'] = str_slug($value);
        }
    }
}

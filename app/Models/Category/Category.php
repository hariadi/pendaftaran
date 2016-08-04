<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Traits\Attribute\CategoryAttribute;
use App\Models\Category\Traits\Relationship\CategoryRelationship;

class Category extends Model
{
    use CategoryAttribute, CategoryRelationship;

    protected $fillable = [
    	'name',
    	'name_localozed',
    	'description',
    	'slug',
    ];

    /**
     * Field to search.
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'description',
    ];
}

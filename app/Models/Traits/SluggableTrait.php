<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
*
*/
trait SluggableTrait
{
	/**
     * Query scope for finding a model by its slug.
     *
     * @param $scope
     * @param $slug
     * @return mixed
     */
    public function scopeWhereSlug($scope, $slug)
    {
        return $scope->where('slug', $slug);
    }

	/**
     * Find a model by slug.
     *
     * @param $slug
     * @param array  $columns
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function findBySlug($slug, array $columns = ['*'])
    {
        return self::whereSlug($slug)->first($columns);
    }

    /**
     * Find a model by slug or fail.
     *
     * @param $slug
     * @param array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findBySlugOrFail($slug, array $columns = ['*'])
    {
        return self::whereSlug($slug)->firstOrFail($columns);
    }

    /**
     * Simple find by Id if it's numeric or slug if not. Fail if not found.
     *
     * @param $slug
     * @param array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public static function findBySlugOrIdOrFail($slug, array $columns = ['*'])
    {
        if (!$result = self::findBySlug($slug, $columns)) {
            return self::findOrFail((int)$slug, $columns);
        }
        return $result;
    }

    /**
     * Simple find by Id if it's numeric or slug if not.
     *
     * @param $slug
     * @param array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null
     */
    public static function findBySlugOrId($slug, array $columns = ['*'])
    {
        if (!$result = self::findBySlug($slug, $columns)) {
            return self::find($slug, $columns);
        }
        return $result;
    }
}



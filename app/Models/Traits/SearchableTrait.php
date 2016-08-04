<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchableTrait
{
	/**
	 * Scope a query for search.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param array $search
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSearch(Builder $query, array $search = [])
	{
		if (empty($search)) {
			return $query;
		}

		if (!array_intersect(array_keys($search), $this->searchable)) {
			return $query;
		}

		return $query->where($search);
	}
}

<?php

namespace App\Traits;

use App\Helpers\Helper;

trait CurrentYearScope {

    /**
     * Scope a query to get only items of current year.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentYear($query)
    {
        return $query->where('scholar_year_id', Helper::getCurrentYearId());
    }
}

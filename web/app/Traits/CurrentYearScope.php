<?php

namespace App\Traits;

trait CurrentYearScope {

    /**
     * Scope a query to get only items of current year.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentYear($query)
    {
        return $query->where('scholar_year_id', config('scholaryear.current_scholar_year_id'));
    }
}

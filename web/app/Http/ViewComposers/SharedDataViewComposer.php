<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\ScholarYear;

class SharedDataViewComposer
{
    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allScholarYears', ScholarYear::all(['id', 'scholar_year']));
    }
}
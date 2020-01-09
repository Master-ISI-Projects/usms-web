<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ClasseFilter extends ModelFilter
{
    public function title($title)
    {
        return $this->where('title', 'LIKE', '%' . $title . '%');
    }
}

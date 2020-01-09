<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TeacherFilter extends ModelFilter
{
    public function fullName($name)
    {
        return $this->whereHas('user', function ($query) use ($name) {
        	return $query->where('first_name', 'LIKE', '%' . $name . '%')
        				->orWhere('last_name', 'LIKE', '%' . $name . '%');
        });
    }
}
<?php

namespace App\Services;

use App\Models\ScholarYear;
use App\Models\Teacher;
use App\Models\Departement;
use App\Models\User;
use App\Helpers\Constant;
use App\Helpers\Helper;

/**
 * StatisticService
 */
class StatisticService
{
	public function getCurrentScholarYear()
	{
		return ScholarYear::find(
            Helper::getCurrentYearId()
        );
	}

	public function getCountStudentsInCurrentYear()
	{
    	return $this->getCurrentScholarYear()->classes->sum(function ($classe) {
    		return $classe->students()->count();
    	});
	}

	public function getCountClassesInCurrentYear()
	{
    	return $this->getCurrentScholarYear()->classes()->count();
	}

	public function getCountTeachers()
	{
    	return Teacher::count();
	}

	public function getCountDepartements()
	{
    	return Departement::count();
	}

	public function getCountAdmins()
	{
	    return User::where('role', Constant::USER_ROLES['admin'])->count();
	}
}

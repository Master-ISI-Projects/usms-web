<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Level;
use App\Models\ScholarYear;
use App\Helpers\Constant;

class StudentRepository
{
	public function getRegistedStudentsInCurrentYear()
	{
		return Student::get()->where('currentClasse', '!=', NULL);
	}

	public function getUnRegistedStudentsInCurrentYear()
	{
		return Student::get()->where('currentClasse', '==', NULL)->where('active', '==', true);
	}

	public function getStudentsPerLevel()
	{
		$countStudentsPerSection = [];
		$colors = [];
		$backgroundColors = [];
		$currentScholarYear = ScholarYear::find(
			config('scholaryear.current_scholar_year_id')
		);

		foreach (Level::all() as $key => $level) {
			$countStudentsPerSection[$level->title] = 0;
			foreach ($currentScholarYear->classes as $classe) {
				if($classe->subLevel->level->id == $level->id) {
					$countStudentsPerSection[$level->title] = $countStudentsPerSection[$level->title] + $classe->students()->count();
				}
			}
		}

		for ($i=0; $i < count($countStudentsPerSection); $i++) {
			$colors[] = Constant::DEFAULT_COLORS['colors'][$i] ?? '#00F';
			$backgroundColors[] = Constant::DEFAULT_COLORS['backgrounds'][$i] ?? '#F00';
		}

		$result = [
			'data' => array_values($countStudentsPerSection),
			'labels' => array_keys($countStudentsPerSection),
			'colors' => $colors,
			'backgroundColors' => $backgroundColors
		];

		return $result;
	}
}

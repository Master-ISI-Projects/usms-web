<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StatisticService;
use App\Repositories\StudentRepository;

class PagesController extends Controller
{
	private $statisticService;
    private $studentRepository;

	function __construct(StatisticService $statisticService, StudentRepository $studentRepository)
	{
		$this->statisticService = $statisticService;
        $this->studentRepository = $studentRepository;
	}

    public function dashboard()
    {
    	$countStudentInCurrentYear = $this->statisticService->getCountStudentsInCurrentYear();
    	$countClassesInCurrentYear = $this->statisticService->getCountClassesInCurrentYear();
    	$countLevelsInCurrentYear = $this->statisticService->getCountLevelsInCurrentYear();
    	$countTeachers = $this->statisticService->getCountTeachers();
    	$countAdmins = $this->statisticService->getCountAdmins();
        $studentsPerSection = $this->studentRepository->getStudentsPerLevel();
        $unRegisterdStudents = $this->studentRepository->getUnRegistedStudentsInCurrentYear();

        return view('admin.pages.dashboard', [
    		'countStudentInCurrentYear' => $countStudentInCurrentYear,
    		'countClassesInCurrentYear' => $countClassesInCurrentYear,
    		'countLevelsInCurrentYear' => $countLevelsInCurrentYear,
    		'countTeachers' => $countTeachers,
    		'countAdmins' => $countAdmins,
            'unRegisterdStudents' => $unRegisterdStudents,
            'studentsPerSection' => $studentsPerSection
    	]);
    }
}

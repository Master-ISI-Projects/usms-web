<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StatisticService;
use App\Repositories\StudentRepository;
use App\Models\Event;
use App\Models\News;

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
    	$countDepartements = $this->statisticService->getCountDepartements();
    	$countTeachers = $this->statisticService->getCountTeachers();
    	$countAdmins = $this->statisticService->getCountAdmins();
        $eventsOfCurrentYear = Event::currentYear()->latest()->get();
        $newsOfCurrentYear = News::currentYear()->latest()->limit(3)->get();

        return view('admin.pages.dashboard', [
    		'countStudentInCurrentYear' => $countStudentInCurrentYear,
    		'countClassesInCurrentYear' => $countClassesInCurrentYear,
    		'countDepartements' => $countDepartements,
    		'countTeachers' => $countTeachers,
    		'countAdmins' => $countAdmins,
            'events' => $eventsOfCurrentYear,
            'news' => $newsOfCurrentYear,
    	]);
    }
}

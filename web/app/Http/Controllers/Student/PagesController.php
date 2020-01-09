<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Constant;
use Carbon\Carbon;
use App\Models\Course;

class PagesController extends Controller
{
    public function dashboard()
    {
    	abort_if(auth()->user()->role != Constant::USER_ROLES['student'] || !auth()->user()->student->currentClasse, 403);

    	$todayCourses = collect([]);
        $countHours = 0;
    	foreach (auth()->user()->student->currentClasse->modules as $key => $module) {
    		$courses = $module->courses()
    								->whereDay('published_at', Carbon::now())
                                    ->whereMonth('published_at', Carbon::now())
                                    ->whereYear('published_at', Carbon::now())
    								->orderBy('published_at', 'ASC')
    								->get();
			foreach ($courses as $key => $course) {
				$todayCourses[] = $course;
                $countHours += $course->duration;
			}
    	}

        $countHours = $countHours / 60;

        return view('student.pages.dashboard', [
    		'classId' => auth()->user()->student->currentClasse->id,
    		'todayCourses' => $todayCourses,
            'countHours' => $countHours
    	]);
    }

    public function classe()
    {
        abort_if(auth()->user()->role != Constant::USER_ROLES['student'] || !auth()->user()->student->currentClasse, 403);

        return view('student.pages.classe', [
            'classe' => auth()->user()->student->currentClasse
        ]);
    }

    public function course($id)
    {
        $course = Course::findOrFail($id);

        return view('student.pages.course', [
            'course' => $course
        ]);
    }

    public function coursesCalendar()
    {
        abort_if(auth()->user()->role != Constant::USER_ROLES['student'] || !auth()->user()->student->currentClasse, 403);

        return view('student.pages.courses_calendar', [
            'classId' => auth()->user()->student->currentClasse->id
        ]);
    }
}

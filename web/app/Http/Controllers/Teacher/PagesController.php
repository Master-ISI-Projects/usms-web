<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Constant;
use App\Models\Course;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function dashboard()
    {
    	abort_if(auth()->user()->role != Constant::USER_ROLES['teacher'], 403);

    	$todayCourses = collect([]);
        $countHours = 0;

        $todayCourses = auth()->user()->teacher->courses()
                                            ->whereDay('published_at', Carbon::now())
                                            ->whereMonth('published_at', Carbon::now())
                                            ->whereYear('published_at', Carbon::now())
                                            ->orderBy('published_at', 'ASC')->get();
        $countHours = $todayCourses->sum(function ($course) {
        	return $course->duration;
        });
        
        $countHours = $countHours / 60;
    	
        return view('teacher.pages.dashboard', [
    		'todayCourses' => $todayCourses,
            'countHours' => $countHours
    	]);
    }

    public function course($id)
    {
        $course = Course::findOrFail($id);

        abort_if(
            (auth()->user()->role != Constant::USER_ROLES['teacher'])
            ||
            ($course->teacher_id != auth()->user()->teacher->id)
        , 403);

        return view('teacher.pages.course', [
            'course' => $course
        ]);
    }

    public function coursesCalendar()
    {
        abort_if(auth()->user()->role != Constant::USER_ROLES['teacher'], 403);

        return view('teacher.pages.courses_calendar');
    }
}

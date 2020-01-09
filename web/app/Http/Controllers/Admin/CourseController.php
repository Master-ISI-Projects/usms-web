<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Level;
use App\Models\SubLevel;
use App\Models\Classe;
use App\Models\Teacher;
use App\Models\Module;
use App\Models\File;
use App\Helpers\Helper;
use App\Helpers\Constant;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courses.index', [
            'courses' => Course::currentYear()
                ->filter(request()->all())
                ->paginate(Constant::COUNT_PER_PAGE),
            'levels' => Level::all(['id', 'title']),
            'subLevels' => SubLevel::all(['id', 'title', 'level_id']),
            'classes' => Classe::all(['id', 'title', 'sub_level_id', 'scholar_year_id']),
            'modules' => Module::all(['id', 'title', 'classe_id'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create', [
            'teachers' => Teacher::all(),
            'levels' => Level::all(['id', 'title']),
            'subLevels' => SubLevel::all(['id', 'title', 'level_id']),
            'classes' => Classe::all(['id', 'title', 'sub_level_id', 'scholar_year_id']),
            'modules' => Module::all(['id', 'title', 'classe_id'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'module_id' => $request->module_id,
            'teacher_id' => $request->teacher_id,
            'published_at' => Helper::parseDate($request->published_at),
            'video_content' => $request->video_content
        ]);

        session()->flash('success', 'Saved');

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.show', [
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.edit', [
            'course' => $course,
            'teachers' => Teacher::all(),
            'levels' => Level::all(['id', 'title']),
            'subLevels' => SubLevel::all(['id', 'title', 'level_id']),
            'classes' => Classe::all(['id', 'title', 'sub_level_id', 'scholar_year_id']),
            'modules' => Module::all(['id', 'title', 'classe_id'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $course->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'teacher_id' => $request->teacher_id,
            'published_at' => Helper::parseDate($request->published_at),
            'video_content' => $request->video_content
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        session()->flash('success', 'Deleted');

        return redirect()->route('courses.index');
    }

    public function saveDocument(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $file = $course->files()->save(
            File::create([
                'title' => $request->title,
                'path' => Helper::saveFileFromRequest($request, 'course_file', null, 'course_documents')
            ])
        );

        session()->flash('success', 'Saved');

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScholarYear;
use App\Helpers\Constant;
use App\Helpers\Helper;
use App\Models\SubLevel;
use App\Models\Classe;
use App\Models\Module;
use App\Models\Level;
use App\Http\Resources\CourseResource;
use App\Repositories\StudentRepository;

class ClassController extends Controller
{
    private $studentRepository ;

    function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::currentYear()->filter(request()->all())->paginate(Constant::COUNT_PER_PAGE);
        
        return view('admin.classes.index', [
            'classes' => $classes,
            'levels' => Level::all(['id', 'title']),
            'subLevels' => SubLevel::all(['id', 'title', 'level_id']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = $this->studentRepository->getRegistedStudentsInCurrentYear();
        
        return view('admin.classes.create', [
            'students' => $students,
            'levels' => Level::all(['id', 'title']),
            'subLevels' => SubLevel::all(['id', 'title', 'level_id'])
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
        $scholarYear = ScholarYear::where(
            'scholar_year', config('scholaryear.current_scholar_year')
        )->first();

        $classe = Classe::create([
            'sub_level_id' => $request->sub_level_id,
            'scholar_year_id' => $scholarYear->id,
            'title' => $request->title,
        ]);

        foreach ($request->modules as $key => $module) {
            if(!empty($module)) {
                Module::create([
                    'title' => $module,
                    'color' => $request->colors[$key],
                    'classe_id' => $classe->id
                ]);
            }
        }

        foreach ($request->students as $key => $student) {
            if(!empty($student)) {
                $classe->students()->attach($student);
            }
        }

        session()->flash('success', 'Saved');

        return redirect()->route('classes.show', ['id' => $classe->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::findOrFail($id);
        $levels = Level::all(['id', 'title']);
        $subLevels = SubLevel::all(['id', 'title', 'level_id']);

        return view('admin.classes.show', [
            'classe' => $classe,
            'levels' => $levels,
            'subLevels' => $subLevels
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
        $classe = Classe::findOrFail($id);

        $classe->update(
            $request->only('title', 'description', 'sub_level_id')
        );

        session()->flash('success', 'Updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);

        $classe->delete();

        session()->flash('success', 'Deleted');

        return redirect()->route('classes.index');
    }

    public function courses($classeId)
    {
        $classe = Classe::findOrFail($classeId);
        $courses = [];
        foreach ($classe->modules as $key => $module) {
            foreach ($module->courses as $key => $course) {
                $courses[] = CourseResource::make($course);
            }
        }

        return response()->json([
            'courses' => $courses
        ], 200);
    }
}

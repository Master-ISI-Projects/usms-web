<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Departement;
use App\Models\Teacher;
use App\Helpers\Helper;
use App\Helpers\Constant;
use App\Http\Resources\CourseResource;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.teachers.index', [
            'teachers' => Teacher::filter(
                request()->all()
            )->paginate(
                Constant::COUNT_PER_PAGE
            ),
            'departements' => Departement::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create', [
            'departements' => Departement::all()
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
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'picture' => Helper::saveFileFromRequest($request, 'picture'),
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => Constant::USER_ROLES['teacher'],
            'is_active' => $request->is_active ? true : false,
        ]);

        $user->teacher()->save(
            Teacher::create([
                'birth_date' => Helper::parseDate($request->birth_date),
                'departement_id' => $request->departement_id,
            ])
        );

        session()->flash('success', 'Saved');

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.teachers.show', [
            'teacher' => Teacher::findOrFail($id)
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
        return view('admin.teachers.edit', [
            'teacher' => Teacher::findOrFail($id)
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
        $teacher = Teacher::findOrFail($id);

        $teacher->user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'picture' => Helper::saveFileFromRequest($request, 'picture', $teacher->user->picture) ?? $teacher->user->picture,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $teacher->user->password,
            'visible_password' => $request->password ? $request->password : $teacher->user->visible_password,
            'is_active' => $request->is_active ? true : false,
        ]);

        $teacher->update([
            'birth_date' => Helper::parseDate($request->birth_date),
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->user->delete();

        session()->flash('success', 'Deleted');

        return redirect()->route('teachers.index');
    }

    public function courses($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);

        return response()->json([
            'courses' => CourseResource::collection($teacher->courses)
        ], 200);
    }
}

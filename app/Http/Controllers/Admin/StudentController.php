<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Helpers\Constant;
use App\Helpers\Helper;
use App\Models\Student;
use App\Models\Classe;
use App\Models\Option;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.students.index', [
            'students' => Student::filter(request()->all())->paginate(Constant::COUNT_PER_PAGE),
            'departements' => Departement::all(['id', 'name']),
            'options' => Option::all(['id', 'name', 'departement_id'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create', [
            'departements' => Departement::all(),
            'options' => Option::all(),
            'classes' => Classe::all()
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
            'role' => Constant::USER_ROLES['student'],
            'is_active' => $request->is_active ? true : false
        ]);

        $user->student()->save(
            Student::create([
                'birth_date' => Helper::parseDate($request->birth_date),
                'apogee_number' => $request->apogee_number,
            ])
        );

        $user->student->classes()->attach($request->classe_id);

        session()->flash('success', 'Saved');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.students.show', [
            'student' => Student::findOrFail($id)
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
        return view('admin.students.edit', [
            'student' => Student::findOrFail($id),
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
        $student = Student::findOrFail($id);

        $student->user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'picture' => Helper::saveFileFromRequest($request, 'picture', $student->user->picture) ?? $student->user->picture,
            'tel' => $request->tel,
            'email' => $request->email,
            'is_active' => $request->is_active ? true : false,
        ]);

        $student->update([
            'birth_date' => Helper::parseDate($request->birth_date),
            'apogee_number' => $request->apogee_number,
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->user->delete();

        session()->flash('success', 'Deleted');

        return redirect()->route('students.index');
    }

    public function updateClasse(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if(optional($student->currentClasse)->id) {
            $student->classes()->detach($student->currentClasse->id);
        }
        $student->classes()->attach($request->class_id);

        session()->flash('success', 'Updated');

        return redirect()->route('students.index');
    }

    public function deleteClasse(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if(optional($student->currentClasse)->id) {
            $student->classes()->detach($student->currentClasse->id);
        }

        session()->flash('success', 'Deleted');

        return redirect()->route('students.index');
    }
}

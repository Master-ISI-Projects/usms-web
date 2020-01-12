<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classe;
use App\Helpers\Helper;
use App\Models\Student;
use App\Models\Option;
use App\Models\Semester;
use App\Helpers\Constant;
use App\Models\ScholarYear;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.classes.index', [
            'classes' => Classe::paginate(
                Constant::COUNT_PER_PAGE
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.classes.create', [
            'departements' => Departement::all(),
            'options' => Option::all(),
            'students' => Student::all(),
            'semesters' => Semester::all(),
            'scholarYears' => ScholarYear::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::findOrFail($id);

        return view('admin.classes.show', [
            'classe' => $classe
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
        $classe = Classe::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_at' => Helper::parseDate($request->start_at),
            'duration' => $request->duration,
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', null, 'classes_images')
        ]);

        dd($classe);

        session()->flash('success', 'Saved');

        return redirect()->route('classes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classe = Classe::findOrFail($id);

        return view('admin.classes.edit', [
            'classe' => $classe,
            'scholarYears' => ScholarYear::all()
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

        $classe->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_at' => Helper::parseDate($request->start_at),
            'duration' => $request->duration,
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', $classe->image, 'classes_images') ?? $classe->image
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('classes.index');
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

        return redirect()->back();
    }
}

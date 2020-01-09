<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubLevel;

class SubLevelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubLevel::create($request->only('level_id', 'title'));

        session()->flash('success', 'Saved');

        return redirect()->back();
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
        $subLevel = SubLevel::findOrFail($id);

        $subLevel->update($request->only('level_id', 'title'));

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
        $subLevel = SubLevel::findOrFail($id);

        $subLevel->delete();

        session()->flash('success', 'Deleted');
        
        return redirect()->back();
    }
}

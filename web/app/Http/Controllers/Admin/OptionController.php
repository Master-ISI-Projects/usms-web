<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Option::create(
            $request->only('name', 'departement_id')
        );

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
        $departement = Option::findOrFail($id);

        $departement->update(
            $request->only('name')
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
        $departement = Option::findOrFail($id);
        $departement->delete();

        session()->flash('success', 'Deleted');

        return redirect()->back();
    }
}

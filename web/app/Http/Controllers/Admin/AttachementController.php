<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Attachement;

class AttachementController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attachement = Attachement::create([
            'name' => $request->name,
            'url' => Helper::saveFileFromRequest($request, 'attachement', null, 'attachements'),
        ]);

        session()->flash('success', 'Deleted');

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
        $attachement = Attachement::findOrFail($id);

        $attachement->delete();

        session()->flash('success', 'Deleted');

        return redirect()->back();
    }
}

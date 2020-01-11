<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Helpers\Helper;
use App\Helpers\Constant;
use App\Models\ScholarYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.index', [
            'events' => Event::paginate(
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
        return view('admin.events.create', [
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
        $event = Event::findOrFail($id);

        return view('admin.events.show', [
            'event' => $event
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
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_at' => Helper::parseDate($request->start_at),
            'duration' => $request->duration,
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', null, 'events_images')
        ]);

        dd($event);

        session()->flash('success', 'Saved');

        return redirect()->route('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.edit', [
            'event' => $event,
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
        $event = Event::findOrFail($id);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_at' => Helper::parseDate($request->start_at),
            'duration' => $request->duration,
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', $event->image, 'events_images') ?? $event->image
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        session()->flash('success', 'Deleted');

        return redirect()->back();
    }
}

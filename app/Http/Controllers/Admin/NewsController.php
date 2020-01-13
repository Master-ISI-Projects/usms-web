<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Helpers\Helper;
use App\Helpers\Constant;
use App\Models\ScholarYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index', [
            'news' => News::paginate(
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
        return view('admin.news.create', [
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
        $news = News::findOrFail($id);

        return view('admin.news.show', [
            'news' => $news
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
        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'published_at' => Helper::parseDate($request->published_at),
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', null, 'new_images')
        ]);

        session()->flash('success', 'Saved');

        return redirect()->route('news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', [
            'news' => $news,
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
        $news = News::findOrFail($id);

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'published_at' => Helper::parseDate($request->published_at),
            'scholar_year_id' => $request->scholar_year_id,
            'image' => Helper::saveFileFromRequest($request, 'image', $news->image, 'news_images') ?? $news->image
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        session()->flash('success', 'Deleted');

        return redirect()->back();
    }
}

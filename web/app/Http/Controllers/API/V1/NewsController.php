<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\NewsResource;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::currentYear()->get();
        // dd(\App\Helpers\Helper::getCurrentYearId());
        return response()->json([
            'news' => NewsResource::collection($news)
        ], 200);
    }
}

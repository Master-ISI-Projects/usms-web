<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attachement;
use App\Http\Resources\API\V1\AttachementResource;

class AttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = auth()->user()->student;
        $attachements = ($student->current_classe)->attachements ?? [];

        return response()->json(AttachementResource::collection($attachements), 200);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\NotificationResource;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = auth()->user()->student;
        $notifications = ($student->current_classe)->notifications ?? [];

        return response()->json(NotificationResource::collection($notifications), 200);
    }
}

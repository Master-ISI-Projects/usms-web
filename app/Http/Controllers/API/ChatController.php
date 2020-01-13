<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Message;
use App\Http\Resources\MessageResource;
use App\Events\MessageSent;

class EventController extends Controller
{
    public function index()
    {
        $messages = Event::where($id)->messages;

        return response()->json([
            'messages' => MessageResource::collection($messages)
        ], 200);
    }

    public function addCourseMessages(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->user()->id,
            'course_id' => $request->id,
            'content' => $request->content
        ]);

        $message = MessageResource::make($message);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'message' => $message
        ], 201);
    }
}

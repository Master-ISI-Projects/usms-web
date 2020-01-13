<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('course-chat-{courseId}', function ($user, $courseId) {
  	if(!auth()->check() || !auth()->user()->is_active) {
  		return false;
  	}

  	$course = \App\Models\Course::findOrFail($courseId);
    
    if(auth()->user()->role == Constant::USER_ROLES['student']) {
        return (optional(auth()->user()->student->currentClasse)->id && (optional(auth()->user()->student->currentClasse)->id == $course->module->classe_id));
    } elseif(auth()->user()->role == Constant::USER_ROLES['teacher']) {
        return (auth()->user()->teacher->id == $course->teacher_id);
    } else {
        return true;
    }
});

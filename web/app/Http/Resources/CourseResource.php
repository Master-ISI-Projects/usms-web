<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;
use App\Helpers\Constant;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $courseUrl = route('courses.show', ['id' => $this->id]);
        switch (auth()->user()->role) {
            case Constant::USER_ROLES['student']:
                $courseUrl = route('student.students.course', ['id' => $this->id]);
            break;

            case Constant::USER_ROLES['teacher']:
                $courseUrl = route('teacher.course', ['id' => $this->id]);
            break;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'classeName' => $this->module->classe->title,
            'module' => $this->module->title,
            'teacher' => $this->teacher->user->full_name,
            'duration' => $this->duration,
            'start' => $this->published_at,
            'backgroundColor' => $this->module->color,
            'color' => '#fff',
            'end' => Helper::addMinutesToDate($this->published_at, $this->duration),
            'dateDeration' => Helper::formatDate($this->published_at) . ' - ' . $this->duration . ' Minutes',
            'courseUrl' => $courseUrl,
        ];
    }
}

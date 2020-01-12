<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image_path,
            'description' => $this->description,
            'start_at' => Helper::formatDate($this->start_at, 'd-m-Y à h:i'),
            'duration' => $this->duration,
            'scholar_year_id' => $this->scholarYear->scholar_year ?? '##',
            'createdAt' => $this->created_at,
        ];
    }
}

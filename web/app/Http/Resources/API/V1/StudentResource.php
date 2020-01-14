<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'firstName' => $this->user->first_name,
            'lastName' => $this->user->last_name,
            'classeId' => optional($this->current_classe)->id ?? '##',
            'classeName' => optional($this->current_classe)->name ?? '##',
            'token' => \JWTAuth::fromUser($this->user),
        ];
    }
}

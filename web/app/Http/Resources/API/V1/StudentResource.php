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
        dd($request->all());
        return [
            'id' => $request->id,
            'firstName' => $request->user->first_name,
            'lastName' => $request->last_name,
            'classeId' => optional($request->current_classe)->id ?? '##',
            'classeName' => optional($request->current_classe)->name ?? '##',
            'token' => \JWTAuth::fromUser($request->user),
        ];
    }
}

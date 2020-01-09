<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Constant;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $role = $this->user->role == Constant::USER_ROLES['teacher'] ? 'Enseignant' : (Constant::USER_ROLES['admin'] ? 'Admin' : '');
        return [
            'id' => $this->id,
            'createdAt' => $this->created_at,
            'isOwner' => auth()->user()->id == $this->user_id,
            'content' => $this->content,
            'userId' => $this->user_id,
            'userName' => $this->user->full_name . ($this->user->role != Constant::USER_ROLES['student'] ? ' - ' . $role : ''),
        ];
    }
}

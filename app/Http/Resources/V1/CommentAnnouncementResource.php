<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentAnnouncementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $userDetails = User::where('id', $this->id_user)->get()->toArray();
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'content' => $this->content,
            'userId' => $this->id_user,
            'announcementId' => $this->id_announcement,
            'userName' => $userDetails[0]['name'],
            'createdAt' => $this->created_at,
            'uptadetAt' => $this->updated_at
        ];
    }
}

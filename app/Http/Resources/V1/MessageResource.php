<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $userDetails = User::where('id', $this->id_user)->get()->toArray();
        return [
            'id' => $this->id,
            'content' => $this->content,
            'chatId' => $this->id_chat,
            'userId' => $this->id_user,
            'userName' => $userDetails[0]['name'],
            'createdAt' => $this->created_at
        ];
    }
}

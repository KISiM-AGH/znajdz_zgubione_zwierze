<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class MediaFileResource extends JsonResource
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
                'name' => $this->name,
                'type' => $this->type,
                'url' => $this->url,
                'userId' => $this->id_user
            ];
        }
}

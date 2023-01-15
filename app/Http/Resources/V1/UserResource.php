<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Role;

class UserResource extends JsonResource
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
        $roleDetails = Role::where('id', $this->id_role)->get()->toArray();
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'location' => $this->location,
            'roleName' => $roleDetails[0]['name'],
            'createdAt' => $this->created_at
        ];
    }
}

<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class PostResource extends JsonResource
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
        //dd($this->id_user);
        $userDetails = User::where('id', $this->id_user)->get()->toArray();
        $mediaFileDetails = $this::find($this->id)->mediaFile()->get()->toArray();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            '' => $this->id_chat,
            'userId' => $this->id_user,
            'userName' => $userDetails[0]['name'],
            'imageUrl' => $mediaFileDetails[0]['url'],
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'comments' => CommentPostResource::collection($this->whenLoaded('commentPosts'))
        ];
    }
}

<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\TypeAnnouncement;

class AnnouncementResource extends JsonResource
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
        //$coordinateDetails = Coordinate::where('id', $this->id_coordinate)->get()->toArray();
        $coordinateDetails = $this::find($this->id)->coordinate()->get()->toArray();
        $userDetails = User::where('id', $this->id_user)->get()->toArray();
        //$mediaFileDetails = MediaFile::where('id', $this->id_media_file)->get()->toArray();
        $mediaFileDetails = $this::find($this->id)->mediaFile()->get()->toArray();
        $typeAnnouncementDetails = TypeAnnouncement::where('id', $this->id_type_announcement)->get()->toArray();
        //dd($coordinateDetails);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'localization' => $this->localization,
            'description' => $this->description,
            'latitude' => $coordinateDetails[0]['latitude'],
            'longitude' => $coordinateDetails[0]['longitude'],
            'userId' => $this->id_user,
            'userName' => $userDetails[0]['name'],
            'userEmail' => $userDetails[0]['email'],
            'typeAnnouncement' => $typeAnnouncementDetails[0]['name'],
            'imageUrl' => $mediaFileDetails[0]['url'],
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'comments' => CommentAnnouncementResource::collection($this->whenLoaded('commentAnnouncements'))
        ];
    }
}

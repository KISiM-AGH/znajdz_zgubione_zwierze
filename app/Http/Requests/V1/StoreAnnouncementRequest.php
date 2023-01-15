<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Announcement;

class StoreAnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:512',
            'localization' => 'required|string|max:512',
            'description' => 'required|string|max:1024',
            'typeAnnouncementId' => 'required|numeric',
            'coordinateId' => 'required|numeric',
            'mediaFileId' => 'required|numeric',
            'userId' => 'required|numeric'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_type_announcement' => $this->typeAnnouncementId,
            'id_coordinate' => $this->coordinateId,
            'id_media_file' => $this->mediaFileId,
            'id_user' => $this->userId
        ]);
    } 
}

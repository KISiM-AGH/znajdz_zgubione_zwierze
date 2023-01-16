<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT')
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
        } else
        {
            return [
                'title' => 'sometimes|required|string|max:512',
                'localization' => 'sometimes|required|string|max:512',
                'description' => 'sometimes|required|string|max:1024',
                'typeAnnouncementId' => 'sometimes|required|numeric',
                'coordinateId' => 'sometimes|required|numeric',
                'mediaFileId' => 'sometimes|required|numeric',
                'userId' => 'sometimes|required|numeric'
            ];
        }
        
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

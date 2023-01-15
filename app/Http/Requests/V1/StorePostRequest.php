<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
        'title' => 'required|string|max:256',
        'description' => 'required|string|max:512',
        'body' => 'required|string',
        'userId' => 'required|numeric',
        'mediaFileId' => 'required|numeric',
        'isBan' => ['required', Rule::in([0, 1])]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_user' => $this->userId,
            'is_ban' => $this->isBan,
            'id_media_file' => $this->mediaFileId
         ]);
    } 
}

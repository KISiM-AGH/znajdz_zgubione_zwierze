<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommentAnnouncementRequest extends FormRequest
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
            'content' => 'required|string|max:2048',
            'announcementId' => 'required|numeric',
            'userId' => 'required|numeric',
            'isBan' => ['required', Rule::in([0, 1])]
        ];
    }

    
    protected function prepareForValidation()
    {
        $this->merge([
            'id_announcement' => $this->announcementId,
            'id_user' => $this->userId,
            'is_ban' => $this->isBan
        ]);
    } 
}

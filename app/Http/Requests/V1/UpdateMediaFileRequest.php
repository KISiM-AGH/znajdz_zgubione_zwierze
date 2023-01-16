<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaFileRequest extends FormRequest
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
        'name' => 'required|string',
        'type' => 'required|string',
        'url' => 'required|url',
        'userId' => 'required|numeric'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_user' => $this->userId
        ]);
    }
}

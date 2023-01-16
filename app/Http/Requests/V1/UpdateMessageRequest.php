<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'content' => 'required|string',
            'chatId' => 'required|numeric',
            'userId' => 'required|numeric'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_user' => $this->userId,
            'id_chat' => $this->chatId
        ]);
    }
}

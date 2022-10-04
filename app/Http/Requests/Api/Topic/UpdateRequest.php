<?php

namespace App\Http\Requests\Api\Topic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            //
            'id' => 'required|numeric',
            'name' => 'required|string|unique:topics',
            'order' => 'required|numeric|unique:topics'
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'source' => 'required|string',
            'media' => 'required|string',
            'destination' => 'required|string',
            'provider_id' => 'required|numeric'
        ];
    }
}

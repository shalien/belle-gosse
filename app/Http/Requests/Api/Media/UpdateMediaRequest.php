<?php

namespace App\Http\Requests\Api\Media;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
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
            'link' => 'required|string|unique:medias',
            'source_id' => 'required|exists:\App\Models\Source,id',
            'destination_id' => 'required|exists:\App\Models\Destination,id',
        ];
    }
}

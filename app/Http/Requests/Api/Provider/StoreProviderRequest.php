<?php

namespace App\Http\Requests\Api\Provider;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            //
            'provider_type_id' => 'required|exists:\App\Models\ProviderType,id',
            'link' => 'required|string',
            'topic_id' => 'required|numeric|exists:\App\Models\Topic,id',
        ];
    }
}

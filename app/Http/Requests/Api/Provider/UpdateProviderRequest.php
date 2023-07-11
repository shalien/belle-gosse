<?php

namespace App\Http\Requests\Api\Provider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'links' => 'present|array|exists:provider_links,id',
            'topic_id' => 'required|numeric|exists:\App\Models\Topic,id',
            'provider_link_id' => 'required|numeric|exists:\App\Models\ProviderLink,id',
        ];
    }
}

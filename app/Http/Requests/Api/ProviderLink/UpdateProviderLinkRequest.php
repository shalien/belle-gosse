<?php

namespace App\Http\Requests\Api\ProviderLink;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderLinkRequest extends FormRequest
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
            'link' => 'required|string',
            'provider_type_id' => 'required|integer|exists:provider_types,id',
            'providers' => 'present|array|exists:providers,id'
        ];
    }
}

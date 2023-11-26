<?php

namespace App\Http\Requests\_OLD\Channel;

use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'snowflake' => 'required|string|max:255',
            'name' => ['required', 'string', 'max:255'],
            'guild_snowflake' => ['required', 'string', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
{
    use ApiValidationErrorResponse;
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
            'email' => 'sometimes|required|email|max:50|unique:users',
            'telefono' => 'nullable|string|max:20',
        ];
    }
}

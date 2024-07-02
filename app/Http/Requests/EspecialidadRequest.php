<?php

namespace App\Http\Requests;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class EspecialidadRequest extends FormRequest
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
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'sometimes|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class ReportesRequest extends FormRequest
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
            'escuelaProfesional' => 'sometimes|required|string|max:255',
            'fechaInicio' => 'sometimes|required_with:fechaFin|date',
            'fechaFin' => 'sometimes|required_with:fechaInicio|date|after_or_equal:fechaInicio',
            'especialidad' => 'sometimes|required|string|exists:especialidades,nombre'
        ];
    }
}

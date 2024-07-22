<?php

namespace App\Http\Requests;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class CitasRequest extends FormRequest
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
    public function rules()
    {
        return [
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
            'especialista_id' => 'required|exists:especialistas,user_id',
            'paciente_id' => 'sometimes|required|exists:pacientes,user_id'
        ];
    }
}

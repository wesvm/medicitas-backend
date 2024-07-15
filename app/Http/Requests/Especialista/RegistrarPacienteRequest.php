<?php

namespace App\Http\Requests\Especialista;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegistrarPacienteRequest extends FormRequest
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
            'dni' => 'required|string|max:20|unique:users',
            'email' => 'required|email|max:50|unique:users',

            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'fecha_nacimiento' => 'required|date',
            'lugar_nacimiento' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'escuela_profesional' => 'sometimes|required|string|max:255',
            'ocupacion' => 'sometimes|string|max:255',
            'tipo_seguro' => 'required|string|max:255',
            'telefono_emergencia' => 'nullable|string|max:20',
        ];
    }
}

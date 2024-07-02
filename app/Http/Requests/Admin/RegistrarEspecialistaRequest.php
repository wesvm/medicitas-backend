<?php

namespace App\Http\Requests\Admin;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegistrarEspecialistaRequest extends FormRequest
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
            'password' => 'required|string|min:3',
            'email' => 'required|email|max:50|unique:users',

            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'especialidad_id' => 'required|integer|exists:especialidades,id',
            'horario_atencion_id' => 'required|integer|exists:horario_atencion,id',
        ];
    }
}

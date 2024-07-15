<?php

namespace App\Http\Requests\Especialista;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

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

        $escuelas = [
            'Ingenieria de Sistemas e Informatica',
            'Ingenieria de Minas',
            'Ingenieria Ambiental',
            'Ingenieria Agroindustrial',
            'Ingenieria Pesquera',
            'Ingenieria Civil',
            'Derecho',
            'Medicina',
            'Administracion',
            'Contabilidad',
            'Gestion Publica y Desarrollo Social'
        ];

        return [
            'dni' => 'required|string|max:20|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before_or_equal:' . now()->format('Y-m-d') . '|after_or_equal:1900-01-01',
            'lugar_nacimiento' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'escuela_profesional' => 'nullable|string|max:255|in:' . implode(',', $escuelas),
            'ocupacion' => 'nullable|string|max:255',
            'tipo_seguro' => 'required|string|in:SIS,ESSALUD|max:255',
            'telefono_emergencia' => 'nullable|string|max:20',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Traits\ApiValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreConsultaRequest extends FormRequest
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
            'cita_id' => 'sometimes|nullable|exists:citas,id',
            'motivo_consulta' => 'required|string|max:255',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'observaciones' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
            'paciente_id' => 'required|exists:pacientes,user_id',
            'especialista_id' => 'sometimes|exists:especialistas,user_id',
        ];
    }
}

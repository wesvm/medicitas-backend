<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cita_id' => $this->cita_id,
            'motivo_consulta' => $this->motivo_consulta,
            'fecha_hora' => $this->fecha_hora,
            'diagnostico' => $this->diagnostico,
            'tratamiento' => $this->tratamiento,
            'observaciones' => $this->observaciones,
            'proxima_cita' => $this->proxima_cita,
            'paciente' => [
                'user_id' => $this->paciente->user_id,
                'dni' => $this->paciente->user->dni,
                'email' => $this->paciente->user->email,
                'nombres' => $this->paciente->nombres,
                'apellidos' => $this->paciente->apellidos,
                'edad' => $this->paciente->edad,
                'fechaNacimiento' => $this->paciente->fecha_nacimiento,
                'lugarNacimiento' => $this->paciente->lugar_nacimiento,
                'domicilio' => $this->paciente->domicilio,
                'telefono' => $this->paciente->telefono,
                'escuelaProfesional' => $this->paciente->escuela_profesional,
                'ocupacion' => $this->paciente->ocupacion,
                'tipoSeguro' => $this->paciente->tipo_seguro,
                'telefonoEmergencia' => $this->paciente->telefono_emergencia,
            ],
            'especialista_id' => $this->especialista_id,
        ];
    }
}

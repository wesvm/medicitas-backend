<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
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
            'dni' => $this->dni,
            'email' => $this->email,
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
        ];
    }
}

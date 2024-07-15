<?php

namespace App\Http\Resources\Especialista;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EspecialistaCitaDetalleResource extends JsonResource
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
            'fecha' => $this->fecha,
            'hora' => Carbon::parse($this->hora)->format('H:i'),
            'estado' => $this->estado,
            'motivo' => $this->motivo,
            'paciente' => [
                'user_id' => $this->paciente->user_id,
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
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setData($this->toArray($request));
    }
}

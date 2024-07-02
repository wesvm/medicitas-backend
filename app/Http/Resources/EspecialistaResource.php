<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EspecialistaResource extends JsonResource
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
            'nombres' => $this->especialista->nombres,
            'apellidos' => $this->especialista->apellidos,
            'telefono' => $this->especialista->telefono,
            'horarioAtencionId' => $this->especialista->horario_atencion_id,
            'especialidadId' => $this->especialista->especialidad_id,
        ];
    }
}

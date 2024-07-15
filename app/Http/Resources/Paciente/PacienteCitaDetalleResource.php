<?php

namespace App\Http\Resources\Paciente;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteCitaDetalleResource extends JsonResource
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
            'especialista' => [
                'user_id' => $this->especialista->user_id,
                'nombres' => $this->especialista->nombres,
                'apellidos' => $this->especialista->apellidos,
                'telefono' => $this->especialista->telefono,
                'especialidad' => $this->especialista->especialidad->nombre,
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setData($this->toArray($request));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\HorarioAtencion;
use Illuminate\Http\Request;

class HorarioAtencionController extends Controller
{
    public function getHorarioById($id)
    {
        $horario = HorarioAtencion::findOrFail($id);
        return response()->json($horario);
    }

    public function getHorarioByEspecialistaId($id)
    {
        $especialista = Especialista::findOrFail($id);
        $horario = $especialista->horarioAtencion;

        return response()->json([
            'id' => $horario->id,
            'hora_inicio' => $horario->hora_inicio,
            'hora_fin' => $horario->hora_fin,
        ]);
    }
}

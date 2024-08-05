<?php

namespace App\Http\Controllers\Especialista;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInfoRequest;
use App\Http\Resources\Especialista\EspecialistaCitaDetalleResource;
use App\Http\Resources\PacienteResource;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Especialista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosController extends Controller
{
    public function me(Request $request)
    {
        $userId = Auth::user()->id;
        $especialista = Especialista::where('user_id', $userId)->first();
        return response()->json($especialista);
    }

    public function update(UpdateInfoRequest $request)
    {
        $user = Auth::user();
        $admin = Especialista::where('user_id', $user->id)->first();

        $user->email = $request->input('email');
        $admin->telefono = $request->input('telefono');
        $admin->save();
        $user->save();

        return response()->json(['message' => 'Se ha actualizado su información']);
    }

    public function obtenerPacientes()
    {
        $userId = Auth::user()->id;

        $pacientes = User::whereHas('paciente.citas', function ($query) use ($userId) {
            $query->where('especialista_id', $userId);
        })
            ->with('paciente')
            ->get();
        $list = PacienteResource::collection($pacientes)->resolve();

        return response()->json($list, 200);
    }

    public function obtenerCitasPaciente($id)
    {
        $citas = Cita::where('paciente_id', $id)->get()->reverse()->values();;
        return response()->json($citas, 200);
    }

    public function obtenerConsultasPaciente($id)
    {
        $citas = Consulta::where('paciente_id', $id)->get()->reverse()->values();;
        return response()->json($citas, 200);
    }

    public function obtenerConsultaByIdPaciente($id, $cId)
    {
        $consulta = Consulta::where('paciente_id', $id)
            ->where('cita_id', $cId)
            ->first();
        return response()->json($consulta, 200);
    }
}

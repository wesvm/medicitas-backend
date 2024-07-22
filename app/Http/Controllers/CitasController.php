<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitasRequest;
use App\Models\Cita;
use App\Models\Especialista;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitasRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $user = Auth::user();

            $isSpecialist = $user->rol === 'especialista';

            $fechaCita = Carbon::parse($data['fecha']);
            $horaCita = Carbon::parse($data['hora']);
            $pacienteId = $user->id;

            if ($isSpecialist) {
                $pacienteId = $data['paciente_id'];
            }

            $especialistaId = $data['especialista_id'];

            $citasPaciente = Cita::where('paciente_id', $pacienteId)
                ->where('fecha', $fechaCita->format('Y-m-d'))
                ->where('hora', $horaCita->format('H:i:s'))
                ->exists();

            if ($citasPaciente) {
                return response()
                    ->json(['error' => 'Ya tienes una cita a la misma hora y fecha.'], 400);
            }

            $especialista = Especialista::with(['horarioAtencion'])->find($especialistaId);
            $horaInicio = Carbon::parse($especialista->horarioAtencion->hora_inicio);
            $horaFin = Carbon::parse($especialista->horarioAtencion->hora_fin);

            if ($horaCita->lt($horaInicio) || $horaCita->gt($horaFin)) {
                return response()->json(['error' => 'La cita no está dentro del horario de atención del especialista.'], 400);
            }

            $data['estado'] = 'pendiente';
            $data['paciente_id'] = $pacienteId;
            $cita = Cita::create($data);
            DB::commit();
            return response()
                ->json(['message' => 'Cita creada exitosamente.', 'cita' => $cita], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ocurrió un error al registrar la cita. Por favor, intenta nuevamente más tarde.'], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

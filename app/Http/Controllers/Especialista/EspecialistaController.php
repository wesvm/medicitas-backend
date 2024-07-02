<?php

namespace App\Http\Controllers\Especialista;

use App\Http\Controllers\Controller;
use App\Http\Requests\Especialista\RegistrarPacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EspecialistaController extends Controller
{
    public function registrarPaciente(RegistrarPacienteRequest $request)
    {
        try {

            DB::beginTransaction();

            $user = User::create([
                'dni' => $request->dni,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'rol' => 'paciente',
            ]);

            if (!$user) {
                throw new \Exception('Error al crear usuario.');
            }

            $paciente = Paciente::create([
                'user_id' => $user->id,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'edad' => $request->edad,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'lugar_nacimiento' => $request->lugar_nacimiento,
                'domicilio' => $request->domicilio,
                'telefono' => $request->telefono,
                'escuela_profesional' => $request->escuela_profesional,
                'ocupacion' => $request->ocupacion,
                'tipo_seguro' => $request->tipo_seguro,
                'telefono_emergencia' => $request->telefono_emergencia,
            ]);

            if (!$paciente) {
                throw new \Exception('Error al crear paciente.');
            }

            DB::commit();

            return response()->json(['message' => 'Paciente registrado!'], 201);
        } catch (\Exception $e) {
            DB::rollback();

            // Log::error('Error al registrar paciente: ' . $e->getMessage());

            return response()->json(['message' => 'Ocurrió un error al registrar el paciente. Por favor, intenta nuevamente más tarde.'], 400);
        }
    }

    public function obtenerPacientes()
    {
        $pacientes = User::porRolActivo('paciente')->with('paciente')->get();
        return response()->json(PacienteResource::collection($pacientes));
    }

    public function activarPaciente($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->activar();
        return response()->json(['message' => 'Paciente activado correctamente.']);
    }

    public function desactivarPaciente($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->desactivar();
        return response()->json(['message' => 'Paciente desactivado correctamente.']);
    }

    public function eliminarPaciente($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->delete();
        return response()->json(['message' => 'Paciente eliminado.']);
    }
}

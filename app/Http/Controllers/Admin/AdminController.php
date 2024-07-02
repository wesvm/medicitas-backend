<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegistrarEspecialistaRequest;
use App\Http\Resources\EspecialistaResource;
use App\Models\Especialista;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function registrarEspecialista(RegistrarEspecialistaRequest $request)
    {
        try {

            DB::beginTransaction();

            $user = User::create([
                'dni' => $request->dni,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'rol' => 'especialista',
            ]);

            if (!$user) {
                throw new \Exception('Error al crear usuario.');
            }

            $especialista = Especialista::create([
                'user_id' => $user->id,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'especialidad_id' => $request->especialidad_id,
                'horario_atencion_id' => $request->horario_atencion_id,
            ]);

            if (!$especialista) {
                throw new \Exception('Error al crear especialista.');
            }

            DB::commit();

            return response()->json(['message' => 'Especialista registrado!'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ocurrió un error al registrar el especialista. Por favor, intenta nuevamente más tarde.'], 400);
        }
    }

    public function obtenerEspecialistas()
    {
        $especialistas = User::porRolActivo('especialista')->with('especialista.especialidad')->get();
        return response()->json(EspecialistaResource::collection($especialistas));
    }

    public function activarEspecialista($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->activar();
        return response()->json(['message' => 'Especialista activado correctamente.']);
    }

    public function desactivarEspecialista($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->desactivar();
        return response()->json(['message' => 'Especialista desactivado correctamente.']);
    }

    public function eliminarEspecialista($dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();
        $user->delete();
        return response()->json(['message' => 'Especialista eliminado.']);
    }
}

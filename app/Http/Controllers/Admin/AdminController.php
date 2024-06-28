<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialista;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function registrarEspecialista(Request $request)
    {
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'dni' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:3',
                'email' => 'required|string|max:50|unique:users',

                'nombres' => 'required|string|max:50',
                'apellidos' => 'required|string|max:50',
                'telefono' => 'string|max:20',
                'especialidad_id' => 'required|integer|exists:especialidades,id',
                'horario_atencion_id' => 'required|integer|exists:horario_atencion,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Verifica los campos.',
                    'errors' => $validator->errors()
                ], 422);
            }

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
            throw $e;
            return response()->json(['message' => 'Ocurrió un error al registrar el especialista. Por favor, intenta nuevamente más tarde.'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paciente\UpdateInfoRequest;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosController extends Controller
{

    public function me(Request $request)
    {
        $userId = Auth::user()->id;
        $paciente = Paciente::where('user_id', $userId)->first();
        return response()->json($paciente);
    }

    public function update(UpdateInfoRequest $request)
    {
        $user = Auth::user();
        $paciente = Paciente::where('user_id', $user->id)->first();

        $user->email = $request->input('email');
        $paciente->telefono = $request->input('telefono');
        $paciente->telefono = $request->input('domicilio');
        $paciente->telefono = $request->input('telefono_emergencia');
        $paciente->save();
        $user->save();

        return response()->json(['message' => 'Se ha actualizado su información']);
    }
}

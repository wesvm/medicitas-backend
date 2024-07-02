<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
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
}

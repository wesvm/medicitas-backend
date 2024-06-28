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
        $pacienteid = Auth::user()->id;
        $paciente = Paciente::find($pacienteid);
        return response()->json($paciente);
    }
}

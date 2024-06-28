<?php

namespace App\Http\Controllers\Especialista;

use App\Http\Controllers\Controller;
use App\Models\Especialista;
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

    public function obtenerEspecialistas()
    {
        $especialistas = Especialista::all();
        return response()->json($especialistas);
    }
}

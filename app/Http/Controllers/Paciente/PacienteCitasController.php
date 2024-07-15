<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Http\Resources\Paciente\PacienteCitaDetalleResource;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteCitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $citas = Cita::where('paciente_id', $user->id)->get();

        // if ($citas->isEmpty()) {
        //     return response()->json(['message' => 'No tienes citas.'], 404);
        // }

        return response()->json($citas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $cita = Cita::with(['paciente', 'especialista'])->findOrFail($id);
        if ($cita->paciente_id != $user->id) {
            return response()->json(['error' => 'No tienes permiso para ver esta cita.'], 403);
        }
        return new PacienteCitaDetalleResource($cita);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

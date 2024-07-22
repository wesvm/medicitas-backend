<?php

namespace App\Http\Controllers\Especialista;

use App\Http\Controllers\Controller;
use App\Http\Resources\Especialista\EspecialistaCitaDetalleResource;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaCitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $citas = Cita::where('especialista_id', $user->id)->get();

        // if ($citas->isEmpty()) {
        //     return response()->json(['message' => 'Aún ningun paciente registro una cita.'], 404);
        // }

        return response()->json($citas);
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
        $cita = Cita::with(['paciente.user'])->findOrFail($id);
        return new EspecialistaCitaDetalleResource($cita);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'estado' => 'required|string|in:pendiente,completado,no asistió',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->estado = $validated['estado'];
        $cita->save();

        return response()->json([
            'message' => 'Cita actualizada correctamente',
            'cita' => $cita
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

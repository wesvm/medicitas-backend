<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadRequest;
use App\Http\Resources\EspecialidadResource;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->except(
            'obtenerEspecialidades',
            'obtenerEspecialidadesConEsp'
        );
    }

    public function obtenerEspecialidades()
    {
        $especialidades = Especialidad::activas()->get();
        return response()->json(EspecialidadResource::collection($especialidades));
    }

    public function obtenerEspecialidadesConEsp()
    {
        $especialidades = Especialidad::activas()->with('especialistas')->get();
        return response()->json($especialidades);
    }

    public function agregarEspecialidad(EspecialidadRequest $request)
    {
        $especialidad = Especialidad::create($request->validated());

        return response()->json(
            ['message' => 'Especialidad creada con éxito', 'especialidad' => $especialidad],
            201
        );
    }

    public function actualizarEspecialidad($id, EspecialidadRequest $request)
    {
        $especialidad = $this->findEspecialidadOrFail($id);
        $especialidad->fill($request->validated());

        if ($especialidad->isClean()) {
            return response()->json(['message' => 'No hay cambios para actualizar.'], 200);
        }

        $especialidad->save();

        return response()->json(
            ['message' => 'Especialidad actualizada con éxito', 'especialidad' => $especialidad]
        );
    }

    public function desactivarEspecialidad($id)
    {
        $especialidad = $this->findEspecialidadOrFail($id);
        $especialidad->desactivar();

        return response()->json(['message' => 'Especialidad desactivada.']);
    }

    public function eliminarEspecialidad($id)
    {
        $especialidad = $this->findEspecialidadOrFail($id);
        $especialidad->delete();

        return response()->json(['message' => 'Especialidad eliminada.']);
    }

    private function findEspecialidadOrFail($id): Especialidad
    {
        $especialidad = Especialidad::find($id);
        if (!$especialidad) {
            abort(404, 'Especialidad no encontrada.');
        }
        return $especialidad;
    }
}

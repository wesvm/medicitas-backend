<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportesRequest;
use App\Models\Cita;
use App\Models\Especialidad;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function obtenerConteoCitas(ReportesRequest $request)
    {
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        $citasQuery = Cita::query();

        if ($fechaInicio) {
            $citasQuery->where('fecha', '>=', Carbon::parse($fechaInicio));
        }
        if ($fechaFin) {
            $citasQuery->where('fecha', '<=', Carbon::parse($fechaFin));
        }

        $citas = $citasQuery->with('paciente', 'especialista.especialidad')->get();
        $totalCitas = $citas->count();

        $estudiantes = $citas->filter(function ($cita) {
            return !empty($cita->paciente->escuela_profesional);
        })->count();
        $noEstudiantes = $totalCitas - $estudiantes;

        $especialidades = Especialidad::pluck('nombre')->toArray();
        $citasPorEspecialidad = $citas->groupBy(function ($cita) {
            return $cita->especialista->especialidad->nombre;
        })->map->count();

        $especialidadesResult = collect($especialidades)->map(function ($nombre) use ($citasPorEspecialidad) {
            return [
                'nombre' => $nombre,
                'total' => $citasPorEspecialidad->get($nombre, 0)
            ];
        });

        $citasPorDia = $citas->groupBy(function ($cita) {
            return Carbon::parse($cita->fecha)->toDateString();
        })->map(function ($group, $date) use ($especialidades) {
            $especialidadesPorDia = collect($especialidades)->mapWithKeys(function ($nombre) {
                return [$nombre => 0];
            });

            $group->groupBy(function ($cita) {
                return $cita->especialista->especialidad->nombre;
            })->each(function ($especialidadGroup, $nombre) use (&$especialidadesPorDia) {
                $especialidadesPorDia[$nombre] = $especialidadGroup->count();
            });

            $especialidadesFormato = $especialidadesPorDia->map(function ($total, $nombre) {
                return [
                    'nombre' => $nombre,
                    'total' => $total
                ];
            })->values();

            return [
                'dia' => $date,
                'especialidades' => $especialidadesFormato
            ];
        })->values();

        $response = [
            'fechaInicio' => $fechaInicio ? Carbon::parse($fechaInicio)->toDateString() : null,
            'fechaFin' => $fechaFin ? Carbon::parse($fechaFin)->toDateString() : null,
            'citas' => [
                'total' => $totalCitas,
                'estudiantes' => $estudiantes,
                'noEstudiantes' => $noEstudiantes,
                'especialidades' => $especialidadesResult->values()->all(),
            ],
            'dias' => $citasPorDia->all()
        ];

        return response()->json($response);
    }

    public function obtenerDetalleReportes(ReportesRequest $request)
    {
        $data = $request->validated();
    }
}

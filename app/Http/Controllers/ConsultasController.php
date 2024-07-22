<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultaRequest;
use App\Http\Resources\ConsultaResource;
use App\Models\Cita;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:especialista,admin')->except([
            'index',
            'show',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $especialista_id = $user->id;

        $consultas = Consulta::where('especialista_id', $especialista_id)->get();

        $consultasArray = ConsultaResource::collection($consultas)->resolve();

        return response()->json($consultasArray, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsultaRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $especialista_id = $user->id;
            $data = $request->validated();
            $data['especialista_id'] = $especialista_id;

            $consulta = Consulta::create($data);

            if ($request->has('cita_id')) {
                $cita = Cita::find($request->input('cita_id'));
                if ($cita) {
                    $cita->estado = 'completado';
                    $cita->save();
                }
            }

            DB::commit();
            return response()
                ->json(['message' => 'Consulta creada exitosamente.', 'consulta' => $consulta], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ocurrió un error al registrar la consulta. Por favor, intenta nuevamente más tarde.', 'err' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

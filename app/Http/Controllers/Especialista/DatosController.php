<?php

namespace App\Http\Controllers\Especialista;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInfoRequest;
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

    public function update(UpdateInfoRequest $request)
    {
        $user = Auth::user();
        $admin = Especialista::where('user_id', $user->id)->first();

        $user->email = $request->input('email');
        $admin->telefono = $request->input('telefono');
        $admin->save();
        $user->save();

        return response()->json(['message' => 'Se ha actualizado su información']);
    }
}

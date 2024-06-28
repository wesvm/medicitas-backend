<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosController extends Controller
{
    public function me(Request $request)
    {
        $userId = Auth::user()->id;
        $admin = Administrador::where('user_id', $userId)->first();
        return response()->json($admin);
    }
}

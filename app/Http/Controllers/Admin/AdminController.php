<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function me(Request $request)
    {
        $adminId = Auth::user()->id;
        $admin = Administrador::find($adminId);
        return response()->json($admin);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function showUsuario(Request $request)
    {
        $user = User::with("roles")->find($request->auth);
        return response()->json([
            "message" => "Datos del usuario",
            "status" => true,
            "data" => $user
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function jwt(User $user)
     {
        $payload = [
            "iss" => "api-ayarte-jwt",
            "sub" => ["id" => $user->id, "nombresApellidos" => $user->nombresApellidos],
            "iat" => time(),
            "exp" => time() + 60 * 20
        ];

        return JWT::encode($payload, env("JWT_SECRET"), "HS256");
    }
    // "password" => "required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/"
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            "usuario" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where("usuario", $this->request->input("usuario"))->where("estado", "!=", "Eliminado")->first();

        if(!$user){
            return response()->json([
                "message" => "El Usuario no existe",
                "status" => false
            ], 400);
        }

        if($user->estado == "Suspendido"){
            return response()->json([
                "message" => "Lo sentimos el usuario estan suspendido.",
                "status" => true,
                "token" => $this->jwt($user)
            ], 400);
        }

        if(Hash::check($this->request->input("password"), $user->password)){
            return response()->json([
                "message" => "Inicio de Sesión Correctamente.",
                "status" => true,
                "token" => $this->jwt($user)
            ], 200);
        }

        return response()->json([
            "message" => "El Usuario y/o Contraseña son incorrectos",
            "status" => false
        ], 400);
    }
}

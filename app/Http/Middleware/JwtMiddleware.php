<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->header("Authorization"))
        {
            return response()->json([
                "message" => "Se requiere un token",
                "status" => false,
            ], 202);
        }

        $array_token = explode(" ", $request->header("Authorization"));
        $token = $array_token[1];

        if($token == "Token.Nulled"){
            return response()->json([
                "message" => "El token a expirado",
                "status" => false
            ], 202);

        }

        try {
            $credentials = JWT::decode($token, new Key(env("JWT_SECRET"), "HS256"));
        } catch (ExpiredException $e) {
            return response()->json([
                "message" => "El token a expirado",
                "status" => false
            ], 202);
        } catch (Exception $e){
            return response()->json([
                "message" => "Ago salio mal al verificar el token",
                "status" => false
            ], 202);
        }

        $user = User::with('roles:id,rol,estado')->find($credentials->sub->id);

        $request->auth = $user;

        return $next($request);



    }
}

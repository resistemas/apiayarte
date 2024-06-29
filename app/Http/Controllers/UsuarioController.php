<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    private $request;
    private $modulo = "Usuario";

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function showUsuario()
    {
        $user = User::with('roles:id,rol,estado')->find($this->request->auth->id);
        return response()->json([
            "message" => "Usuario autenticado",
            "status" => true,
            "data" => [$user],
        ], 200);
    }

    public function store(){

        $validate = Validator::make($this->request->all(),[
            "rol_id" => "required|integer",
            "nombresApellidos" => "required|string",
            "correoElectronico" => "required|string|email",
            "photo" => "required|string",
            "usuario" => "required|string",
            "password" => "required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,15}/",
            "estado" => "required|string"
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }

        $very = User::Where("correoElectronico",$this->request->input("correoElectronico"))->where("estado","<>","Elimiando")->get();

        if(!$very->isEmpty()){
            return response()->json([
                'message' => "El Correo: ". $this->request->input("correoElectronico") . ", Ya se encuentra en uso.",
                'status' => false
            ],202);
        }

        $req = User::create([
            "rol_id" => $this->request->input("rol_id"),
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => $this->request->input("nombresApellidos"),
            "correoElectronico" => $this->request->input("correoElectronico"),
            "photo" => $this->request->input("photo"),
            "usuario" => $this->request->input("usuario"),
            "password" => Hash::make($this->request->input("password")),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Agregado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }else{
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

    }

    public function update($usuario){
        if($usuario == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $validate = Validator::make($this->request->all(),[
            "rol_id" => "required|integer",
            "nombresApellidos" => "required|string",
            "correoElectronico" => "required|string|email",
            "photo" => "required|string",
            "usuario" => "required|string",
            "password" => $this->request->input("password") == "" ? "" : "required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,15}/",
            "estado" => "required|string"
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }


        $req = User::find($usuario);
        $req->update([
            "rol_id" => $this->request->input("rol_id"),
            "nombresApellidos" => $this->request->input("nombresApellidos"),
            "correoElectronico" => $this->request->input("correoElectronico"),
            "photo" => $this->request->input("photo"),
            "usuario" => $this->request->input("usuario"),
            "password" => $this->request->input("password") == "" ? $req->password : Hash::make($this->request->input("password")),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Actualizado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);
    }

    public function destroy($usuario){
        if($usuario == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $req = User::find($usuario);
        $req->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Eliminado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);

    }

    public function show(){

        $items = User::with('roles:id,rol')->select('id','rol_id','codigo','nombresApellidos','correoElectronico','photo','usuario','estado')
        ->where('estado','<>','Eliminado')
        ->orderBy('id','asc')->get();

        if($items->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $items
        ], 200);


    }

    public function detalle($usuario){
        if($usuario == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $item = User::with('rol:id,rol')->select('id','rol_id','codigo','nombresApellidos','correoElectronico','photo','usuario','estado')
        ->where('id',$usuario)->get();

        if($item->isEmpty()){
            return response()->json([
                'message' => $this->modulo . " Detalle",
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => $this->modulo . " Detalle",
            'status' => true,
            'data' => $item
        ],200);
    }

}

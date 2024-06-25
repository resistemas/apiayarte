<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoritoController extends Controller
{
    private $request;
    private $modulo = "Favoritos";

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){

        $validate = Validator::make($this->request->all(),[
            "cliente_id" => "required|string",
            "producto_id" => "required|string",
            "estado" => "required|string"
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 202);
        }

        $verify = Favorito::where("cliente_id", $this->request->input("cliente_id"))
        ->where("producto_id", $this->request->input("producto_id"))
        ->where("estado", "Activo")->get();

        if(!$verify->isEmpty()){
            return response()->json([
                'message' => "La artesania ya existe en la lista de " . $this->modulo.".",
                'status' => false
            ],202);
        }

        $req = Favorito::create([
            "cliente_id" =>$this->request->input("cliente_id"),
            "producto_id" =>$this->request->input("producto_id"),
            "estado" =>$this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo.", Agregado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);

    }

    public function destroy($favorito){
        if($favorito == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $req = Favorito::find($favorito);
        $req->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo.", Eliminado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);

    }

    public function show($usuario){

        if($usuario == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $items = Favorito::with("cliente:id,codigo,nombresApellidos,usuario")
        ->with(["producto" => function($query){
            $query->with("vendedor:id,nombresApellidos")->with("categoria:id,categoria")
            ->select("id","usuario_id","categoria_id","codigo","producto","descripcion","photo_video","precio","estado");
        }])
        ->select('id','cliente_id','producto_id','estado')
        ->where("cliente_id",$usuario)->where('estado','<>','Eliminado')
        ->orderBy('id','asc')->get();

        if($items->isEmpty()){
            return response()->json([
                'message' => "Usted aun no tiene Artisanias ".$this->modulo.".",
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de sus Artesanias ".$this->modulo.".",
            'status' => true,
            'data' => $items
        ], 200);


    }

}

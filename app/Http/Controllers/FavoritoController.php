<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){
        $validatte = $this->validate($this->request, [
            "usuario_id" => "required|string",
            "producto_id" => "required|string",
            "estado" => "required|string",
        ]);

        if($validatte){
            $req = Favorito::created([
                "usuario_id" => $validatte["usuario_id"],
                "producto_id" => $validatte["producto_id"],
                "estado" => $validatte["estado"],
            ]);

            if($req){
                return response()->json([
                    'message' => "Favoritos, Agregado Correctamente",
                    'status' => true,
                    'data' => $req
                ], 200);
            }

            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],402);
    }    

    public function destroy($favorito){
        if($favorito == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $req = Favorito::find($favorito)->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => "Favorito, Eliminado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],402);

    }

    public function show($usuario){

        if($usuario == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $items = Favorito::with("cliente:id,codigo,nombresApellidos,usuario")
        ->with("producto:id,categoria_id,codigo,producto,descripcion,photo_video,precio,estado")
        ->select('id','cliente_id','producto_id','estado')
        ->where("cliente_id",$usuario)
        ->orderBy('id','asc')->get();

        if($items->isEmpty()){
            return response()->json([
                'message' => "Listado de Favoritos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Listado de Favoritos",
            'status' => true,
            'data' => $items
        ], 200);


    }  
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){

        $validate = Validator::make($this->request->all(),[
            "categoria" => "required|string",
            "estado" => "required|string"
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }
        
        $req = Categoria::create([
            "categoria" => $this->request->input("categoria"),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => "Categoria, Agregado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
        }else{
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }       
    
    }

    public function update($categoria){
        if($categoria == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $validate = Validator::make($this->request->all(),[
            "categoria" => "required|string",
            "estado" => "required|string"
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }

        
        $req = Categoria::find($categoria);
        $req->update([
            "categoria" => $this->request->input("categoria"),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => "Categoria, Actualizado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],402);
    }

    public function destroy($categoria){
        if($categoria == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $req = Categoria::find($categoria);
        $req->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => "Categoria, Eliminado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],402);

    }

    public function show(){

        $items = Categoria::select('id','categoria','estado')
        ->where('estado','<>','Eliminado')
        ->orderBy('id','asc')->get();

        if($items->isEmpty()){
            return response()->json([
                'message' => "Listado de Categorias",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Listado de Categorias",
            'status' => true,
            'data' => $items
        ], 200);


    }    

    public function detalle($categoria){
        if($categoria == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }
        
        $item = Categoria::select('id','categoria','estado')
        ->where('id',$categoria)->get();

        if($item->isEmpty()){
            return response()->json([
                'message' => "Categoria Detalle",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Categoria Detalle",
            'status' => true,
            'data' => $item
        ],200);
    }
}

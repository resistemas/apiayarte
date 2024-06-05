<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){
        $validatte = $this->validate($this->request, [
            "usuario_id" => "required|string",
            "categoria_id" => "required|string",
            "codigo" => "required|string",
            "producto" => "required|string",
            "descripcion" => "required|string",
            "photo_video" => "required|string",
            "precio" => "required|string",
            "estado" => "required|string",
        ]);

        if($validatte){
            $req = Producto::created([
                "usuario_id" => $validatte["usuario_id"],
                "categoria_id" => $validatte["categoria_id"],
                "codigo" => $validatte["codigo"],
                "producto" => $validatte["producto"],
                "descripcion" => $validatte["descripcion"],
                "photo_video" => $validatte["photo_video"],
                "precio" => $validatte["precio"],
                "estado" => $validatte["estado"],
            ]);

            if($req){
                return response()->json([
                    'message' => "Producto, Agregado Correctamente",
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

    public function update($producto){
        if($producto == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $validatte = $this->validate($this->request, [
            "usuario_id" => "required|string",
            "categoria_id" => "required|string",
            "codigo" => "required|string",
            "producto" => "required|string",
            "descripcion" => "required|string",
            "photo_video" => "required|string",
            "precio" => "required|string",
            "estado" => "required|string",
        ]);

        if($validatte){
            $req = Producto::find($producto)->update([
                "usuario_id" => $validatte["usuario_id"],
                "categoria_id" => $validatte["categoria_id"],
                "codigo" => $validatte["codigo"],
                "producto" => $validatte["producto"],
                "descripcion" => $validatte["descripcion"],
                "photo_video" => $validatte["photo_video"],
                "precio" => $validatte["precio"],
                "estado" => $validatte["estado"],
            ]);

            if($req){
                return response()->json([
                    'message' => "Producto, Actualizado Correctamente",
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

    public function destroy($producto){
        if($producto == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],402);
        }

        $req = Producto::find($producto)->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => "Producto, Eliminado Correctamente",
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

        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->where('usuario_id',$usuario)
        ->orderBy('id','asc')->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => "Listado de Productos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Listado de Productos",
            'status' => true,
            'data' => $producto
        ], 200);


    }

    public function masVendidos(){
        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->orderBy('id','asc')->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => "Productos Mas Vendidos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Productos Mas Vendidos",
            'status' => true,
            'data' => $producto
        ], 200);


    }

    public function relacionado(){
        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->orderBy('id','desc')->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => "Productos Mas Vendidos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Productos Relacionados",
            'status' => true,
            'data' => $producto
        ],200);
    }

    public function detalle($producto){
        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->where('id',$producto)->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => "Productos Mas Vendidos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Productos Mas Vendidos",
            'status' => true,
            'data' => $producto
        ],200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
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

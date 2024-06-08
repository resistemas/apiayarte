<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    private $request;
    private $modulo = "Producto";

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){

        $validate = Validator::make($this->request->all(),[
            "usuario_id" => "required|string",
            "categoria_id" => "required|string",
            "codigo" => "required|string",
            "producto" => "required|string",
            "descripcion" => "required|string",
            "photo_video" => "required|string",
            "precio" => "required|string",
            "estado" => "required|string",
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }

        $req = Producto::create([
            "usuario_id" => $this->request->input("usuario_id"),
            "categoria_id" => $this->request->input("categoria_id"),
            "codigo" => $this->request->input("codigo"),
            "producto" => $this->request->input("producto"),
            "descripcion" => $this->request->input("descripcion"),
            "photo_video" => $this->request->input("photo_video"),
            "precio" => $this->request->input("precio"),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Agregado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
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

        $validate = Validator::make($this->request->all(),[
            "usuario_id" => "required|string",
            "categoria_id" => "required|string",
            "codigo" => "required|string",
            "producto" => "required|string",
            "descripcion" => "required|string",
            "photo_video" => "required|string",
            "precio" => "required|string",
            "estado" => "required|string",
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }


        $req = Producto::find($producto)->update([
            "usuario_id" => $this->request->input("usuario_id"),
            "categoria_id" => $this->request->input("categoria_id"),
            "codigo" => $this->request->input("codigo"),
            "producto" => $this->request->input("producto"),
            "descripcion" => $this->request->input("descripcion"),
            "photo_video" => $this->request->input("photo_video"),
            "precio" => $this->request->input("precio"),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Actualizado Correctamente",
                'status' => true,
                'data' => $req
            ], 200);
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

        $req = Producto::find($producto);
        $req->update([
            "estado" => "Eliminado",
        ]);

        if($req){
            return response()->json([
                'message' => $this->modulo . ", Eliminado Correctamente",
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
        ->where('usuario_id', $usuario)
        ->orderBy('id','asc')->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $producto
        ], 200);


    }

    public function masVendidos(){
        $producto = DetalleVenta::with(['producto' => function($query){
            $query->with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
            ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado');
        }])->select('id','venta_id','producto_id','cantidad','total')
        ->groupBy('producto_id')->orderBy('producto_id','asc')->limit(10)->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => $this->modulo. " Mas Vendidos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => $this->modulo. " Mas Vendidos",
            'status' => true,
            'data' => $producto
        ], 200);


    }

    public function nuevos(){
        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->orderBy('id','desc')->limit(10)->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => $this->modulo . " Nuevos",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => $this->modulo . " Nuevos",
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
                'message' => $this->modulo . " Detalle",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => $this->modulo . " Detalle",
            'status' => true,
            'data' => $producto
        ],200);
    }

    public function productoRelacionado($categoria){
        $producto = Producto::with('vendedor:id,nombresApellidos,photo')->with('categoria:id,categoria')
        ->select('id','usuario_id','categoria_id','codigo','producto','descripcion','photo_video','precio','estado')
        ->where('categoria_id',$categoria)->get();

        if($producto->isEmpty()){
            return response()->json([
                'message' => $this->modulo . " Relacionados",
                'status' => false
            ],402);
        }

        return response()->json([
            'message' => $this->modulo . " Relacionados",
            'status' => true,
            'data' => $producto
        ],200);
    }
}

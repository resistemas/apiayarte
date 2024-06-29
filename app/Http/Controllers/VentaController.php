<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VentaController extends Controller
{
    private $request;
    private $modulo = "Venta";

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(){
        $validate = Validator::make($this->request->all(),[
            "artesano_id" => "required|string",
            "cliente_id" => "required|string",
            "ciudad" => "required|string",
            "direccion" => "required|string",
            "producto_id" => "required|string",
            "cantidad" => "required|string",
            "total" => "required|string",
            "estado" => "required|string",
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }

        $very = Venta::where('cliente_id',$this->request->input("cliente_id"))->where('estado','Iniciado')->orderBy('id','desc')->get();
        if(!$very->isEmpty()){
            return response()->json([
                'message' => "Usted ya tiene una Venta Iniciada, termine la venta para poder seguir comprando.",
                'status' => false,
                'data' => []
            ], 202);
        }

        $req = Venta::create([
            "artesano_id" => $this->request->input("artesano_id"),
            "cliente_id" => $this->request->input("cliente_id"),
            "codigo" => Str::upper(Str::random(8)),
            "ciudad" => $this->request->input("ciudad"),
            "direccion" => $this->request->input("direccion"),
            "estado" => $this->request->input("estado"),
        ]);

        if($req){
            VentaDetalleController::store($this->request, $req->id);

            $favoDelete = Favorito::where('producto_id',$this->request->input("producto_id"))->where('cliente_id', $this->request->input("cliente_id"))
            ->where('estado','Activo')->get();

            if(!$favoDelete->isEmpty()){
                Favorito::find($favoDelete[0]->id)->update([
                    'estado' => "Eliminado"
                ]);
            }

            return response()->json([
                'message' => $this->modulo . ", Agregado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);
    }

    public function update($venta){
        if($venta == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $validate = Validator::make($this->request->all(),[
            "estado" => "required|string",
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }


        $req = Venta::find($venta);
        $req->update([
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

    public function show(){

        $detalle = Venta::with('artesano:id,nombresApellidos,photo')->with('cliente:id,nombresApellidos,photo')
        ->with(['detalle' => function($query){
            $query->with('producto:id,codigo,producto,descripcion,photo_video,precio,estado')
            ->select('venta_id','producto_id','cantidad','total','estado');
        }])
        ->select('id', 'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado')
        ->where('estado','<>','Eliminado')->get();

        if($detalle->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $detalle
        ], 200);
    }

    public function showVenta($venta){
        if($venta == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $detalle = Venta::with('artesano:id,nombresApellidos,photo')->with('cliente:id,nombresApellidos,photo')
        ->with(['detalle' => function($query){
            $query->with('producto:id,codigo,producto,descripcion,photo_video,precio,estado')
            ->select('id','venta_id','producto_id','cantidad','total','estado');
        }])
        ->select('id', 'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado')
        ->where('id', $venta)->get();

        if($detalle->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $detalle
        ], 200);
    }

    public function showVentaCliente($cliente){
        if($cliente == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $detalle = Venta::with('artesano:id,nombresApellidos,photo')->with('cliente:id,nombresApellidos,photo')
        ->with(['detalle' => function($query){
            $query->with('producto:id,codigo,producto,descripcion,photo_video,precio,estado')
            ->select('venta_id','producto_id','cantidad','total','estado');
        }])
        ->select('id', 'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado')
        ->where('cliente_id', $cliente)->orderBy('id','desc')->get();

        if($detalle->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $detalle
        ], 200);

    }

    public function showVentaArtesano($artesano){
        if($artesano == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $detalle = Venta::with('artesano:id,nombresApellidos,photo')->with('cliente:id,nombresApellidos,photo')
        ->with(['detalle' => function($query){
            $query->with('producto:id,codigo,producto,descripcion,photo_video,precio,estado')
            ->select('venta_id','producto_id','cantidad','total','estado');
        }])
        ->select('id', 'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado')
        ->where('artesano_id', $artesano)->orderBy('id','desc')->get();

        if($detalle->isEmpty()){
            return response()->json([
                'message' => "Listado de " . $this->modulo,
                'status' => false
            ],202);
        }

        return response()->json([
            'message' => "Listado de " . $this->modulo,
            'status' => true,
            'data' => $detalle
        ], 200);

    }
}

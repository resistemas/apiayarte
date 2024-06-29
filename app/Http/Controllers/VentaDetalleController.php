<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentaDetalleController extends Controller
{
    private $modulo = "Venta Detalle";

     static public function store(Request $request, $venta){

        $validate = Validator::make($request->all(),[
            "producto_id" => "required|string",
            "cantidad" => "required|string",
            "total" => "required|string",
        ]);

        if($validate->fails()){
            return response()->json([
                "message" => "Campos Requeridos",
                "status" => false,
                "data" => $validate->errors()
            ], 400);
        }

        $req = DetalleVenta::create([
            "venta_id" => $venta,
            "producto_id" => $request->input("producto_id"),
            "cantidad" => $request->input("cantidad"),
            "total" => $request->input("total")
        ]);

        if($req){
            return response()->json([
                'message' => "Detalle Venta, Agregado Correctamente",
                'status' => true,
                'data' => [$req]
            ], 200);
        }

        return response()->json([
            'message' => "Sucedio algo al proceder con la solicitud.",
            'status' => false
        ],202);
    }

    public function show($venta){
        if($venta == ""){
            return response()->json([
                'message' => "Sucedio algo al proceder con la solicitud.",
                'status' => false
            ],202);
        }

        $detalle = DetalleVenta::with('venta:id,codigo,ciudad,direccion,estado')->with(["producto" => function($query){
            $query->with('categoria:id,categoria,estado')->select("codigo",'producto','descripcion','photo_video','precio','estado');
        }])
        ->select('id','venta_id','producto_id','cantidad','total','estado')
        ->where('venta_id', $venta)->get();

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

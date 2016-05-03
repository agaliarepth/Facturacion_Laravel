<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use App\Models\detalleIngresos;
use Carbon\Carbon;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('almacen.ingresos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listar(Request $request){

        $in=Ingreso::all();
        if($request->ajax()){

            return response()->json(["data"=>$in]);

        }
    }
    public function create()
    {
        return view('almacen.ingresos.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            $in=new Ingreso();
       $in->concepto=$request['concepto'];
        $in->documento=$request['documento'];
        $in->numdocu=$request['numdocu'];
        $in->fecha=date("Y-m-d",strtotime($request['fecha']));
        $in->obser=$request['obser'];
        $in->terminado=1;
        $in->estado=1;
        $in->total=$request["total"];
        $in->save();
            $detalle=array();
            for($i=0 ;$i<$request["numfilas"];$i++){
              $f=array("cant"=>$request["cantidad"][$i],"ingresos_id"=>$in->id,"productos_id"=>$request["id"][$i]);
              array_push($detalle,$f);
            }
            detalleingresos::insert($detalle);

           /*for($i=0 ;$i<$request["numfilas"];$i++){
                $f=new detalleIngresos(array("cant"=>$request["cantidad"][$i],"ingresos_id"=>$in->id,"productos_id"=>$request["id"][$i]));
                array_push($detalle,$f);
            }$in->detalleingresos()->save($detalle);*/

           return view("almacen.ingresos.index");
        }
        catch(Exception $e){
          return view("errors.503");

        }





        // return dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

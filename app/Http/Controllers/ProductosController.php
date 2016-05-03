<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $c=categoria::all();
         $p=Producto::with('categoria')->get();
        return view('productos.index',["categorias"=>$c,"listaProductos"=>$p]);

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   sleep(0.8);
         $p=new Producto();
        $rules=[
         "descripcion"=>"required",
         "pu"=>"required|numeric",
         "codbarras"=>"unique:productos,codbarras",
         "categorias_id"=>"exists:categorias,id"
        ];
        $messages=[
          "categorias_id.exists"=>"No se han registrado ninguna categoria",
          "descripcion.required"=>"El campo Descripcion esta vacio",
          "pu.required"=>"El campo Precio venta esta vacio",
          "pu.numeric"=>"El campo Precio  venta debe ser un numero ",
          "codbarras.unique"=>"El codigo de este producto ya existe"
        ];

        $validator=\Validator::make($request->all(),$rules,$messages);

        if($request->ajax()){

            if($validator->fails()){

             return response()->json([
              "created"=>false,

              "mensajes"=>$validator->messages()->all()

             ]);

            }
            else
            {

             $file=$request->file('foto');
           $nombre = $file->getClientOriginalName();
            \Storage::disk('local')->put($nombre,\File::get($file));


           $p->codbarras=$request["codbarras"];
           $p->descripcion=$request["descripcion"];
           $p->pu=$request["pu"];
           $p->cu=$request["cu"];
           $p->unidad=$request["unidad"];

           $p->foto=$nombre;
           $p->categorias_id=$request["categorias_id"];
           $p->save();
           $desc=categoria::find( $p->categorias_id);
           return response()->json([
              "created"=>true,
              "campos"=>$p,
              "descripcion_categoria"=>$desc->descripcion
                                  ]);
        }

        }
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
    public function edit($id,Request $request)
    {
      $p=Producto::find($id);
      $url=url();
      if($request->ajax()){
        return response()->json([
          "productos"=>$p->toArray(),
          "status"=>200,
          "url"=>$url
        ]);
      }
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
           sleep(0.8);
          $p=Producto::find($id);
          //$p->fill($request->all());
          $p->descripcion=$request["descripcion_edit"];
          $p->codbarras=$request["codbarras_edit"];
          $p->pu=$request["pu_edit"];
          $p->unidad=$request["unidad_edit"];
          $p->categorias_id=$request["categorias_id_edit"];
          $p->foto=$request["foto"];
          $p->id=$id;



          $status=0;
          try{
          $p->save();
          $status="200";
        }
          catch(Exception $e)
          {
          $status=500;

          }
        if($request->ajax()){
          return response()->json([
            "status"=>$status,
            "productos"=>$p

          ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function deshabilitar($id){
       $p=Producto::find($id);
       $p->estado=0;
       $status="";
       try{
         $p->save();
         $status="200";
       }
       catch (Exception $e){

         $status="500";
       }

       if(request()->ajax()){
        return response()->json([
          "status"=>$status,

        ]);

       }

     }

     public function habilitar($id){
       $p=Producto::find($id);
       $p->estado=1;
       $status="";
       try{
         $p->save();
         $status="200";
       }
       catch (Exception $e){

         $status="500";
       }

       if(request()->ajax()){
        return response()->json([
          "status"=>$status,

        ]);

       }

     }
    public function destroy($id)
    {
      $p=Producto::find($id);
      $status="200";

      try{
        \Storage::delete($p->foto);
      $p->delete();

      $status="200";
    }
      catch(Exception $e){
       $status="400";

      }
    if(request()->ajax()){
          return response()->json([
          "status"=>$status
          ]);


    }

    }
    public function listar(Request $request){

          $p=Producto::with('categoria')->get();
       $public_path = url();
        $url=$public_path."/public/storage/";

       foreach($p->toArray() as $key){

        $res[]=array(
            "id"=>$key["id"],
            "codbarras"=>$key["codbarras"],
            "descripcion"=>$key["descripcion"],
            "pu"=>$key["pu"],
            "unidad"=>$key["unidad"],
            "categorias_id"=>$key["categorias_id"],
            "foto"=>$url.$key["foto"],
            "categorias_desc"=>$key['categoria']['descripcion'],
            "estado"=>$key['estado']
          );
    }


             if($request->ajax()){
             return  response()->json([
              "data"=>$res
            ]);

               }
             }

 public function autocompletar(Request $request){
    $term= $request['term'];

    $p=Producto::where('descripcion', 'LIKE', '%'.$term.'%')->orWhere('codbarras', 'LIKE', '%'.$term.'%')->get();
    return response()->json($p);

 }

  }

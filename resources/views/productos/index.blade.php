@extends('layouts.master')
@section('content')





 <div class="row">
                <div class="col-md-12">
                  <section class="panel-default" style="margin-top:-2em">
                    <header class="panel-heading">
                    	<span style="margin-right:1em">PRODUCTOS</span>

                              <a href="#myModal" data-toggle="modal" class="btn btn-success"> Nuevo Producto <i class="fa fa-plus"></i></a>
                               @include('productos.nuevo')

                    </header>
                     <div class="panel-body" >
                <section id="unseen">
               <table  class="display table table-bordered table-striped" id="productos-table">
                                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th class="numeric">Categoria</th>
                            <th >Descripcion</th>
                            <th >Unidad</th>
                            <th class="numeric">Precio</th>
                            <th class="numerihc">Acciones</th>

                        </tr>
                        </thead>
                        <tbody id="campos">

                        @include('productos.editar')
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                </section>
            </div>
                    </section>
                </div>

            </div>
@endsection

@section('script')
<script type="text/javascript">

  $(document).ready(function($)
  {


 var tablaProductos=$('#productos-table').dataTable( {

   "ajax":{
     "url":'productos/listar'
   },
   "bProcessing": true,

   "fnRowCallback": function( nRow, aData, iDisplayIndex ) {

               if ( aData['estado'] == "0" )
               {
                     $('td:eq(6)', nRow).html( '<a href="###" id="'+aData["id"]+'" class="btn btn-success btn-xs" onclick="habilitar(this.id)"> <i class="fa fa-check"></i>Habilitar</a>' );

               }
           },
   "columns": [
      { "data": "id" },
      { "data": "codbarras" },
      { "data": "categorias_desc" },
      { "data": "descripcion" },
      { "data": "unidad" },
      { "data": "pu" },
      { "data": "id",
      "orderable": false,
                "searchable": false,
                  "render": function(data,type,row,meta) {

                    var a ='<a href="#editModal" data-toggle="modal" class="btn  btn-primary btn-xs" id="'+data+'" onclick="cargarModal(this.id);"> <i class="fa fa-edit"></i>  Editar</a> <a class="btn  btn-warning btn-xs" id="'+data+'" onclick="deshabilitar(this.id);"><i class="fa fa-thumbs-o-down"></i> Deshabilitar</a><a class="btn  btn-danger btn-xs" id="'+data+'" onclick="borrar(this.id);"><i class="fa fa-eraser"></i> Borrar</a></td></tr>';

                    return a;
           }

     }

  ],


        "bPaginate": true,
        "oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
             "sSearch": "<B>BUSCAR:</B>"

        },

        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
         "iDisplayLength": -1,
        "aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
        "sPaginationType": "full_numbers"

    } );

});



           function limpiar(){
            $("#codbarras").val("");
            $("#descripcion").val("");
            $("#pu").val("0");

            //$("#categorias_id").val("");
            $("#foto").val("");


        }
        function cargarModal( id){

          var route="productos/edit/"+id;
         $.get(route,function(response){

              $("#descripcion_edit").val(response["productos"].descripcion);
              $("#codbarras_edit").val(response["productos"].codbarras);
              $("#pu_edit").val(response["productos"].pu);
              $("#unidad_edit").val(response["productos"].unidad);
              $("#categorias_id_edit").val(response["productos"].categorias_id);
              $("#idproductos").val(response["productos"].id);
              $("#imagen_edit").attr("src",response.url+'/public/storage/'+response["productos"].foto);
                    });
            }


           function create(){

            var formData = new FormData($("#form")[0]);
            var route="productos/create";
            var token=$("#_token").val();

            $.ajax({
              url:route,
              cache:false,
              type:"POST",
              contentType:false,
              processData:false,
              dataType:"json",
              headers:{"X-CSRF-TOKEN":token},
              data:formData,

              beforeSend: function(data) {
                    $("#modal-lock").attr( 'class','modal-lock');
                  },
              success:function(response){


             if(response.created==true){
                $('#productos-table').DataTable().ajax.reload(null, false);
                               limpiar();
               $("#myModal").modal('toggle');
                 $("#modal-lock").attr( 'class','modal-lock hidden');

                   //swal("","correcto","success");

                 }

                else{
                  var error="Se han encontrado los siguientes errores.\n ";
                 $(response.mensajes).each(function(key,value){
                  error+=value+"\n";
                  });

                    swal("",error,"error");
                 $("#modal-lock").attr('class','modal-lock hidden');
                 }
              }
            });

           }
  function deshabilitar(id){

     var route="productos/deshabilitar/"+id;
     swal({
  title: "Esta seguro.?",
  text: "Se deshabilitara el producto y no podra usarlo!",
  type: "warning",
  showCancelButton: true,
  cancelButtonText: "Cancelar",
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Deshabilitarlo!",
  closeOnConfirm: true
},
function(){
  $.get(route,function(response){
    if(response.status="200"){
    //  swal("deshabilitado!", "", "success");
      $('#productos-table').DataTable().ajax.reload(null, false);

    }
    else {
      swal("Ocurrio un error","error");
    }
});
  //
});

}

function habilitar(id){
var route="productos/habilitar/"+id;
swal({
title: "Esta seguro.?",
text: "Se habilitara el producto y podra usarlo!",
type: "success",
showCancelButton: true,
cancelButtonText: "Cancelar",
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Habilitarlo!",
closeOnConfirm: true
},
function(){
$.get(route,function(response){

if(response.status="200"){
    $('#productos-table').DataTable().ajax.reload(null, false);
}
else {
    swal("Ocurrio un error","error");
}

});

});


}

      function update(){
        var id=$("#idproductos").val();
        var route="productos/update/"+id;
        var Data=new FormData($("#form_edit")[0]);
        var token=$("#_token").val();
      $("#campos tr").find(13).remove();

        $.ajax({
          url:route,
          cache:false,
          type:"POST",
          contentType:false,
          processData:false,
          dataType:"json",
          headers:{"X-CSRF-TOKEN":token},
          data:Data,
          beforeSend: function(data) {
                $("#modal-lock").attr( 'class','modal-lock');
              },
          success:function(response){
            if(response.status=="200")
            //alert($("#idproductos").html());
            //var f=$("#idproductos").parent().find("input").eq(3).val();
            $("#editModal").modal('toggle');
            $("#modal-lock").attr( 'class','modal-lock hidden');
            $('#productos-table').DataTable().ajax.reload(null, false);


          }
        });
      }
function borrar(id){
var route="productos/delete/"+id;
swal({
title: "Esta seguro.?",
text: "Se Eliminara el registro del producto y no podra recuperarlo!",
type: "error",
showCancelButton: true,
cancelButtonText: "Cancelar",
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true
},
function(){
$.get(route,function(response){
if(response.status="200"){

$('#productos-table').DataTable().ajax.reload(null, false);

}
else {
  swal("Ocurrio un error","error");

}

});

});


}
</script>


@endsection

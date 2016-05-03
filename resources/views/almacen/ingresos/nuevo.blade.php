@extends('layouts.master')

@section('content')


 <div class="row">
                <div class="col-md-12">
                  <section class="panel-default" style="margin-top:-2em">
                    <header class="panel-heading">
                    	<span style="margin-right:1em">ALMACEN / INGRESOS / NUEVO</span>
                    </header>

                    </section>
                </div>

  </div>

            <div class="row">
                <div class="col-md-12">
                      <div class="panel">
                        <header class="panel-heading">
                            Registrar Ingreso
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>

                             </span>
                        </header>
                        <div class="panel-body">
                            <form class="" method="post"  action="{{url('almacen/ingresos/create')}}"   id="form" name="form"  >


                                     <div class="col-md-3 ">
                                         <div class="form-group">
                                             <label for="">CONCEPTO</label>
                                            <select class="form-control" name="concepto">
                                              <option>COMPRA DE MERCADERIA</option>
                                              <option>TRASPASO DE ALMACEN</option>
                                              <option>REGULARIZACION DE INVENTARIO</option>
                                              <option>INVENTARIO INICIAL</option>
                                              <option>DEVOLUCION DE VENTA</option>

                                            </select>
                                         </div>
                                       </div>

                                       <div class="col-md-3 ">
                                           <div class="form-group">
                                               <label for="">DOCUMENTO</label>
                                              <select class="form-control" name="documento">
                                                <option>SIN DOCUMENTO</option>
                                                <option>FACTURA</option>
                                                <option>RECIBO</option>
                                                <option>COTIZACION</option>
                                                <option>OTROS</option>

                                              </select>
                                           </div>
                                         </div>

                                         <div class="col-md-2 col-lg-2 col-xs-6">
                                             <div class="form-group">
                                                 <label for="">NUM DOCUMENTO</label>
                                                <input type="text" class="form-control " name="numdocu" style="width:80%"/>
                                             </div>
                                           </div>
                                           <div class="col-md-2 col-lg-2 col-xs-6">
                                               <div class="form-group">
                                                 <div data-date-viewmode="day" data-date-format="dd-mm-yyyy" data-date=""   class="input-append date dpYears">
                                                    <label for="">FECHA</label>
                                                     <input type="text" readonly="" value="{{date('d-m-Y')}}" size="16" class="form-control"  name="fecha"id="fecha"/>
                                                                   <span class="input-group-btn add-on">
                                                                     <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                                                   </span>
                                                 </div>
                                               </div>
                                             </div>
                                             <div class="col-md-10">
                                                 <div class="form-group">
                                                     <label for="">OBSERVACION</label>
                                                    <textarea  rows="1" maxlength="150" type="text" class="form-control " name="obser" ></textarea>
                                                 </div>
                                               </div>



                        <div class="panel panel-default">

                        <div class="panel-body ">
                          <div class="col-lg-6 col-md-6 col-xs-6">
                              <div class="form-group">
                                  <label for="">PRODUCTO</label>
                                 <input type="text" class="form-control " name="producto" id="producto"/>
                              </div>
                            </div>
                            <div class=" col-lg-2 col-md-2 col-xs-6">
                                <div class="form-group">
                                  <input type="hidden"  name="" id="idprod"/>
                                    <input type="hidden" name="" id="codprod"/>
                                       <label for="">CANTIDAD</label>
                                   <input type="text" class="form-control " name="" id="cant"/>
                                   <span class="input-group-btn add-on">
                                     <button type="button"  id="btn-add" name="button" class="btn btn-success tooltips" data-original-title="Adicionar Fila" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-plus"></i></button>
                                   </span>
                                </div>
                            </div>



                                <div class="col-lg-8 col-md-10 col-xs-12">
                                <table class="table  table-condensed  " id="detalle">
                                    <thead >
                                      <tr class="alert alert-info " >
                                        <th  width="5%"> </th>
                                        <th  width="2%"> N° </th>
                                        <th width="15%"class="Numeric">Codigo</th>
                                        <th>Descripcion</th>
                                        <th class="Numeric" width="5%">Cantidad</th>

                                      </tr>
                                    </thead>
                                    <tbody id="campos">

                                    </tbody>
                                    <tfoot>
                              <tr>
                                <td></td>
                                <td ><strong>TOTAL</strong></td>
                                <td colspan="2"></td>
                                <td>  <input type="text" readonly="readonly"  class="form-control input-sm"  id="total" name="total" value="0"></td>

                              </tr>
                                    </tfoot>
                                  </table>
                                    </div>

                        </div>



                        <div class="panel col-lg-12 form-inline ">
                        <div class="panel-body">
                            <input type="hidden" name="numfilas" id="numfilas"/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token" />
                            <div class="form-group  ">
                        <button type="button" class="btn btn-success btn-lg"   onclick="enviarForm();" name="guardar" id="btn-guardar"> GUARDAR</button>
                       </div>
                        <div class="form-group  ">
                          <button type="button" class="btn btn-warning btn-lg"  id="btn-cancelar" name="cancelar">  CANCELAR</button>


                        </div>
                      </div>
                        </div>


                        </div>
                            </form>
                    </div>
                </div>
            </div>
@endsection
@section('script')
<script type="text/javascript">

var nextinput=0;
var msg="";
var cantTotal=0;
$(document).ready(function(){

  $("#codprod").val('')
  $("#fecha").datepicker({
      format:"dd-mm-yyyy",
      autoclose: true,

  });
  $("#producto").autocomplete({
         source: function (request, response) {
             $.ajax({

                 dataType:"json",
                 contentType:false,

                 url: "{{url('productos/autocompletar/')}}",
                 data: {
                     term: this.term
                 },
                 success: function (data) {
                   response( $.map( data, function( item ) {
                    return {    codbarras: item.codbarras,
                                descripcion: item.descripcion,
                                id:item.id

                                }
                }));
                    // response(data);
                 },
             });
         },
         minLength: 1,

         open: function () {
           $(this).addClass(".autocomplete-suggestions");
       },									/* le decimos que espere hasta que haya 2 caracteres escritos */
       select: 	function productoSeleccionado(event, ui)
		{
            $( "#producto" ).val( ui.item.descripcion );
     $( "#cant" ).focus();
     $( "#idprod" ).val( ui.item.id );
    $( "#codprod" ).val( ui.item.codbarras );

			return false;
				}
     }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
     return $( "<li>" )
     .data( "ui-autocomplete-item", item )
     .append( "<a><strong>" + item.codbarras + "-" + item.descripcion + "</a>" )
     .appendTo( ul );
     };

});

$("#btn-add").click(function(){
  if(validar()){
  addRow($("#idprod").val(),$("#codprod").val(),$("#producto").val(),$("#cant").val());
  $("#producto").val('');
  $("#cant").val('');
  $( "#producto" ).focus();
}
else {
  swal("ALERTA",msg,"warning");
}
});


$("#cant").bind('keypress', function(event)
{
if (event.keyCode == '13')
  {

    if(validar()){
    addRow($("#idprod").val(),$("#codprod").val(),$("#producto").val(),$("#cant").val());
    $("#producto").val('');
    $("#cant").val('');
    $( "#producto" ).focus();
  }
  else {
    swal("Alerta",msg,"warning");
  }
  }
  if (event.keyCode == '27')
    {  $("#producto").val('');
      $("#cant").val('');
      $( "#producto" ).focus();}
});


function validar(){
 var patron = /^\d*$/;
  if($("#codprod").val()==""){
  msg="No se Selecciono ningun producto.";
    return false;
}
  if($("#cant").val()==""){
    msg="El campo cantidad esta vacio.";
      return false;

  }
   if ( !patron .test($( "#cant" ).val())){
     msg="El campo cantidad no es un numero o no es un numero entero.";
       return false;

   }
   return true;
}


function addRow(id,codbarras,descripcion,cantidad) {
  nextinput++;
  row = '<tr ><td><button onclick="removeRow(this)" id="'+nextinput+'" type="button" name="button" class="btn btn-danger btn-xs tooltips" data-original-title="Eliminar Fila" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"></i></button>  </td><td>'+nextinput+'</td><td >'+codbarras+'</td><td>'+descripcion+'</td><td><input type="text" class="form-control input-sm" onchange="editarCantidad(this);"   value="'+cantidad+'" id="cantidad"  name="cantidad[]"  /><input type="hidden"  id="id' + nextinput + '"  name="id[]" value="'+id+'"  /></td></tr>';

$("#campos").append(row);

cantTotal+=parseFloat(cantidad);

 recalcularNota();

}


function removeRow(row){
 nextinput =nextinput -1;
$("#"+row.id).parent().parent().remove();
 if(nextinput==0){

   $("#total").val(0);

 }
 else{

   recalcularNota();

 }

   }


function editarCantidad(row){
 var patron = /^\d*$/;
 var cant=$("#"+row.id).parent().parent().find("input").eq(0).val();
  if ( !patron .test(cant)){
    $("#"+row.id).parent().parent().find("input").eq(0).val(0);
  }
  if(cant==""){
      $("#"+row.id).parent().parent().find("input").eq(0).val(0);
  }

  recalcularNota();
}



   function recalcularNota(){
         cantTotal=0;
         var cont=1;
        $('#campos tr').each(function () {
          $(this).find("td").eq(1).html(cont++);
        var cant=$(this).find("input").eq(0).val();
        cantTotal+=parseFloat(cant);
        });
         $("#total").val(cantTotal);
   }


function validarFormulario(){
  if(nextinput<=0){
   msg="No hay items para guardar";
   swal("ALERTA",msg,"warning");
   return false;
  }
  if($("#fecha").val()==""){
    msg="debe introducir una fecha";
    swal("ALERTA",msg,"warning");
    return false;
  }
  return true;

}
   function enviarForm(){


    if(validarFormulario()){

      swal({
      title: "Esta seguro.?",
      text: "Se guardara la nota de Ingreso!",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "No",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si",
      closeOnConfirm: true
      },
      function(){
              $("#numfilas").val(nextinput);

            $('#form').submit();

      });

    }


   }


</script>
@endsection

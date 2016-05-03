@extends('layouts.master')
@section('content')

<div class="row">
                <div class="col-md-12">
                  <section class="panel-default" style="margin-top:-2em">
                    <header class="panel-heading">
                      <span style="margin-right:1em">CATEGORIAS</span>

                              <a href="#myModal" data-toggle="modal" class="btn btn-success"> Nueva Categoria <i class="fa fa-plus"></i></a>
                               @include('categorias.nuevo')
                                 @include('categorias.edit')

                    </header>
                     <div class="panel-body col-md-9">
                <section id="unseen">

                    <table class="table table-bordered table-striped table-condensed" id="categorias-table">
                        <thead>
                        <tr>
                            <th class="numeric">ID</th>
                            <th >Descripcion</th>
                            <th class="numeric">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </section>
            </div>
                    </section>
                </div>

            </div>
@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function(){


            listarCategorias();
        });

function guardar(){

 var route="categorias/create";
 var descripcion=$("#descripcion").val();
 var token=$("#token").val();
 $.ajax({
 url:route,
 type:"POST",
 dataType:"json",
 headers:{"X-CSRF-TOKEN":token},
 data:{descripcion:descripcion},
 success:function(response){

  $("#myModal").modal('toggle');
  listarCategorias();
 }


 });
}

function actualizar(){
var id=$("#id").val();
var descripcion=$("#descripcion_edit").val();
var route="categorias/update/"+id;
var token=$("#token").val();
$.ajax({
url:route,
type:"POST",
dataType:"json",
headers:{"X-CSRF-TOKEN":token},
data:{id:id,descripcion:descripcion},
success:function(response){

 $("#editModal").modal('toggle');
  listarCategorias();

}


});

}
                       function listarCategorias(){

                          $("#categorias-table tbody").remove();

                          var  route="categorias/listar";
                          $.get(route,function(response){

                              filas="";
                              $(response).each(function(key,value){

                               filas+="<tr><td>"+value.id+"</td><td>"+value.descripcion+"</td><td>   <a href='#editModal' data-toggle='modal' class='btn  btn-warning btn-xs' id='"+value.id+"' onclick='abrirModalCategoria(this.id);'> <i class='fa fa-edit'></i>  EDITAR</a> <a class='btn  btn-danger btn-xs'><i class='fa fa-eraser'></i>  BORRAR</a></td></tr>";

                              });

                              $("#categorias-table").append(filas);


                          });
                      }

                        function abrirModalCategoria( id){

                          var route="categorias/edit/"+id;
                         $.get(route,function(response){

                              $("#descripcion_edit").val(response.descripcion);
                               $("#id").val(response.id);


                          });


                      }

</script>

 @endsection

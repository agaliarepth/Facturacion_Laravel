@extends('layouts.master')
@section('content')
<div class="row">
               <div class="col-md-12">
                 <section class="panel-default" style="margin-top:-2em">
                   <header class="panel-heading">
                     <span style="margin-right:1em">ALMACEN / INGRESOS</span>
                     <div class=" tools pull-right">
                       <a href="{{url('/almacen/ingresos/add/')}}" class="btn btn-success" type="button"><i class="fa fa-plus"></i> NUEVO INGRESO </a>
                       <button class="btn btn-primary" type="button"><i class="fa fa-cloud"></i> Cloud</button>
                       <button class="btn btn-info " type="button"><i class="fa fa-refresh"></i> Update</button>
                       <button class="btn btn-default " type="button"><i class="fa fa-cloud-upload"></i> Upload</button>

                     </div>
                   </header>

                    <div class="panel-body" >
                        <form class="form-inline">
                        <section class="col-md-12" style="background-color:#336699;">
                           <div class="form-group">
                               <select class="form-control" name="options" id="options">
                                   <option>unmes </option>

                               </select>
                           </div>
                        </section>
                            </form>
               <section id="unseen">
              <table  class="display table table-bordered table-striped" id="ingresos-table">
                                      <thead>
                       <tr>
                           <th>Num</th>
                           <th class="numeric">Fecha</th>
                           <th class="numerihc">Concepto</th>
                           <th class="numerihc">Documento</th>
                           <th class="numerihc">Num Documento</th>
                           <th class="numerihc">Opciones</th>

                       </tr>
                       </thead>
                       <tbody id="campos">


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
        $(document).ready(function(){

            function ruta(){
                return 'ingresos/listar';
            }
            var tablaIngresos=$('#ingresos-table').dataTable( {

                "ajax":{
                    "url":ruta(),
                },
                "bProcessing": true,

                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {

                    if ( aData['estado'] == "1" )
                    {


                     $('td:eq(5)', nRow).html( '<div class="btn-group"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button"><i class="fa fa-cogs"></i> Acciones<span class="caret"></span></button> <ul role="menu" class="dropdown-menu"> <li><a href="#">Action</a></li> <li><a href="#">Another action</a></li> <li><a href="#">Something else here</a></li> <li class="divider"></li> <li><a href="#">Separated link</a></li> </ul></div>');
                    }
                    if(aData['numdocu']==""){
                        $('td:eq(4)', nRow).html( 'S/D' );

                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "fecha" },
                    { "data": "concepto" },
                    { "data": "documento" },
                    { "data": "numdocu" },
                    {"data":"",

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

    </script>
@endsection

@extends('layouts.master')
@section('contend')
<div class="row">
               <div class="col-md-12">
                 <section class="panel-default" style="margin-top:-2em">
                   <header class="panel-heading">
                     <span style="margin-right:1em">ALMACEN</span>

                             <a href="#myModal" data-toggle="modal" class="btn btn-success"> Nuevo Producto <i class="fa fa-plus"></i></a>


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
@endsection

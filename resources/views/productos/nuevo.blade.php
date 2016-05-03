 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">



                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                             <div class="modal-header">
                                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    <h4 class="modal-title">Registrar Nuevo Producto</h4>
                                                </div>
  <form role="form"  id="form" name="form" enctype="multipart/form-data">
             <section class="panel">
                    <div class="panel-body">
                         <div  id="modal-lock" class="modal-lock hidden"  >
                              <div class="loader-box" >

                              <img   src="{{url('/public/images/ajax-loader.gif')}}">
                              <p style="color:#000">Procesando formulario....</p>
                              </div>
                         </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Codigo</label>
                                  <input type="text" class="form-control" name="codbarras" id="codbarras" placeholder="Codigo Barras">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="" >Descripcion</address></label>
                                <input type="text" class="form-control" name="descripcion"  required id="descripcion" placeholder="Descripcion del producto">
                              </div>
                              </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Precio Venta (Bs)</label>
                                  <input type="number" class="form-control"  name="pu" id="pu" placeholder="" value="0">
                              </div>
                            </div>

                             <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Unidad</label>
                                  <select class="form-control" name="unidad" id="unidad">
                                  <option value="unid">unid</option>
                                  <option value="caja">caja</option>
                                  <option value="kg">kg</option>
                                  <option value="gr">gr</option>
                                  <option value="lt">lt</option>
                                  <option value="ml">ml</option>
                                  </select>
                              </div>
                            </div>




                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Categoria" >Seleccione Categoria</label>
                                <select class="form-control" id="categorias_id" name="categorias_id">
                                 <option value="SC">SIN CATEGORIA</option>
                                @foreach($categorias as $r){
                                 <option value="{{$r->id}}">{{$r->descripcion}}</option>


                                }@endforeach

                                </select>

                            </div>

                        </div>

                             <div class="form-group last">
                                    <label class="control-label col-md-3">Imagen</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                              <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Buscar Imagen</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                                   <input type="file" name="foto" id="foto"  class="default"   />
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Borrar</a>
                                               </div>
                                            </div>

                                         </div>
                                    </div>
                              </div>

                    </section>

                                                <div class="modal-footer">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token" />
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                                                    <button type="button" class="btn btn-success" onclick="create();"> <i class=" fa fa-floppy-o"></i> Guardar</button>
                                                </div>
                        </form>
                            </div>


                            <!--ALERTS-->

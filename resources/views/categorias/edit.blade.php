 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    <h4 class="modal-title">Editar Categoria</h4>
                                                </div>
  <form role="form"  action="#" method="post">
             <section class="panel">
                    <div class="panel-body">
                      
                          
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="" >Descripcion</address></label>
                                <input type="text" class="form-control" id="descripcion_edit" required name="descripcion_edit" placeholder="Descripcion categoria">
                              </div>
                            </div>
                            
                           </div>
                    </section>
                                </form>                 
                                                <div class="modal-footer">
                                                    <input type="hidden" name='_token' value='{{csrf_token()}}' id="token">
                                                    <input type="hidden" name='id' value='' id="id">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                                                    <button type="button" class="btn btn-success" onclick="actualizar();"> <i class=" fa fa-floppy-o"></i> Guardar</button>
                                                </div>
                       
                            </div> 
                            </div>
                            </div>                   



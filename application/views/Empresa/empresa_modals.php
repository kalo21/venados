 <!--modals -->
<div class="modal fade" id="mdlAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header" style="background-color:#f6032f; color:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title">Agregar</h2>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal" id="frmAgregarEmpresa">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpNombreEmpresa"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Razon Social</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpRazonSocial"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">RFC</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpRFC"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Domicilio</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpDomicilioEmpresa"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Telefono</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpTelefonoEmpresa"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Local</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpLocal"></div> 
                </div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
				    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
				        <img src="<?= base_url();?>assets/images/logo.jpg" alt="..." id="imagen">
				    </div>
				    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px">
				    </div>
				    <div>
				        <span class="btn btn-white btn-file">
				            <span class="fileinput-new">Selecionar imagen</span>
				            <span class="fileinput-exists">Cambiar</span>
				            <input type="file" id="foto" name="foto" accept="image/*">
				        </span>
				        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remover</a>
				    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer bg-gray">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-rojo">Registrar</button>
            </div>
        </div>
    </div>    
</div>

<div class="modal fade" id="mdlModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f6032f; color:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title">Modificar</h2>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal" id="frmModificarEmpresa">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpNombreEmpresa"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Razon Social</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpRazonSocial"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">RFC</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpRFC"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Domicilio</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpDomicilioEmpresa"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Telefono</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpTelefonoEmpresa"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Local</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpLocal"></div> 
                </div>
                <div class="custom-file">
                    <label class="col-sm-3 control-label">Logo</label>
                    <input type="file" class="custom-file-input" id="inpLogo" required>                        
                </div>
            </form>
            </div>
            <div class="modal-footer bg-gray">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-rojo">Cambiar</button>
            </div>
        </div>
    </div>    
</div>

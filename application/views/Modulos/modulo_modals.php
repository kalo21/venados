 <!--modals -->
 <div class="modal fade " id="mdlAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f6032f; color:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" >Agregar</h2>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal" id="frmAgregarModulo">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpNombreModulo"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpDescrpcionModulo"></div> 
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Ruta</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="inpRutaModulo"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">icono</label>
                    <input type="file" class="custom-file-input" id="inpIconoModulo" required>     
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
 <!--modals -->
 <div class="modal fade " id="mdlAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f6032f; color:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="exampleModalLabel">Agregar</h2>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="nombreModulo" name="inpNombre"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="descrpcionModulo" name="inpDescripcion"></div> 
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">Ruta</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="rutaModulo" name="inpRuta"></div> 
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">Icono</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="iconoModulo" name="inpIcono"></div> 
                </div>
            </form>
            </div>
            <div class="modal-footer bg-gray">
                <button id="btnCerrar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-rojo" id="btnRegistrar">Registrar</button>
            </div>
        </div>
    </div>    
</div>
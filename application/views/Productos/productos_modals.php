
<!--modals -->
<div class="modal fade " id="mdlAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f6032f; color:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="exampleModalLabel">Nuevo Producto</h2>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="NombreProducto"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="Descripcion"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Precio</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="Precio"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Empresa</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="Empresa">
                            <option>Pacifico</option>
                            <option>New york</option>
                            <option>Salchichas</option>
                        </select>
                    </div> 
                </div>
                <div class="custom-file">
                    <label class="col-sm-3 control-label">Imagen</label>
                    <input type="file" class="custom-file-input" id="Imagen" required>      
                </div>
            </form>
            </div>
            <div class="modal-footer bg-gray">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                <h3 class="modal-title" id="exampleModalLabel"><strong>Modificar Producto</strong></h3>
            </div>
            <div class="modal-body" style="background-color:#ecf0f5">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="NombreProducto"></div>        
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="Descripcion"></div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Precio</label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="Precio"></div> 
                </div>
                <div class="custom-file">
                    <label class="col-sm-3 control-label">Imagen</label>
                    <input type="file" class="custom-file-input" id="Imagen" required>      
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


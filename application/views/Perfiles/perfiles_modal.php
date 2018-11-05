<div id="error" hidden class="alert alert-warning">
    
</div>
<form class="form-horizontal" id="frmAgregarPerfil">
    <div class="form-group">
        <label class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
            <input type="text" data-id ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control Letras" id="inpNombre" name="inpNombre">
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-9">
            <input type="text" data-descripcion ="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" value ="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" class="form-control Letras" id="inpDescripcion" name="inpDescripcion">
        </div> 
    </div>
</form>
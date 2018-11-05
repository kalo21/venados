<div id="error" hidden class="alert alert-warning">
    
</div>
<form class="form-horizontal" id="frmEmpresa">
    <div class="form-group">
        <label class="col-sm-3 control-label">Empresa</label>
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
        <div>
                <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Usuario</label>
            <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control" id="inpNombre" name="inpNombre"></div>        
        </div>
        <div class="form-group" <?php echo(isset($datos->contraseña)) ? 'hidden' : '' ;?>>
            <label class="col-sm-3 control-label">Contraseña</label>
            <div class="col-sm-9"><input type="password" value ="<?php echo(isset($datos->contraseña)) ? $datos->contraseña : '' ;?>" class="form-control" id="inpContrasena" name="inpContrasena"></div> 
        </div>
        <div class="form-group" <?php echo(isset($datos->contraseña)) ? 'hidden' : '' ;?>>
            <label class="col-sm-3 control-label">Verificar Contraseña</label>
            <div class="col-sm-9"><input type="password" value ="<?php echo(isset($datos->contraseña)) ? $datos->contraseña : '' ;?>" class="form-control" id="inpVerificar" name="inpVerificar"></div> 
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Correo</label>
            <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->correo)) ? $datos->correo : '' ;?>" class="form-control" id="inpCorreo" name="inpCorreo"></div> 
        </div>
    </div>
</form>
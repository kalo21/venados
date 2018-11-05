<div id="error" hidden class="alert alert-warning">
    
</div>
<form class="form-horizontal" id="frmEmpresa">
    <div class="form-group">
        <label class="col-sm-3 control-label">Empresa</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control Letras" id="inpNombreEmpresa" name="inpNombreEmpresa"></div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Razón Social</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->razonsocial)) ? $datos->razonsocial : '' ;?>" class="form-control Letras" id="inpRazonSocial" name="inpRazonSocial"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">RFC</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->rfc)) ? $datos->rfc : '' ;?>" class="form-control LetrasNumeros" id="inpRFC" name="inpRFC"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Domicilio</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->domicilio)) ? $datos->domicilio : '' ;?>" class="form-control" id="inpDomicilioEmpresa" name="inpDomicilioEmpresa"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Teléfono</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->telefono)) ? $datos->telefono : '' ;?>" class="form-control Numeros" id="inpTelefonoEmpresa" name="inpTelefonoEmpresa"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Local</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($datos->local)) ? $datos->local : '' ;?>" class="form-control" id="inpLocal" name="inpLocal"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Logotipo</label>
        <div class="col-sm-9"><input type="file" id="inpFile" name="inpFile"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Usuario</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($usuario->nombre)) ? $usuario->nombre : '' ;?>" class="form-control" id="inpNombre" name="inpNombre"></div>        
    </div>
    <div class="form-group" <?php echo(isset($datos->contraseña)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Contraseña</label>
        <div class="col-sm-9"><input type="password" value ="<?php echo(isset($usuario->contraseña)) ? $usuario->contraseña : '' ;?>" class="form-control" id="inpContrasena" name="inpContrasena"></div> 
    </div>
    <div class="form-group" <?php echo(isset($datos->contraseña)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Verificar Contraseña</label>
        <div class="col-sm-9"><input type="password" value ="<?php echo(isset($usuario->contraseña)) ? $usuario->contraseña : '' ;?>" class="form-control" id="inpVerificar" name="inpVerificar"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Correo</label>
        <div class="col-sm-9"><input type="text" value ="<?php echo(isset($usuario->correo)) ? $usuario->correo : '' ;?>" class="form-control" id="inpCorreo" name="inpCorreo"></div> 
    </div>
    </div>
</form>
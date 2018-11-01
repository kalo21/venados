<div id="error" hidden class="alert alert-warning">
    
</div>
<form class="form-horizontal" id="frmUsuarios">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-8"><input type="text" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control" id="inpNombre" name="inpNombre"></div>        
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Contraseña</label>
        <div class="col-sm-8"><input type="password" value ="<?php echo(isset($datos->contraseña)) ? $datos->contraseña : '' ;?>" class="form-control" id="inpContrasena" name="inpContrasena"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Verificar Contraseña</label>
        <div class="col-sm-8"><input type="password" value ="<?php echo(isset($datos->contraseña)) ? $datos->contraseña : '' ;?>" class="form-control" id="inpVerificar" name="inpVerificar"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Correo</label>
        <div class="col-sm-8"><input type="text" value ="<?php echo(isset($datos->correo)) ? $datos->correo : '' ;?>" class="form-control" id="inpCorreo" name="inpCorreo"></div> 
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Perfil</label>
        <div class="col-sm-8">
            <select name="inpPerfil" id="inpPerfil" class="form-control">
                <option value="<?php echo(isset($datos->idperfil)) ? $datos->idperfil : '' ;?>"><?php echo(isset($datos->idperfil)) ? $datos->idperfil : '' ;?></option>
            <?php
                foreach($perfiles as $perfil) {
            ?>
                    <option value="<?php echo $perfil->id;?>"><?php echo $perfil->nombre;?></option>
            <?php
                }
            ?>
            </select>
        </div>

    </div>
    </form>
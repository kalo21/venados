<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-tagsinput.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/tag-chilo.css'); ?>">
<div id="error" hidden class="alert alert-warning">
    
</div>

<form class="form-horizontal" id="frmEmpresa">
   <div class="form-group text-center" id="divImagen">
        <label for="foto" id="labelImg">  <img style="height: 250px; width:250px;" src="<?= (isset($datos->logotipo)) ? base_url($datos->logotipo) : base_url('assets/images/empresa.png')?>" class="img-circles img-responsive text-center" alt="imagen_producto"> </label>
        <input class="form-control" name="foto" type="file" id="foto" style="display: none" accept="image/*">
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Empresa</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" data-nombre="<?php echo(isset($datos->nombre)) ? $datos->nombre : '';?>" class="form-control Letras" id="inpNombreE" name="inpNombreE">
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" data-descripcion="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" class="form-control Letras" id="inpDescripcion" data-role="tagsinput" name="inpDescripcion">
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Razón Social</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->razonsocial)) ? $datos->razonsocial : '' ;?>" data-razonsocial="<?php echo(isset($datos->razonsocial)) ? $datos->razonsocial : '' ;?>" class="form-control Letras" id="inpRazonSocial" name="inpRazonSocial">
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">RFC</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->rfc)) ? $datos->rfc : '' ;?>" data-rfc="<?php echo(isset($datos->rfc)) ? $datos->rfc : '' ;?>" class="form-control LetrasNumeros" id="inpRFC" name="inpRFC">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Domicilio</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->domicilio)) ? $datos->domicilio : '' ;?>" data-domicilio="<?php echo(isset($datos->domicilio)) ? $datos->domicilio : '' ;?>" class="form-control" id="inpDomicilio" name="inpDomicilio">
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Teléfono</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->telefono)) ? $datos->telefono : '' ;?>" data-telefono="<?php echo(isset($datos->telefono)) ? $datos->telefono : '' ;?>" class="form-control Numeros" id="inpTelefono" name="inpTelefono">
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Local</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($datos->local)) ? $datos->local : '' ;?>" data-local="<?php echo(isset($datos->local)) ? $datos->local : '' ;?>" class="form-control" id="inpLocal" name="inpLocal">
        </div> 
    </div>
    
<!-------------------------------------------------------------------------------------------------------------->  
     
    <div class="form-group" <?php echo(isset($usuario->nombre)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Usuario</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($usuario->nombre)) ? $usuario->nombre : '' ;?>" class="form-control" id="inpNombre" name="inpNombre">
        </div>        
    </div>
    <div class="form-group" <?php echo(isset($usuario->contraseña)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Contraseña</label>
        <div class="col-sm-9">
            <input type="password" value ="<?php echo(isset($usuario->contraseña)) ? $usuario->contraseña : '' ;?>" class="form-control" id="inpContrasena" name="inpContrasena">
        </div> 
    </div>
    <div class="form-group" <?php echo(isset($usuario->contraseña)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Verificar Contraseña</label>
        <div class="col-sm-9">
            <input type="password" value ="<?php echo(isset($usuario->contraseña)) ? $usuario->contraseña : '' ;?>" class="form-control" id="inpVerificar" name="inpVerificar">
        </div> 
    </div>
    <div class="form-group" <?php echo(isset($usuario->correo)) ? 'hidden' : '' ;?>>
        <label class="col-sm-3 control-label">Correo</label>
        <div class="col-sm-9">
            <input type="text" value ="<?php echo(isset($usuario->correo)) ? $usuario->correo : '' ;?>" class="form-control" id="inpCorreo" name="inpCorreo">
        </div> 
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-tagsinput.min.js'); ?>"></script>

<!----------------------------------------------------------------------------------------------------------------->

<script>
//Funcion que espera un cambio en el input para la foto principal de cada servicio
$("#divImagen").delegate("#foto","change", function(){
    previewImagen(this);
});
//Esta funcion solo crea un img nuevo para la foto principal, quitando la que estaba y añadiendo una nueva.
function previewImagen(input){
    if(input.files && input.files[0]){
        var x="";
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function(e){
            //$('#formServicio + img').remove();
            x+='<label for="foto"> <img style="height: 250px;" src="'+e.target.result+'" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>';
            $('#labelImg').html("");
            $('#labelImg').html(x);
        }                
    }
    
    $('#inpDescripcion').tagsinput({
        splitOn:'-'
    })
}
</script>
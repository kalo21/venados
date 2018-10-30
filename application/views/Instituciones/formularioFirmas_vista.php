<style>
    input[type="text"]{text-transform:uppercase;}
</style>
<div class="alert alert-danger" id="msg-error" style="text-align:left;">
    <strong>¡Importante!</strong> Corregir los siguientes errores.
    <div class="list-errors">
      
    </div>
</div>
<form role="form" id="formulario" autocomplete="off">
	<div class="container-fluid">
		<div class="row-fluid">
        	<div class="form-group col-md-6">
              <label for="txtnombre" class="control-label">Nombre</label>
                <input data-info="<?php echo(isset($info[0]->nombre)) ? $info[0]->nombre : '' ?>"  data-id="<?php echo(isset($info[0]->id)) ? $info[0]->id : '' ?>" value="<?php echo(isset($info[0]->nombre)) ? $info[0]->nombre : '' ?>" type="text" class="form-control Letras" id="txtnombre" name="txtnombre" placeholder="Nombre">
            </div>

            <div class="form-group col-md-6">
              <label for="txtapellidopaterno" class="control-label">Apellido Paterno</label>
                <input data-info="<?php echo(isset($info[0]->apellido_paterno)) ? $info[0]->apellido_paterno : '' ?>" value="<?php echo(isset($info[0]->apellido_paterno)) ? $info[0]->apellido_paterno : '' ?>" type="text" class="form-control Letras" id="txtapellidopaterno" name="txtapellidopaterno" placeholder="Apellido paterno">
            </div>
        </div>

        <div class="row-fluid">
        	<div class="form-group col-md-6">
              <label for="txtapellidomaterno" class="control-label">Apellido Materno</label>
                <input type="text" data-info="<?php echo(isset($info[0]->apellido_materno)) ? $info[0]->apellido_materno : '' ?>" value="<?php echo(isset($info[0]->apellido_materno)) ? $info[0]->apellido_materno : '' ?>" class="form-control Letras" id="txtapellidomaterno" name="txtapellidomaterno" placeholder="Apellido materno">
            </div>

            <div class="form-group col-md-6">
              <label for="txtcurp" class="control-label">CURP</label>
                <input type="text" autocomplete="ÑÖcompletes" data-info="<?php echo(isset($info[0]->curp)) ? $info[0]->curp : '' ?>" value="<?php echo(isset($info[0]->curp)) ? $info[0]->curp : '' ?>" class="form-control LetrasNumeros" id="txtcurp" name="txtcurp" placeholder="CURP">
            </div>
        </div>

         <div class="row-fluid">
        	<div class="form-group col-md-6">
              <label for="txtcargo" class="control-label">Cargo</label>
                <select name="txtcargo" class="form-control" id="txtcargo">
                    <option value="">SELECCIONE UNA OPCIÓN</option>
                    <?php
                    	foreach($cargos as $cargo){
                    		echo '<option value="'.$cargo->id.'">'.$cargo->cargo_firmante.'</option>';
                    	}
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
              <label for="txtgrado" class="control-label">Abreviatura para Título o Grado de Estudio</label>
                <select name="txtgrado" class="form-control" id="txtgrado">
                    <option value="">SELECCIONE UNA OPCIÓN</option>
                    <?php
                    	foreach($gradoEstudio as $estudios){
                    		echo '<option value="'.$estudios->id.'">'.$estudios->abreviatura.'</option>';
                    	}
                    ?>
                </select>
            </div>

           
        </div>

         <div class="row-fluid">
         	<div class="form-group col-md-6">
              <label for="txtcer" class="control-label">Llave pública (Archivo .CER)</label>
                <input type="file" accept=".cer" class="form-control BSbtndanger" id="txtcer" name="txtcer" placeholder="CURP">
            </div>
            <div class="form-group col-md-6">
              <label for="txtkey" class="control-label">Llave pública (Archivo .KEY)</label>
                <!--<input type="file" accept=".key" class="form-control" id="txtkey" name="txtkey" placeholder="CURP">-->
                <!--<label>Bootstrap style button 1</label>-->
                <input type="file" type="file" accept=".key" class="form-control BSbtndanger" id="txtkey" name="txtkey" >
            </div>
            
        </div>
         <div class="row-fluid">
           <div class="form-group col-md-6">
           	<input type="text" style="opacity: 0;position: absolute;">
              <label for="txtcontraseña" class="control-label">Contraseña</label>
                <input type="password" autocomplete="ÑÖcompletes" class="form-control" id="txtcontraseña" name="txtcontraseña" placeholder="CONTRASEÑA">
            </div>
            <div class="form-group col-md-6">
             <!-- <label for="txtnoCertificado" class="control-label">No. Certificado</label>
                <input type="text" class="form-control" id="txtnoCertificado" name="noCertificadoResponsable" placeholder="Numero del certificado">-->
            </div>
        </div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validaciones.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $("#msg-error").hide();
    var idcargo = "<?php echo(isset($info[0]->id_cargo)) ? $info[0]->id_cargo : '' ?>";
    var idgrado = "<?php echo(isset($info[0]->id_grado_estudio)) ? $info[0]->id_grado_estudio : '' ?>";
    $('.BSbtndanger').filestyle({
 
    buttonName : 'btn-primary',
     
    buttonText : ' Seleccione un archivo'
     
    });
     
    $('#txtcargo').val(idcargo);
    $('#txtgrado').val(idgrado);


	});

</script>
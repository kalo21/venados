<div class="alert alert-danger" id="msg-error" style="text-align:left;">
    <strong>¡Importante!</strong> Corregir los siguientes errores.
    <div class="list-errors">
    	
</div>
</div>
<form role="form" id="formulario" autocomplete="off">
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-12">
				<label for="txtnombre" class="control-label">Nombre</label>
				<input  name="txtnombre" data-info="<?php echo(isset($carreras[0]->descripcion)) ? $carreras[0]->descripcion : '' ?>"  data-id="<?php echo(isset($carreras[0]->id)) ? $carreras[0]->id : '' ?>" value="<?php echo(isset($carreras[0]->descripcion)) ? $carreras[0]->descripcion : '' ?>" class="form-control LetrasNumeros" id="txtnombre" placeholder="Ingrese el nombre">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label class="control-label" for="txtabreviatura">Abreviatura</label>
				<input name="txtabreviatura" data-info="<?php echo(isset($carreras[0]->abreviatura)) ? $carreras[0]->abreviatura : '' ?>" value="<?php echo(isset($carreras[0]->abreviatura)) ? $carreras[0]->abreviatura : '' ?>" class="form-control LetrasNumeros" id="txtabreviatura" placeholder="Escriba la abreviatura de la carrera">
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validaciones.js"></script>
<script type="text/javascript">
	$("#msg-error").hide();
	
</script>

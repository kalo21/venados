<div class="alert alert-danger" id="msg-error" style="text-align:left;">
    <strong>¡Importante!</strong> Corregir los siguientes errores.
    <div class="list-errors">
    	
</div>
</div>
<form role="form" id="formulario" autocomplete="off">
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-12">
				<label for="txtnombre" class="control-label">Nombre de la categoria</label>
				<input  name="txtnombre" data-info="<?php echo(isset($categoria[0]->descripcion)) ? $categoria[0]->descripcion : '' ?>"  data-id="<?php echo(isset($categoria[0]->id)) ? $categoria[0]->id : '' ?>" value="<?php echo(isset($categoria[0]->descripcion)) ? $categoria[0]->descripcion : '' ?>" class="form-control LetrasNumeros" id="txtnombre" placeholder="Ingrese el nombre">
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validaciones.js"></script>
<script type="text/javascript">
	$("#msg-error").hide();
	
</script>

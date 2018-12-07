<div id="error" hidden class="alert alert-warning">

</div>
<form class="form-horizontal" id="formulario" enctype="multipart/form-data">
	<div class="form-group">
        <label class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
            <input type="text" data-nombre = "<?php echo(isset($datos->nombre)) ? $datos->nombre : '';?>" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control LetrasNumeros" id="inpNombre" name="inpNombre">
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-9">
            <input type="text" data-descripcion = "<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '';?>" value ="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" class="form-control LetrasNumeros" id="inpDescripcion" name="inpDescripcion">
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Fecha del evento</label>
        <div class="col-sm-9">
            <input type="text" data-fechaInicial = "<?php echo(isset($datos->fecha_inicial)) ? $datos->fecha_inicial : '';?>" value ="<?php echo(isset($datos->fecha_inicial)) ? $datos->fecha_inicial : '' ;?>" class="form-control LetrasNumeros" id="inpInicioD" name="inpInicioD">
        </div>        
    </div>
	<div class="custom-file">
	    <div class="form-group text-center" id="divImagen">
	        <label for="foto" id="labelImg">  <img style="height: 150px;" src="<?php echo (isset($datos->imagen)) ? base_url('assets/images/eventos/'.$datos->imagen) : base_url('assets/images/productos.png')?>" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>
	        <input class="form-control" type="file" name="inpFoto" id="foto" style="display: none" accept="image/*">
	    </div> 
    </div>
</form>

<script>

    $(document).ready(function() {

        cambio = 0;


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
                    x+='<label for="foto"> <img style="height: 150px;" src="'+e.target.result+'" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>';
                    $('#labelImg').html("");
                    $('#labelImg').html(x);
                }                
            }
        }

        $('#inpInicioD').daterangepicker({
            "timePicker": true,
            "timePickerSeconds": true,
            "applyClass": "btn-rojo",
            "locale": {
                "format": "DD/MM/YYYY hh:mm:ss",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Do",
                    "Lu",
                    "Ma",
                    "Mi",
                    "Ju",
                    "Vi",
                    "Sa"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "firstDay": 1
            },
            "autoUpdateInput": false,
            "applyButtonClasses": "btn-danger"
            
        });

        

        $('#inpInicioD').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm:ss') + ' - ' + picker.endDate.format('MM/DD/YYYY hh:mm:ss'));
        });

        $('#inpInicioD').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#inpInicioD').on('apply.daterangepicker', function(ev, picker) {
            fechaInicio = picker.startDate.format('YYYY-MM-DD hh:mm:ss');
            fechaFinal= picker.endDate.format('YYYY-MM-DD hh:mm:ss');
        });

        $('#foto').change(function() {
            cambio++;
        });

    });


</script>
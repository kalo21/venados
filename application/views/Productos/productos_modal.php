<div id="error" hidden class="alert alert-warning">
    
</div>
<form class="form-horizontal" id="frmAgregarProducto">
    <div class="form-group">
        <label class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
            <input type="text" data-nombre = "<?php echo(isset($datos->nombre)) ? $datos->nombre : '';?>" value ="<?php echo(isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control" id="inpNombre" name="inpNombre">
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-9">
            <input type="text" data-descripcion = "<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '';?>" value ="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" class="form-control" id="inpDescripcion" name="inpDescripcion">
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Precio</label>
        <div class="col-sm-9">
            <input type="text" data-precio = "<?php echo(isset($datos->precio)) ? $datos->precio : '';?>" value ="<?php echo(isset($datos->precio)) ? $datos->precio : '' ;?>" class="form-control" id="inpPrecio" name="inpPrecio">
        </div> 
    </div>
    <div class="custom-file">
    <div class="form-group text-center" id="divImagen">
        <label for="foto">  <img style="height: 150px;" src="<?php echo base_url('assets/img/no-imagen.jpg')?>" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>
        <input class="form-control" type="file" id="foto" style="display: none" accept="image/*">
    </div> 
    </div>
</form>


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
            x+='<label for="foto"> <img style="height: 150px;" src="'+e.target.result+'" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>';
            x+='<input class="form-control" type="file" name= "foto" id="foto" style="display: none" accept="image/*">';
            $('#divImagen').html("");
            $('#divImagen').html(x);
        }                
    }
}
</script>
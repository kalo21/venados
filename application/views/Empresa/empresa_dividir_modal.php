<form id="frmEmpresaImagen">
    <div class="row">
        <div>
            <h4 class=" col-md-6 text-center"><b>logo<b></h4>
            <h4 class=" col-md-6 text-center"><b>fondo<b></h4>
        </div>
    </div>
    <div class="row">
        <div class=" col-md-6 text-center">
            <div id="divImagen">
                <label for="foto" id="labelImg">  <img style="height: 200px; " src="<?= (isset($datos->logotipo)) ? base_url($datos->logotipo) : base_url('assets/images/empresa.png')?>" class="img-circles img-responsive text-center" alt="imagen_producto"> </label>
                <input class="form-control" name="foto" type="file" id="foto" style="display: none" accept="image/*">
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div id="divImagenV"> 
                <label for="fotoV" id="labelImgV">  <img style="height: 200px;" src="<?= (isset($datos->img_fondo)) ? base_url($datos->img_fondo) : base_url('assets/images/empresa.png')?>" class="img-circles img-responsive text-center" alt="imagen_producto"> </label>
                <input class="form-control" name="fotoV" type="file" id="fotoV" style="display: none" accept="image/*">
            </div>
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
                x+='<label for="foto"> <img style="height: 200px;" src="'+e.target.result+'" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>';
                $('#labelImg').html("");
                $('#labelImg').html(x);
            }                
        }
    }

    $("#divImagenV").delegate("#fotoV","change", function(){
        previewImagenV(this);
    });
    //Esta funcion solo crea un img nuevo para la foto principal, quitando la que estaba y añadiendo una nueva.
    function previewImagenV(input){
        if(input.files && input.files[0]){
            var x="";
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e){
                //$('#formServicio + img').remove();
                x+='<label for="fotoV"> <img style="height: 200px;" src="'+e.target.result+'" class="img-thumbnail img-responsive text-center" alt="imagen_producto"> </label>';
                $('#labelImgV').html("");
                $('#labelImgV').html(x);
            }                
        }
    }
</script>
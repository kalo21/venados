<style>
.thumbnail {
    position: relative;
}
</style>
<div class="row-fluid">
    <div class="col-xs-12 text-center">
        <h3><strong><?php echo $datos[0]->nombre;?></strong></h3>
    </div>
    <div class="col-md-12">
        <img src="<?php echo base_url().$datos[0]->imagen;?>" alt="" class="img-responsive" style="max-width:312px; max-height:175px; margin:auto">
    </div>
    <div class="col-xs-12 text-right">
        <h3 class="text-success">$ <?php echo $datos[0]->precio;?></h3>
    </div>
    <div class="col-xs-12 text-left text-justify">
        <p  style="font-size: 18px"><?php echo $datos[0]->descripcion;?></p>
    </div>
</div>
<div class="row" style="margin: 0 0 10px">
    <div class="col-xs-6 text-left">
        <h4><strong>Total: $<span id="total"><?php echo $datos[0]->precio;?></span></strong></h4>
    </div>
    <div class="col-xs-6 text-right">
        <p style="font-size:20px"><span id="minus" class="fa fa-minus-circle" style="color:#f6032f"></span>  <span id="cantidad">1</span>  <span id="plus" class="fa fa-plus-circle" style="color:green"></span></p>
    </div>
</div>

<script>
    $(document).ready(function() {

        precio = parseInt($('#total').text());

        $('#minus').click(function() {
            var cant = parseInt($('#cantidad').text());
            if(cant > 1) {
                cant--;
            }
            $('#total').text(precio*cant);
            $('#cantidad').text(cant);
        })

        $('#plus').click(function() {
            var cant = parseInt($('#cantidad').text());
            cant++;
            $('#total').text((precio*cant).toFixed(2));
            $('#cantidad').text(cant);
        })  

    });
</script>
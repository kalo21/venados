<?php
    foreach($datos as $dato) {

?>
<div class="row">
    <p class="col-xs-2 col-xs-offset-1">· <?php echo $dato->cantidad;?></p>
    <p class="col-xs-6"><?php echo $dato->productoNombre;?></p>
    <p class="col-xs-3"><?php echo $dato->precio;?></p>
</div>
<?php
    }
?>
<div class="row">
    <b class="col-xs-2 col-xs-offset-7">Total:</b>
    <b class="col-xs-3">$ <?php echo $datos[0]->total;?></b>
</div>
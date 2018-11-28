<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-tagsinput.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/tag-chilo.css'); ?>">
<fieldset disabled>
    <div class="container-fluid">
        <div class="row-fluid" style="display:flex; justify-content: center">
            <img style="max-height: 200px;" src="<?= (isset($datos->logotipo)) ? base_url($datos->logotipo) : base_url('assets/images/empresa.png')?>" class="img-circles img-responsive">
        </div>
    </div>
    <div class="container">&nbsp</div>
    <form class="form-horizontal" id="frmVer">
        <div class="form-group">
            <label class="col-sm-3 control-label">Descripcion</label>
            <div class="col-sm-9">
                <input type="text" value ="<?= (isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" data-descripcion="<?php echo(isset($datos->descripcion)) ? $datos->descripcion : '' ;?>" class="form-control Letras" id="inpDescripcion" name="inpDescripcion">
                <!-- data-role="tagsinput" -->
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
    </form>
</fieldset>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-tagsinput.min.js'); ?>"></script>
<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="box col-md-4 col-md-offset-4">
            <div class="container">&nbsp</div>
            <div class="container-fluid">
                <div class="row-fluid text-center">
                    <img style="height: 150px; width:150px;" src="<?=(isset($datos->imagen)) ? base_url($datos->imagen) : base_url('assets/images/user.png')?>" class="rounded mx-auto d-block">
                    <h3>ID : <b><?= (isset($datos->id)) ? $datos->id : '' ;?></b></h3>
                </div>
            </div>
            <form class="form-horizontal">
                <fieldset disabled>
                    <div class="row-fluid">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->nombre)) ? $datos->nombre : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Apellido</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->apellido)) ? $datos->apellido : '' ;?>"class="form-control Letras" >
                            </div>        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Saldo</label>
                            <div class="col-sm-9">
                                <input type="text" value ="$<?= (isset($datos->saldo)) ? $datos->saldo : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Correo</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->correo)) ? $datos->correo : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->usuario)) ? $datos->usuario : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('Global/footer')?>
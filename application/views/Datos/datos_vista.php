<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="box col-md-4 col-md-offset-4">
            <div class="container">&nbsp</div>
            <div class="container-fluid">
                <div class="row-fluid text-center">
                    <img style="height: 150px; width:150px;" src="<?=(isset($datos->imagen)) ? base_url($datos->imagen) : base_url('assets/images/user.png')?>" class="rounded mx-auto d-block">
                    <?php
                        if($this->session->idPerfil != 2) {
                            echo '<h3>ID : <b>' .$datos->id. '</b></h3>';
                        }
                        else if($datos->disponibilidad == 'Abierto'){
                            echo '<button id="disponibilidad" data-disp="Abierto" type="button" class="col-md-12 btn btn-success" style="margin-top: 10px; margin-bottom: 10px">Activo</button>';
                        } else {
                            echo '<button id="disponibilidad" data-disp="Cerrado" type="button" class="col-md-12 btn btn-rojo" style="margin-top: 10px; margin-bottom: 10px">Inactivo</button>';
                        }
                    ;?>
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
                            <label class="col-sm-3 control-label">Correo</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->correo)) ? $datos->correo : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Teléfono</label>
                            <div class="col-sm-9">
                                <input type="text" value ="<?= (isset($datos->telefono)) ? $datos->telefono : '' ;?>" class="form-control Letras">
                            </div>        
                        </div>
                        <?php
                            if($this->session->idPerfil == 2 || $this->session->idPerfil == 4) {
                            ;?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= ($this->session->idPerfil == 2) ? 'Ventas' : 'Saldo';?></label>
                                    <div class="col-sm-9">
                                        <input type="text" value ="$<?= (isset($datos->saldo)) ? $datos->saldo : '' ;?>" class="form-control Letras">
                                    </div>        
                                </div>
                        <?php     
                            }
                        ;?>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('Global/footer')?>
<script>
    $(document).ready(function() {

        $('#disponibilidad').click(function() {
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se cambiará la disponibilidad de la empresa ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                        var disponibilidad = $('#disponibilidad').attr('data-disp');
                        $.ajax({
                            url: base_url+'index.php/Datos/cambiarDisponibilidad',
                            data: {disponibilidad:disponibilidad},
                            type: 'POST',
                            success: function() {
                                if(disponibilidad == 'Abierto') {
                                    $('#disponibilidad').attr('data-disp','Cerrado');
                                    $('#disponibilidad').attr('class','col-md-12 btn btn-rojo');
                                    $('#disponibilidad').html('Inactivo');
                                }
                                else {
                                    $('#disponibilidad').attr('data-disp','Abierto');
                                    $('#disponibilidad').attr('class','col-md-12 btn btn-success');
                                    $('#disponibilidad').html('Activo');
                                }
                            }
                        }); 
                	}
            	}
          	});
        });
    });
</script>
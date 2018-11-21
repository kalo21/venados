<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center" id="titulo">Recargas</h3>
            </div>
            <br>
            <div class="col-md-offset-4 col-md-4" id="contenedorperro">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" id="tab1">Recargar</a></li>
                        <li><a href="#tab_2" data-toggle="tab" id="tab2">Historial</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div id="error" hidden class="alert alert-warning">
        
                            </div>
                            <form id="frmRecarga">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="">
                                            <input type="password" id="inpUsuario" name="inpUsuario" class="form-control input-lg" placeholder="ID de usuario">
                                            <br>
                                            <input type="text" id="inpVerificar" name="inpVerificar" class="form-control input-lg" placeholder="ID de usuario">
                                            <br>
                                            <div class="form-group">
                                                <div class="input-group input-group-lg">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" class="form-control" placeholder="Monto" id="inpMonto" name="inpMonto">       
                                                </div>
                                            </div>
                                            <input type="password" id="inpPIN" name="inpPIN" class="form-control input-lg" placeholder="PIN del empleado">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row text-center">
                                        <button type="button" id="btnAgregar" name="btnAgregar" class="btn btn-rojo btn-block">Agregar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table id="tabla" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Vendedor</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('Global/footer')?>

<!------------------------------------------------------------------------------------------------------------------->

<script>
    $(document).ready(function(){
        var tabla = insertarPaginado('tabla');
		obtenerDatos($('#opciones').val());
		$('#opciones').change(function(){
			obtenerDatos($('#opciones').val());
		});
        $('#tab2').click(function() {
            $('#contenedorperro').attr('class','col-md-12');
            $('#titulo').html('Historial de recargas');
        });
        $('#tab1').click(function() {
            $('#contenedorperro').attr('class','col-md-offset-4 col-md-4');
            $('#titulo').html('Recargas');
        }); 
        $('#btnAgregar').click(function() {
            $('#error').hide();
            BootstrapDialog.confirm({
                title: 'Advertencia',
                message: 'Se agregara saldo al usuario seleccionado ¿Desea continuar?',
                type: BootstrapDialog.TYPE_DANGER, 
                btnCancelLabel: 'Cancelar', 
                btnOKLabel: 'Continuar', 
                btnOKClass: 'btn-rojo', 
                callback: function(result) {
                    if(result){
                        $.ajax({
							url: base_url+'index.php/Recargas/agregarRecargas/',
						  	type: 'POST',
						  	data: $('#frmRecarga').serialize(),
						  	beforeSend: function(){
							$('#load').show();
							},
							success: function (data) {
								data = JSON.parse(data);
								if(!data['exito']) {
									$('#error').html(data['msg']);
									$('#error').show();
								}
								else if(data['exito']) {
                                    BootstrapDialog.confirm({
                                        title: 'Advertencia',
                                        message: 'Se ha enviado la recarga al usuario',
                                        type: BootstrapDialog.TYPE_DANGER, 
                                        btnOKLabel: 'OK', 
                                        btnOKClass: 'btn-rojo', 
                                    });
                                    $('#frmRecarga')[0].reset();
								}
						  	},
						  	error: function(jqXHR, textStatus, errorThrown) {
								console.log('error::'+errorThrown);
							},
							complete: function(){
								$('#load').hide();
						  	}
					  	});
                    }
                }
            });
        });
        function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Recargas/obtenerRecargas/',
                beforeSend: function(){
                    $('#load').show();
                },
				success: function(data) {
					data = JSON.parse(data);
					if(!data){
						tabla.clear().draw();
					}
					else {
						dibujarTabla(data);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log('error::'+errorThrown);
				},
                complete:function(){
                    $('#load').hide();
                }
			});
		}
		function dibujarTabla(info) {
			tabla.clear().draw();
			$.each(info, function(index, item){
				var output = null;
				var output2 = null;
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['nombreVendedor'],
                    item['monto']
				]).draw(false).node();
			});
		}
    });
</script>
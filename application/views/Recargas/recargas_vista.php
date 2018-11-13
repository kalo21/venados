<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Recargas</h3>
            </div>
            <br>
            <div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Recargar</a></li>
              <li><a href="#tab_2" data-toggle="tab">Historial</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               
                <form id="frmRecarga">
                    <div class="row-fluid">
                        <div class="col-md-6">
                            <input type="password" id="inpUsuario" name="inpUsuario" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="inpVerificar" name="inpVerificar" class="form-control" placeholder="Usuario">
                        </div>
                    </div>
                    
                    <br><br><br>
                    <div class="row-fluid">
                        <div class="col-md-1 ">
                            <p class="text-center"><b>$</b></p>
                        </div>
                        <div class="col-md-11">
                            <input type="text" id="inpMonto" name="inpMonto" class="form-control" placeholder="Cantidad">
                        </div>
                        <br><br><br>
                        <div>
                            <button type="button" id="btnAgregar" name="btnAgregar" class="btn btn-rojo">Agregar</button>
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
        
        $('#btnAgregar').click(function() {
            BootstrapDialog.confirm({
                title: 'Advertencia',
                message: 'Se Recargara saldo al usuario seleccionada ¿Desea continuar?',
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
									$('#frmRecarga')[0].reset();
                                    BootstrapDialog.confirm({
                                        title: 'Advertencia',
                                        message: 'Se ha enviado la recarga al usuario',
                                        type: BootstrapDialog.TYPE_DANGER, 
                                        btnOKLabel: 'OK', 
                                        btnOKClass: 'btn-rojo', 
                                    });
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
				url: base_url+'index.php/Recargas/obtenerRecargas/'+estatus,
				type:'POST',
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
					item['id_usuario'],
					item['id_empleado'],
                    item['monto']
				]).draw(false).node();
			});
		}
    });
</script>
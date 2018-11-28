<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Historial</h3>
            </div>
        </div>
        <div class="row">
  			<div class="form-group col-md-3">
			  <div class="input-group">
					<select name="" id="opciones" class="form-control">
						<option value="0">Todos</option>
						<option value="1">Solicitado</option>
						<option value="2">Cancelado</option>
						<option value="3">Entregado</option>
						<option value="4">Realizado</option>
						<option value="5">En proceso</option>
						<option value="6">Eliminado</option>
					</select>
					<div class="input-group-addon" id="buscarEstado"><span class="fa fa-search mano"></span></div>
			  </div>
  			</div>
			<div class="form-group col-md-4">
				<div class="input-group">
					<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
					<input type="text" class="form-control" id="inpFecha" placeholder="Fecha inicial - Fecha final">
					<div class="input-group-addon" id="buscarFecha"><span class="fa fa-search mano"></span></div>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="input-group">
					<input type="text" class="form-control" id="inpUsuario" placeholder="Nombre del usuario">
					<div class="input-group-addon" id="buscarUsuario"><span class="fa fa-search mano"></span></div>
				</div>
			</div>
			<div class="col-md-1">
				<button id="btnBuscar" type="button" class="btn btn-rojo">Buscar</button>
			</div>
  		</div>
  		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Listado de Pedidos</h3>
						<div class="box-tools pull-right">
							 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
					 	<div class="box-body table-responsive no-padding">
							<table id="tabla" class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Precio</th>
                                        <th>Fecha</th>
                                        <th style='text-align:center'>Detalles</th>
										<th style='text-align:center'>Estado</th>
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
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

		$('#inpFecha').daterangepicker({
			autoUpdateInput: false,
			"applyClass": "btn-rojo",
			locale: {
				"cancelLabel": 'Clear',
				"applyLabel": "Aplicar",
        		"cancelLabel": "Cancelar",
				"daysOfWeek": [
					"Do",
					"Lu",
					"Ma",
					"Mi",
					"Ju",
					"Vi",
					"Sa"
				],
			}
		});

		$('#inpFecha').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
		});

		$('#inpFecha').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});


		$('#inpFecha').on('apply.daterangepicker', function(ev, picker) {
				fechaInicio = picker.startDate.format('YYYY-MM-DD');
				fechaFinal= picker.endDate.format('YYYY-MM-DD');
		});

		$('#buscarFecha').click(function(){
			
			$.ajax({
				url: base_url+'index.php/Historial/buscarFecha/',
				data: {fechaInicio:fechaInicio, fechaFinal:fechaFinal},
				type: 'POST',
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
		});

		$('#buscarUsuario').click(function() {
			var usuario = $('#inpUsuario').val();
			if(usuario != '') {
				$.ajax({
					url: base_url+'index.php/Historial/buscarUsuario/',
					type: 'POST',
					data: {usuario:usuario},
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
		});

		$('#btnBuscar').click(function() {
			var fecha = $('#inpFecha').val();
			var usuario = $('#inpUsuario').val();
			var estado = $('#opciones').val();
			$.ajax({
				url: base_url+'index.php/Historial/buscaEspecifica/',
				data: {fechaInicio:fechaInicio, fechaFinal:fechaFinal, usuario:usuario, estado:estado},
				type: 'POST',
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
		});

        var tabla = insertarPaginado('tabla');
        obtenerDatos($('#opciones').val());

        $(document).on('click', '#informacion', function() {
            var id = $(this).attr('data-id');
            BootstrapDialog.show({
                title: 'Pedido #'+id, // Aquí se pone el título
				size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
				message: function(dialog) { 
					var $message = $('<div></div>');
					var pageToLoad = dialog.getData('pageToLoad');
					$message.load(pageToLoad); //Cargamos la vista
					return $message;
				},
				data: {
					'pageToLoad': base_url+'index.php/Historial/informacion/'+id
				},
				buttons: [{ //agrega los botones del modal
					label: 'Cerrar',
					cssClass: 'btn-default',
					action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						dialogItself.close();
					},
				}],
            });
        });
		
		$('#buscarEstado').click(function() {
			obtenerDatos($('#opciones').val());
		});

        function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Historial/obtenerPedidos/',
                data: {estatus:estatus},
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
            var total = 0;
			tabla.clear().draw();
			$.each(info, function(index, item){
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['total'],
                    item['fecha'],
					'<i  id="informacion" data-id="'+item['id']+'"class="fa fa-plus mano" style="font-size: 20px; color: #f6032f;"></i>',
					item['estatus']
				]).draw(false).node();
				$('td:eq(4)', fila).attr('class', 'text-center');
				$('td:eq(5)', fila).attr('class', 'text-center');
			});
		}
    });

</script>
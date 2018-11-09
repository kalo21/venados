<?php $this->load->view('Global/header'); 
	  $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Eventos</h3>
            </div>
        </div>
        <div class="row">
  			<div class="col-xs-3">
				<select name="" id="opciones" class="form-control">
					<option value="-1">Todos</option>
					<option value="1">Activos</option>
					<option value="0">Inactivos</option>
				</select>
  			</div>
  		</div>
  		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Listado de módulos</h3>
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
										<th>Descripción</th>
										<th>Inicio</th>
										<th>Final</th>
										<th>imagen</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer">
						<div class="row-fluid pull-right">
							<button type="button" id="btnAgregar" class="btn btn-rojo">Agregar</button>
						</div>
					</div>
			  </div>
			</div>
		</div>
    </section>
</div>
<?php $this->load->view('Global/footer'); ?>
<script>
$(document).ready(function(){

	var tabla = insertarPaginado('tabla');
	obtenerDatos($('#opciones').val());

	$('#opciones').change(function(){
		obtenerDatos($('#opciones').val());
	});

	$('#btnAgregar').click(function(){
		console.log('Boton funciona');
		BootstrapDialog.show({
			title: 'Agregar evento', // Aquí se pone el título
			size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
			message: function(dialog) { 
				var $message = $('<div></div>');
				var pageToLoad = dialog.getData('pageToLoad');
				$message.load(pageToLoad); //Cargamos la vista
				return $message;
			},
			data: {
				'pageToLoad': base_url+'index.php/Eventos/formulario/'
			},
			buttons: [{ //agrega los botones del modal
				label: 'Cancelar',
				cssClass: 'btn-default',
				action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
					dialogItself.close();
				},

			},
            {	 //agrega los botones del modal
			  	label: 'Guardar',
			  	cssClass: 'btn-rojo',
              	action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
                	var formData = new FormData($('#formulario')[0]);
					$.ajax({
						url: base_url+'index.php/Eventos/agregarEvento/',
					  	type: 'POST',
					  	data: formData,
					  	cache: false,
					  	contentType: false,
					  	processData: false,
					  	beforeSend: function(){
							$('#load').show();
						},
						success: function (data) {
							console.log(data);
					  	},
					  	error: function(jqXHR, textStatus, errorThrown) {
							console.log('error::'+errorThrown);
						},
						complete: function(){
							$('#load').hide();
					  	}
				  	});
				},
		  	}]
		});
	});

	function obtenerDatos(estatus){
		$.ajax({
			url: base_url+'index.php/Eventos/obtenerEventos/'+estatus,
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
			if(item['estatus'] == '0') {
				output = "<small class='label label-danger'>Inactivo</small>";
            output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-plus-circle fa-sm fa-2x fa-lg'></i>";

			}
			else if(item['estatus'] == '1') {
				output = "<small class='label label-success'>Activo</small>";
				output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-minus-circle fa-sm fa-2x fa-lg'></i>";
			}
			var fila = tabla.row.add([
				item['id'],
				item['nombre'],
				item['descripcion'],
				item['fecha_inicial'],
				item['fecha_fin'],
				item['imagen']
			]).draw(false).node();
			$('td:eq(3)', fila).attr('class', 'text-center');
			$('td:eq(4)', fila).attr('class', 'text-center');
			$('td:eq(5)', fila).attr('class', 'text-center');
			$('td:eq(6)', fila).attr('class', 'text-center');
			$('td:eq(7)', fila).attr('class', 'text-center');
		});
	}
});
</script>
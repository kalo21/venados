<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<?php $this->load->view('Productos/productos_modals'); ?>
<div class="content-wrapper">
	<section class="content">
  		<div class="container-fluid">
  			<div class="row">
  				<h3  id="h3"class="text-center">Productos</h3>
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
				<div class="col-xs-12">
				  <div class="box box-danger">
					<div class="box-header">
					  <h3 class="box-title">Listado de productos</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
					  <table id="tabla" class="table table-hover">
					  	<thead>
							<tr>
							  <th>ID</th>
							  <th>Nombre</th>
							  <th>Descripción</th>
							  <th>Precio</th>
							  <th style='text-align:center'>Imagen</th>
							  <th style='text-align:center'>Estado</th>
							  <th style='text-align:center'>Modificar</th>
							  <th style='text-align:center'>Activar/Desactivar</th>
							</tr>
					  	</thead>
					  	<tbody>
					  	
					  	</tbody>
					  </table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="row-fluid pull-right">
							<button type="button" id="btnAgregar" class="btn btn-rojo">Agregar</button>
						</div>
					</div>
				  </div>
				  <!-- /.box -->
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
		
		$(document).on("click", "#cambiarEstado", function () {
			alert(this.id);
    	});
		
		$(document).on("click", "#modificar", function () {
			$('#mdlModificar').modal();
    	});
		$('#btnAgregar').click(function() {
			$('#mdlAgregar').modal();
		});
		function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Productos/obtenerProductos/'+estatus,
				type:'POST',
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
					output2 = "<i style='color:#f6032f' id='cambiarEstado' class='fa fa-plus-circle fa-sm fa-2x fa-lg'></i>";

				}
				else if(item['estatus'] == '1') {
					output = "<small class='label label-success'>Activo</small>";
					output2 = "<i style='color:#f6032f' id='cambiarEstado' class='fa fa-minus-circle fa-sm fa-2x fa-lg'></i>";
				}
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['descripcion'],
					item['precio'],
					"<img height='30' width='30' src='"+base_url+'assets/images/'+item['imagen']+"'></img>",
					output,
					"<i id='modificar' class='fa fa-edit fa-sm fa-2x fa-lg'></i>",
					output2
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
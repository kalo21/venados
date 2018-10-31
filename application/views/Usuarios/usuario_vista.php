<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Usuarios</h3>
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
						<h3 class="box-title">Listado de usuarios</h3>
						<div class="box-tools pull-right">
							 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
				<!-- /.box-header -->
					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table id="tabla" class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Perfil</th>
										<th>Correo</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<!-- ./box-body -->
					
				<!-- /.box-footer -->
			  </div>
			  <!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
              <!-- /.row -->
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
		$(document).on("click", "#modificar", function () {
			alert(this.id);
    	});
		function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Usuarios/obtenerUsuarios/'+estatus,
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
				}
				else if(item['estatus'] == '1') {
					output = "<small class='label label-success'>Activo</small>";
				}
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['nombre2'],
					item['correo'],
					output,
					"<i id='modificar' class='fa fa-edit fa-sm fa-2x fa-lg'></i>",
				]).draw(false).node();
				$('td:eq(4)', fila).attr('class', 'text-center');
			});
		}
	});
</script>
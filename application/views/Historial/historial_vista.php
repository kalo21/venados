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
  			<div class="col-xs-2">
				<select name="" id="opciones" class="form-control">
                    <option value="0">Todos</option>
					<option value="1">Solicitado</option>
					<option value="2">Cancelado</option>
					<option value="3">Entregado</option>
					<option value="4">Realizado</option>
				</select>
  			</div>
            <div class="col-xs-2">
                <input type="date" class="form-control">
  			</div>
  		</div>
  		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Listado de pedidos</h3>
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
    $(document).ready(function() {

        var tabla = insertarPaginado('tabla');
        obtenerDatos($('#opciones').val());

        $(document).on('click', '#informacion', function() {
            alert('click');
        });

        $('#opciones').change(function() {
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
                    console.log(data);
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
					'<a  id="informacion" data-id="'+item['id']+'"class="col-xs-1 col-xs-offset-1 text-middle"><span class="fa fa-plus" style="font-size: 20px; color: #f6032f;"></span></a>',
					item['estatus']
				]).draw(false).node();
				$('td:eq(3)', fila).attr('class', 'text-center');
				$('td:eq(4)', fila).attr('class', 'text-center');
			});
		}
    });

</script>
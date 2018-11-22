<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center" id="titulo">Recargas</h3>
            </div>
            <br>
            <div class="form-group col-md-4 col-md-offset-1">
				<div class="input-group">
					<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
					<input type="text" class="form-control" id="inpFecha">
                    <div class="input-group-addon" id="buscarFecha"><span class="fa fa-search"></span></div>
				</div>
			</div>
            <div class="col-md-offset-1 col-md-10" id="contenedorperro">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" id="tab1">Empresas</a></li>
                        <li><a href="#tab_2" data-toggle="tab" id="tab2">Vendedores</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <div class="box-body table-responsive no-padding">
                                    <table id="tabla1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Empresa</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table id="tabla2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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

<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

        var tabla1 = insertarPaginado('tabla1');
        var tabla2 = insertarPaginado('tabla2');

        $('#inpFecha').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
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
				url: base_url+'index.php/Registros/obtenerDatos/',
				data: {fechaInicio:fechaInicio, fechaFinal:fechaFinal},
				type: 'POST',
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
			});
		});

        function dibujarTabla(info) {
            tabla1.clear().draw();
            tabla2.clear().draw();
			$.each(info.empresas, function(index, item){
				var fila = tabla1.row.add([
					item['id'],
					item['nombre'],
					item['total'],
				]).draw(false).node();
			});
			$.each(info.vendedores, function(index, item){
				var fila = tabla2.row.add([
					item['id'],
					item['nombre'],
					item['total'],
				]).draw(false).node();
			});
        }
    })
</script>
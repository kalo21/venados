<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center" id="titulo">Registros</h3>
            </div>
            <br>
            <div class="col-md-offset-1 col-md-10" id="contenedorperro">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" id="tab1">Empresas</a></li>
                        <li><a href="#tab_2" data-toggle="tab" id="tab2">Vendedores</a></li>
                        <li><a href="#tab_3" data-toggle="tab" id="tab3">Clientes</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group col-md-4">
                                <select id="selectEmpresa" class="form-control">
                                    <option selected value="">Empresa</option>
                                    <?php
                                        foreach($empresas as $empresa) {
                                            echo '<option value="'.$empresa->id.'">'.$empresa->nombre.'</option>';
                                        }
                                    ;?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                    <input type="text" class="form-control" id="inpFechaEmpresa" placeholder="Fecha inicial - Fecha final">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button id="btnEmpresa" type="button" class="btn btn-rojo">Buscar</button>
                            </div>
                            <div class="box-body">
                                <div class="box-body table-responsive no-padding col-md-12">
                                    <table id="tabla1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
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
                        <div class="form-group col-md-4">
                            <select name="" id="selectVendedor" class="form-control">
                                <option selected value="">Vendedores</option>
                                <?php
                                    foreach($vendedores as $vendedor) {
                                        echo '<option value="'.$vendedor->id.'">'.$vendedor->nombre.'</option>';
                                    }
                                ;?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                <input type="text" class="form-control" id="inpFechaVendedor" placeholder="Fecha inicial - Fecha final">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="btnVendedor" type="button" class="btn btn-rojo">Buscar</button>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12 box-body table-responsive no-padding">
                                <table id="tabla2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="form-group col-md-4">
                                <input id="inpCliente" type="text" class="form-control" placeholder="Cliente">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                <input type="text" class="form-control" id="inpFechaCliente" placeholder="Fecha inicial - Fecha final">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="btnCliente" type="button" class="btn btn-rojo">Buscar</button>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding col-md-12">
                                <table id="tabla3" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Recarga</th>
                                            <th>Pedido</th>
                                            <th>Saldo</th>
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
        var tabla3 = insertarPaginado('tabla3');

        function insertarPaginado(id,length=10,search=false){
    	  return $(`#${id}`).DataTable({
    	     'paging'       : true,
             'order'        : [[1, "asc"]],
    	     'lengthChange' : false,
    	     'searching'    : search,
    	     'ordering'     : false,
    	     'info'         : true,
    	     'scrollx'      :true,
    	     'autoWidth'    : false,
    	     'destroy'      : true,
    	     "iDisplayLength": length,
    	     "language"     : {  "url": `<?php echo base_url()?>assets/files/SpanishT.json`  }
    	  });

    	}

        $('#inpFechaEmpresa').daterangepicker({
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

        $('#inpFechaEmpresa').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#inpFechaEmpresa').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#inpFechaEmpresa').on('apply.daterangepicker', function(ev, picker) {
                fechaInicioE = picker.startDate.format('YYYY-MM-DD');
                fechaFinalE = picker.endDate.format('YYYY-MM-DD');

        });

        $('#inpFechaVendedor').daterangepicker({
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

        $('#inpFechaVendedor').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#inpFechaVendedor').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#inpFechaVendedor').on('apply.daterangepicker', function(ev, picker) {
                fechaInicioV = picker.startDate.format('YYYY-MM-DD');
                fechaFinalV = picker.endDate.format('YYYY-MM-DD');

        });

        $('#inpFechaCliente').daterangepicker({
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

        $('#inpFechaCliente').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#inpFechaCliente').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#inpFechaCliente').on('apply.daterangepicker', function(ev, picker) {
                fechaInicioC = picker.startDate.format('YYYY-MM-DD');
                fechaFinalC = picker.endDate.format('YYYY-MM-DD');

        });

        $('#btnEmpresa').click(function() {
            if($('#selectEmpresa').val() != '' && typeof(fechaInicioE) !== 'undefined' && typeof(fechaFinalE) !== 'undefined') {
                $.ajax({
                    url: base_url+'index.php/Saldos/buscarEmpresa',
                    data: {idEmpresa:$('#selectEmpresa').val(), fechaInicio:fechaInicioE, fechaFinal:fechaFinalE},
                    type: "POST",
                    success: function(data) {
                        data = JSON.parse(data);
                        dibujarEmpresa(data);
                    }
                });
            }
        });

        $('#btnVendedor').click(function() {
            if($('#selectVendedor').val() != '' && typeof(fechaInicioV) !== 'undefined' && typeof(fechaFinalV) !== 'undefined') {
                $.ajax({
                    url: base_url+'index.php/Saldos/buscarVendedor',
                    data: {idVendedor:$('#selectVendedor').val(), fechaInicio:fechaInicioV, fechaFinal:fechaFinalV},
                    type: "POST",
                    success: function(data) {
                        data = JSON.parse(data);
                        dibujarVendedor(data);
                    }
                });
            }
        });

        $('#btnCliente').click(function() {
            if($('#inpCliente').val() != '' && typeof(fechaInicioC) !== 'undefined' && typeof(fechaFinalC) !== 'undefined') {
                $.ajax({
                    url: base_url+'index.php/Saldos/buscarCliente',
                    data: {idCliente:$('#inpCliente').val(), fechaInicio:fechaInicioC, fechaFinal:fechaFinalC},
                    type: "POST",
                    success: function(data) {
                        data = JSON.parse(data);
                        dibujarCliente(data);
                    }
                });
            }

        });

        function dibujarEmpresa(data) {
            tabla1.clear().draw();
			$.each(data, function(index, item){
				var fila = tabla1.row.add([
					item['id'],
					item['fecha'],
					item['cliente'],
					'$ '+item['total'],
				]).draw(false).node();
			});
        }

        function dibujarVendedor(data) {
            tabla2.clear().draw();
			$.each(data, function(index, item){
				var fila = tabla2.row.add([
					item['id'],
					item['fecha'],
					item['cliente'],
					'$ '+item['monto'],
				]).draw(false).node();
			});
        }

        function dibujarCliente(data) {
            tabla3.clear().draw();
            var saldo = Math.abs(data.saldo.monto) - Math.abs(data.pedidos.total);
            var x = 0;
			$.each(data.movimientos, function(index, item){
                saldo = saldo + Math.abs(item['recarga']) - Math.abs(item['pedido'])
                var fila = tabla3.row.add([
                    item['id'],
                    item['fecha'],
                    item['recarga'],
                    item['pedido'],
                    saldo
                ]).draw(false).node();
			});
        }

    })
</script>
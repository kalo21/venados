<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center" id="titulo">Reportes</h3>
            </div>
            <br>

            <div class="col-md-offset-1 col-md-10" id="contenedorperro">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" id="tab1">Empresas</a></li>
                        <li><a href="#tab_2" data-toggle="tab" id="tab2">Vendedores</a></li>
                        <li><a href="#tab_3" data-toggle="tab" id="tab3">Ventas por cliente</a></li>
                        <li><a href="#tab_4" data-toggle="tab" id="tab3">Recargas de clientes</a></li> 
                        
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group col-md-4">
                                <select id="selectEmpresa" class="form-control">
                                    <option selected value="">Seleccione una empresa</option>
                                    <option value="0">Todas las empresas</option>
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
                                                <th>Empresa</th>
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
                            <div class="box-footer" style="text-align: left">
                                <div class="row" >
                                    <div class="col-md-6">
                                        <button class="btn btn-rojo" id="btnGenEmpresa">Generar reporte</button>
                                    </div>
                                    
                                    <div class="col-md-6" style="text-align: right !important; ">
                                        <h2 id="totEmpCont" style="padding-right: 15% !important;">Total: <span id="totalEmpresa" style="color: green"></span> </h2> 
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="form-group col-md-4">
                            <select name="" id="selectVendedor" class="form-control">
                                <option selected value="">Seleccione un vendedor</option>
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
                        <div class="box-footer" style="text-align: right">
                            <div class="row" >
                                <div class="col-md-6">
                                    <button class="btn btn-rojo" id="btnGenVendedor">Generar reporte</button>
                                </div>
                                
                                <div class="col-md-6" style="text-align: right !important; ">
                                    <h2 id="totVenCont" style="padding-right: 15% !important;">Total: <span id="totalVededor" style="color: green"></span> </h2> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Este es la tabla de ClientesCompras -->
                    <div class="tab-pane" id="tab_3">
                        <div class="form-group col-md-4">
                        <select name="" id="inpClienteCompra" class="form-control">
                                <option selected value="">Seleccione un cliente</option>
                                <?php
                                    foreach($clientesCompras as $cliente) {
                                        echo '<option value="'.$cliente->id.'">'.$cliente->nombre.'</option>';
                                    }
                                ;?>
                         </select>
                                
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                <input type="text" class="form-control" id="fechaClienteCompra" placeholder="Fecha inicial - Fecha final">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="btnClienteCompra" type="button" class="btn btn-rojo">Buscar</button>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding col-md-12">
                                <table id="tabla3" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Empresa</th>
                                            <th>Estatus</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align: right">
                            <div class="row" >
                                <div class="col-md-6">
                                    <button class="btn btn-rojo" id="btnGenClienteCompra">Generar reporte</button>
                                </div>
                                
                                <div class="col-md-6" style="text-align: right !important; ">
                                    <h2 id="totClCont" style="padding-right: 15% !important;">Total: <span id="totalCC" style="color: green"></span> </h> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Este es la tabla de ClientesRecargas -->
                    <div class="tab-pane" id="tab_4">
                        <div class="form-group col-md-4">
                            <select name="" id="inpClienteRecarga" class="form-control">
                                    <option selected value="">Seleccione un cliente</option>
                                    <?php
                                        foreach($clientesRecargas as $cliente) {
                                            echo '<option value="'.$cliente->id.'">'.$cliente->nombre.'</option>';
                                        }
                                    ;?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                <input type="text" class="form-control" id="fechaClienteRecarga" placeholder="Fecha inicial - Fecha final">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="btnClienteRecarga" type="button" class="btn btn-rojo">Buscar</button>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding col-md-12">
                                <table id="tabla4" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Vendedor</th>
                                            <th>Recarga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align: right">
                            <div class="row" >
                                <div class="col-md-6">
                                    <button class="btn btn-rojo" id="btnGenClienteRecarga">Generar reporte</button>
                                </div>
                                
                                <div class="col-md-6" style="text-align: right !important; ">
                                    <h2 id="totCRCont" style="padding-right: 15% !important;">Total: <span id="totalCR" style="color: green"></span> </h2> 
                                </div>
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
        var totalEmpresa = 0;
        //$("#totalEmpresa").HTML(totalEmpresa);
        $("#btnGenEmpresa").css("display", "none");
        $("#btnGenVendedor").css("display", "none");
        $("#btnGenClienteCompra").css("display", "none");
        $("#btnGenClienteRecarga").css("display", "none");
        $("#totEmpCont").css("display", "none");
        $("#totVenCont").css("display", "none");
        $("#totClCont").css("display", "none");
        $("#totCRCont").css("display", "none");

        var tabla1 = insertarPaginado('tabla1');
        var tabla2 = insertarPaginado('tabla2');
        var tabla3 = insertarPaginado('tabla3');
        var tabla4 = insertarPaginado('tabla4');

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

        //**********PARA EL INPUT DE CLIENTE COMPRAS********** */
        $('#fechaClienteCompra').daterangepicker({
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

        $('#fechaClienteCompra').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#fechaClienteCompra').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#fechaClienteCompra').on('apply.daterangepicker', function(ev, picker) {
                fechaInicioCC = picker.startDate.format('YYYY-MM-DD');
                fechaFinalCC = picker.endDate.format('YYYY-MM-DD');

        });
        //**********PARA EL INPUT DE CLIENTE RECARGAS********** */
        $('#fechaClienteRecarga').daterangepicker({
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

        $('#fechaClienteRecarga').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#fechaClienteRecarga').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        $('#fechaClienteRecarga').on('apply.daterangepicker', function(ev, picker) {
                fechaInicioCR = picker.startDate.format('YYYY-MM-DD');
                fechaFinalCR = picker.endDate.format('YYYY-MM-DD');

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
            }else {
                alert("Rellene todos los campos");
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
            }else {
                alert("Rellene todos los campos");
            }
        });
        /** PARA EL CLIENTE COMPRA */
        $('#btnClienteCompra').click(function() {
            if($('#inpClienteCompra').val() != '' && typeof(fechaInicioCC) !== 'undefined' && typeof(fechaFinalCC) !== 'undefined') {
                $.ajax({
                    url: base_url+'index.php/Saldos/buscarClienteCompra',
                    data: {idUsuario:$('#inpClienteCompra').val(), fechaInicio:fechaInicioCC, fechaFinal:fechaFinalCC},
                    type: "POST",
                    success: function(data) {
                        data = JSON.parse(data);
                        //console.log("se logró la conexion");
                        dibujarClienteCompra(data);
                    }
                });
            }else {
                alert("Rellene todos los campos");
            }

        });
        /*** PARA EL CLIENTE RECARGA¨*******/
        $('#btnClienteRecarga').click(function() {
            if($('#inpClienteRecarga').val() != '' && typeof(fechaInicioCR) !== 'undefined' && typeof(fechaFinalCR) !== 'undefined') {
                $.ajax({
                    url: base_url+'index.php/Saldos/buscarClienteRecarga',
                    data: {idCliente:$('#inpClienteRecarga').val(), fechaInicio:fechaInicioCR, fechaFinal:fechaFinalCR},
                    type: "POST",
                    success: function(data) {
                        data = JSON.parse(data);
                        //console.log("Se logró la conexion");
                        dibujarClienteRecarga(data);
                    }
                });
            }else {
                alert("Rellene todos los campos");
            }

        });

        //Generar reporte de empresa
        $('#btnGenEmpresa').click(function(){
            //console.log("se precionó el boton");
            let url = 	base_url + "index.php/Saldos/imprimir/"+$('#selectEmpresa').val()+"/"+fechaInicioE+"/"+fechaFinalE+"/1";
            window.open(url, '_blank');
        });

        //Generar reporte de Vendedores
        $('#btnGenVendedor').click(function(){
            //console.log("se precionó el boton");
            let url = 	base_url + "index.php/Saldos/imprimir/"+$('#selectVendedor').val()+"/"+fechaInicioV+"/"+fechaFinalV+"/2";
            window.open(url, '_blank');
        });
        
        //Generar reporte de Compras de clientes
        $('#btnGenClienteCompra').click(function(){
            //console.log("se precionó el boton");
            let url = 	base_url + "index.php/Saldos/imprimir/"+$('#inpClienteCompra').val()+"/"+fechaInicioCC+"/"+fechaFinalCC+"/3";
            window.open(url, '_blank');
        });

        //Generar reporte de Recargas de clientes
        $('#btnGenClienteRecarga').click(function(){
            //console.log("se precionó el boton");
            let url = 	base_url + "index.php/Saldos/imprimir/"+$('#inpClienteRecarga').val()+"/"+fechaInicioCR+"/"+fechaFinalCR+"/4";
            window.open(url, '_blank');
        });
        /* function imprimirFicha (data, nombre, tipo) {			
			window.location = base_url + "index.php/Saldos/imprimir/" + data + "/" + nombre + "/" + tipo;
		} */

        function dibujarEmpresa(data) {
            tabla1.clear().draw();
            let totalEmpresa = 0;
            if (data.length != 0) {
                $("#btnGenEmpresa").css("display", "block");
                $("#totEmpCont").css("display", "block");
                
            }else{
                $("#btnGenEmpresa").css("display", "none");
                $("#totEmpCont").css("display", "none");
            }
			$.each(data, function(index, item){
                totalEmpresa += Number(item['total']);
				var fila = tabla1.row.add([
                    item['nombre'],
                    item['fecha'],
					item['cliente'],
					'$ '+item['total'],
				]).draw(false).node();
                
			});
            $('#totalEmpresa').text("$ "+totalEmpresa);
            //console.log(totalEmpresa);
        }

        function dibujarVendedor(data) {
            let total = 0;
            tabla2.clear().draw();
            console.log(data.length);
            if (data.length != 0) {
                $("#btnGenVendedor").css("display", "block");
                $("#totVenCont").css("display", "block");
            }else{
                $("#btnGenVendedor").css("display", "none");
                $("#totVenCont").css("display", "none");
            }
			$.each(data, function(index, item){
                total += Number(item['monto']);
				var fila = tabla2.row.add([
					item['id'],
					item['fecha'],
					item['cliente'],
					'$ '+item['monto'],
				]).draw(false).node();
			});
            $('#totalVededor').text("$ "+total);
        }

        function dibujarClienteCompra(data) {
            let totalCC = 0;
            tabla3.clear().draw();
            console.log(data.length);
            //var saldo = Math.abs(data.saldo.monto) - Math.abs(data.pedidos.total);
            //var x = 0;
            if (data.length != 0) {
                $("#btnGenClienteCompra").css("display", "block");
                $("#totClCont").css("display", "block");
            }else{
                $("#btnGenClienteCompra").css("display", "none");
                $("#totClCont").css("display", "none");
            }
			$.each(data, function(index, item){
                //saldo = saldo + Math.abs(item['recarga']) - Math.abs(item['pedido'])
                totalCC += Number(item['total']);
                var fila = tabla3.row.add([
                    item['id'],
                    item['fecha'],
                    item['nombre'],
                    item['estatus'],
                    "$ "+item['total'],
                ]).draw(false).node();
			});
            $('#totalCC').text("$ "+totalCC);
        }

        function dibujarClienteRecarga(data) {
            let totalCR = 0;
            tabla4.clear().draw();
            console.log(data.length);
            //var saldo = Math.abs(data.saldo.monto) - Math.abs(data.pedidos.total);
            //var x = 0;
            if (data.length != 0) {
                $("#btnGenClienteRecarga").css("display", "block");
                $("#totCRCont").css("display", "block");
            }else{
                $("#btnGenClienteRecarga").css("display", "none");
                $("#totCRCont").css("display", "none");
            }
			$.each(data, function(index, item){
                totalCR += Number(item['monto']);
                //saldo = saldo + Math.abs(item['recarga']) - Math.abs(item['pedido'])
                var fila = tabla4.row.add([
                    item['id'],
                    item['fecha'],
                    item['nombre'],
                    "$ "+item['monto'],
                ]).draw(false).node();
			});
            $('#totalCR').text("$ "+totalCR);
        }

    })
</script>
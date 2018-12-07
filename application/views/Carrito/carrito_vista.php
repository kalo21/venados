
<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<style>
    .box-body{
        margin-bottom: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" style="padding-left:0px; padding-right:0px">


                <div class="col-md-12" id="contenedor" style="padding-left:0px; padding-right:0px">
                    <!-- <div style="display:flex; align-items: center; justify-content: center" class="col-md-12" height="30px">
                        <h3>Por pedir</h3>
                    </div> -->
                    <!-- Pedidos por empresa -->
                </div>
                <div class="col-md-12" id="pedidos" style="padding-left:0px; padding-right:0px">
                    <div style="display:flex; align-items: center; justify-content: center" class="col-md-12" height="30px">
                        <h3>Pedidos</h3>
                    </div>
                    <!-- Pedidos hechos -->
                </div>
                <div class="col-md-12" id="listos" style="padding-left:0px; padding-right:0px">
                    <div style="display:flex; align-items: center; justify-content: center" class="col-md-12" height="30px">
                        <h3>Listos</h3>
                    </div>
                    <!-- Pedidos listos -->
                </div>
                <div class="col-md-12" id="cancelados" style="padding-left:0px; padding-right:0px">
                    <div style="display:flex; align-items: center; justify-content: center" class="col-md-12" height="30px">
                        <h3>Cancelados</h3>
                    </div>
                    <!-- Pedidos cancelados -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border text-center" style="background-color: #f6032f">
                        <h3 class="box-title" style="color:white">Confirmación de pedidos</h3>
                    </div>
                    <div class="box box-body">
                        <div style="display: flex; align-items: center; height:56.4px" class="text-center">
                            <strong style="font-size:24px" class="col-xs-12">Total: $ <span id="total"></span></strong>
                        </div>
                        <button id="confirmar" type="button" class="btn btn-rojo col-xs-12">Confirmar Pedidos</button>
                    </div>
                </div>
            </div>
            
		</div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

        dibujarCarrito();
        dibujarPedidos();
        dibujarRealizados();
        dibujarCancelados();

        $(document).on('click', '#minimizar', function() {
            if($(this).attr('class') == 'mano pull-right fa fa-plus') {
                $(this).attr('class', 'mano pull-right fa fa-minus');
            }
            else {
                $(this).attr('class', 'mano pull-right fa fa-plus');
            }
        });

        $(document).on('click', '#confirmar', function() {
            $.ajax({
                url: base_url+'index.php/Carrito/confirmarPedido',
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['exito']) {
                        $('.realizar').trigger('click');
                    }
                    else {
                        BootstrapDialog.confirm({
                            title: 'Advertencia',
                            message: data['msg'],
                            type: BootstrapDialog.TYPE_DANGER, 
                            btnOKLabel: 'OK', 
                            btnOKClass: 'btn-rojo', 
                        });
                    }
                }
            })
        });

        $(document).on('click', '#cancelar', function() {
            var idEmpresa = $(this).parent().attr('data-id');
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se eliminará el pedido seleccionado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                        $.ajax({
                            url: base_url+'index.php/Carrito/cancelarCarrito',
                            type: 'POST',
                            data: {idEmpresa:idEmpresa},
                            success: function() {
                                location.reload();
                            }
                        });
                	}
            	}
          	});
        });

        $(document).on('click', '#cancelarPedido', function() {
            var idPedido = $(this).parent().attr('data-id');
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se cancelará el pedido seleccionado siempre y cuando no se encuentre en proceso ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                        $.ajax({
                            url: base_url+'index.php/Carrito/cancelarPedido',
                            type: 'POST',
                            data: {idPedido:idPedido},
                            success: function(data) {
                                data = JSON.parse(data);
                                BootstrapDialog.confirm({
                                    title: 'Advertencia',
                                    message: data['msg'],
                                    type: BootstrapDialog.TYPE_DANGER, 
                                    btnOKLabel: 'Continuar', 
                                    btnOKClass: 'btn-rojo',
                                    callback: function(result) {
                                        location.reload();
                                    } 
                                });
                            }
                        });
                	}
            	}
          	});
        });

        $(document).on('click', '#eliminarPedido', function() {
            var idPedido = $(this).parent().attr('data-id');
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se eliminará el pedido seleccionado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                        $.ajax({
                            url: base_url+'index.php/Carrito/eliminarPedido',
                            type: 'POST',
                            data: {idPedido:idPedido},
                            success: function() {
                                location.reload();
                            }
                        });
                	}
            	}
          	});
        });

        $(document).on('click', '#realizar', function() {
            var idEmpresa = $(this).parent().attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/realizarPedido',
                type: 'POST',
                data: {idEmpresa:idEmpresa},
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['exito']) {
                        location.reload();
                    }
                    else {
                        BootstrapDialog.confirm({
                            title: 'Advertencia',
                            message: data['msg'],
                            type: BootstrapDialog.TYPE_DANGER, 
                            btnOKLabel: 'OK', 
                            btnOKClass: 'btn-rojo', 
                        });
                    }
                }
            });
        });

        $(document).on('click', '#eliminar', function() {
            var rowid = $(this).parent().attr('data-id');
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se eliminará el producto seleccionado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                        $.ajax({
                            url: base_url+'index.php/Carrito/eliminarProducto/',
                            type: "POST",
                            data:{rowid:rowid},
                            success: function() {
                                location.reload();
                            }
                        });
                	}
            	}
          	});
        });

        $(document).on('change', 'input', function() {
            var qty = $(this).val();
            var rowid = $(this).parent().attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/actualizarCantidad',
                type: 'POST',
                data: {rowid:rowid, qty:qty},
                success: function(data) {
                    $('#total').html(data);
                }
            });
        });

        function dibujarCarrito() {
            var data = <?php echo json_encode($this->cart->contents());?>;
            var contenedor = '';
            if(data.length != 0) {
                $.each(data, (function(index, producto) {
                    if($('#'+producto.idEmpresa+'').length) {
                        contenedor += '        <div class="col-md-7 col-xs-7">';
                        contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                        contenedor += '            <p class="col-md-9 text-justify">'+producto.description+'</p>';
                        contenedor += '        </div>';
                        contenedor += '        <div class="col-md-5 col-xs-5 text-center" data-id="'+producto.rowid+'">';
                        contenedor += '            <p class="col-md-5 col-xs-12 text-success">$ '+producto.price+'</p>';
                        contenedor += '            <input type="number" min="1" class="form-group col-md-4 col-xs-12" value="'+producto.qty+'">';
                        contenedor += '            <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-3 col-xs-12 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                        contenedor += '        </div>';
                        $('#'+producto.idEmpresa+'').append(contenedor);
                        contenedor = '';
                    }
                    else {
                        contenedor += '<div class="col-md-12">';
                        contenedor += '    <div class="box box-solid">';
                        contenedor += '        <div  class="box-header with-border" style="background-color: #f6032f">';
                        contenedor += '            <h3 class="box-title" style="color:white">Empresa: '+producto.nombreEmpresa+'</h3>';
                        contenedor += '            <span data-toggle="collapse" data-target=".'+producto.idEmpresa+'" style="font-size:20px; color:white; padding-right:10px" id="minimizar" class="mano pull-right fa fa-minus"></span>';
                        contenedor += '        </div>';
                        contenedor += '        <div class="'+producto.idEmpresa+'  collapse in">';
                        contenedor += '            <div class="box box-body" id="'+producto.idEmpresa+'">';
                        contenedor += '                <div class="col-md-7 col-xs-7">';
                        contenedor += '                    <p class="col-md-3">'+producto.name+'</p>';
                        contenedor += '                        <p class="col-md-9 text-justify">'+producto.description+'</p>';
                        contenedor += '                </div>';
                        contenedor += '                <div class="col-md-5 col-xs-5 text-center" data-id="'+producto.rowid+'">';
                        contenedor += '                    <p class="col-md-5 col-xs-12 text-center text-success">$ '+producto.price+'</p>';
                        contenedor += '                    <input type="number" min="1" class="form-group col-md-4 col-xs-12" value="'+producto.qty+'">';
                        contenedor += '                    <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-3 col-xs-12 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                        contenedor += '               </div>';
                        contenedor += '            </div>';
                        contenedor += '            <div data-id="'+producto.idEmpresa+'" class="box box-footer">';
                        contenedor += '                 <a id="cancelar" class="col-md-3 col-md-offset-6 col-xs-6" href="#">Cancelar pedido</a>';
                        contenedor += '                 <a id="realizar" class="col-md-3 col-xs-6 realizar" href="#">Realizar pedido</a>';
                        contenedor += '            </div>';
                        contenedor += '        </div>';
                        contenedor += '    </div>';
                        contenedor += '</div>';
                        $('#contenedor').append(contenedor);
                        contenedor = '';
                    }
                }));
                $('#total').html('<?php echo $this->cart->total();?>');
            }
            else {
                $('#contenedor').html('<div class="box box-solid col-md-12"><div  class="box-header with-border text-center" style="background-color: white"><h3 class="box-title">No hay nada en el carrito</h3></div></div>');
            }
        }

        function dibujarPedidos() {
            $.ajax({
                url: base_url+'index.php/Carrito/obtenerPedidos',
                success: function(data) {
                    data = JSON.parse(data);
                    var contenedor = '';
                    if(data) {
                        $.each(data, (function(index, producto) {
                            if($('#'+producto.idPedido+'').length) {
                                contenedor += '        <div class="col-md-7 col-xs-7">';
                                contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '            <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="col-md-5 col-xs-5 text-center">';
                                contenedor += '            <p class="col-md-6 col-xs-12 text-success">$ '+producto.price+'</p>';
                                contenedor += '            <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '        </div>';
                                $('#'+producto.idPedido+'').append(contenedor);
                                contenedor = '';
                            }
                            else {
                                contenedor += '<div class="col-md-12">';
                                contenedor += '    <div class="box box-solid">';
                                contenedor += '        <div  class="box-header with-border" style="background-color: #f6032f">';
                                contenedor += '            <h3 class="box-title" style="color:white">Pedido: '+producto.idPedido+'</h3>';
                                contenedor += '            <span data-toggle="collapse" data-target=".'+producto.idPedido+'" style="font-size:20px; color:white; padding-right:10px" id="minimizar" class="mano pull-right fa fa-plus"></span>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="'+producto.idPedido+' collapse">';
                                contenedor += '            <div class="box box-body" id="'+producto.idPedido+'">';
                                contenedor += '                <div class="col-md-7 col-xs-7">';
                                contenedor += '                    <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '                        <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '                </div>';
                                contenedor += '                <div class="col-md-5 col-xs-5 text-center">';
                                contenedor += '                    <p class="col-md-6 col-xs-12 text-success">$ '+producto.price+'</p>';
                                contenedor += '                    <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '               </div>';
                                contenedor += '            </div>';
                                contenedor += '            <div data-id="'+producto.idPedido+'" class="box box-footer">';
                                contenedor += '                 <a style="padding-right: 30px" id="cancelarPedido" class="pull-right" href="#">Cancelar pedido</a>';
                                contenedor += '            </div>';
                                contenedor += '        </div>';
                                contenedor += '    </div>';
                                contenedor += '</div>';
                                $('#pedidos').append(contenedor);
                                contenedor = '';
                            }
                        }));
                    }
                    else {
                        $('#pedidos').append('<div class="box box-solid col-md-12"><div  class="box-header with-border text-center" style="background-color: white"><h3 class="box-title">No hay ningún pedido solicitado</h3></div></div>');
                    }
                }
            });
        }

        function dibujarRealizados() {
            $.ajax({
                url: base_url+'index.php/Carrito/obtenerRealizados',
                success: function(data) {
                    data = JSON.parse(data);
                    var contenedor = '';
                    if(data) {
                        $.each(data, (function(index, producto) {
                            if($('#'+producto.idPedido+'').length) {
                                contenedor += '        <div class="col-md-7 col-xs-7">';
                                contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '            <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="col-md-5 col-xs-5">';
                                contenedor += '            <p class="col-md-6 col-xs-12 text-center text-success">$ '+producto.price+'</p>';
                                contenedor += '            <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '        </div>';
                                $('#'+producto.idPedido+'').append(contenedor);
                                contenedor = '';
                            }
                            else {
                                contenedor += '<div class="col-md-12">';
                                contenedor += '    <div class="box box-solid">';
                                contenedor += '        <div  class="box-header with-border" style="background-color: #f6032f">';
                                contenedor += '            <h3 class="box-title" style="color:white">Pedido: '+producto.idPedido+'</h3>';
                                contenedor += '            <span data-toggle="collapse" data-target=".'+producto.idPedido+'" style="font-size:20px; color:white; padding-right:10px" id="minimizar" class="mano pull-right fa fa-plus"></span>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="'+producto.idPedido+' collapse">';
                                contenedor += '            <div class="box box-body" id="'+producto.idPedido+'">';
                                contenedor += '                <div class="col-md-7 col-xs-7">';
                                contenedor += '                    <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '                        <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '                </div>';
                                contenedor += '                <div class="col-md-5 col-xs-5 text-center">';
                                contenedor += '                    <p class="col-md-6 col-xs-12 text-success">$ '+producto.price+'</p>';
                                contenedor += '                    <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '               </div>';
                                contenedor += '            </div>';
                                contenedor += '        </div>';
                                contenedor += '    </div>';
                                contenedor += '</div>';
                                $('#listos').append(contenedor);
                                contenedor = '';
                            }
                        }));
                    }
                    else {
                        $('#listos').append('<div class="box box-solid col-md-12"><div  class="box-header with-border text-center" style="background-color: white"><h3 class="box-title">No hay ningún pedido listo</h3></div></div>');
                    }
                }
            });
        }

        function dibujarCancelados() {
            $.ajax({
                url: base_url+'index.php/Carrito/obtenerCancelados',
                success: function(data) {
                    data = JSON.parse(data);
                    var contenedor = '';
                    if(data) {
                        $.each(data, (function(index, producto) {
                            if($('#'+producto.idPedido+'').length) {
                                contenedor += '        <div class="col-md-7 col-xs-7">';
                                contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '            <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="col-md-5 col-xs-5 text-center">';
                                contenedor += '            <p class="col-md-6 col-xs-12 text-success">$ '+producto.price+'</p>';
                                contenedor += '            <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '        </div>';
                                $('#'+producto.idPedido+'').append(contenedor);
                                contenedor = '';
                            }
                            else {
                                contenedor += '<div class="col-md-12">';
                                contenedor += '    <div class="box box-solid">';
                                contenedor += '        <div  class="box-header with-border" style="background-color: #f6032f">';
                                contenedor += '            <h3 class="box-title" style="color:white">Pedido: '+producto.idPedido+'</h3>';
                                contenedor += '            <span data-toggle="collapse" data-target=".'+producto.idPedido+'" style="font-size:20px; color:white; padding-right:10px" id="minimizar" class="mano pull-right fa fa-plus"></span>';
                                contenedor += '        </div>';
                                contenedor += '        <div class="'+producto.idPedido+' collapse">';
                                contenedor += '            <div class="box box-body" id="'+producto.idPedido+'">';
                                contenedor += '                <div class="col-md-7 col-xs-7">';
                                contenedor += '                    <p class="col-md-3">'+producto.name+'</p>';
                                contenedor += '                        <p class="col-md-9 text-justify">'+producto.description+'</p>';
                                contenedor += '                </div>';
                                contenedor += '                <div class="col-md-5 col-xs-5 text-center">';
                                contenedor += '                    <p class="col-md-6 col-xs-12 text-success">$ '+producto.price+'</p>';
                                contenedor += '                    <p class="col-md-4 col-md-offset-2 col-xs-12">'+producto.qty+'</p>';
                                contenedor += '               </div>';
                                contenedor += '            </div>';
                                contenedor += '            <div data-id="'+producto.idPedido+'" class="box box-footer">';
                                contenedor += '                 <a style="padding-right: 30px" id="eliminarPedido" class="pull-right" href="#">Eliminar</a>';
                                contenedor += '            </div>';
                                contenedor += '        </div>';
                                contenedor += '    </div>';
                                contenedor += '</div>';
                                $('#cancelados').append(contenedor);
                                contenedor = '';
                            }
                        }));
                    }
                    else {
                        $('#cancelados').append('<div class="box box-solid col-md-12"><div  class="box-header with-border text-center" style="background-color: white"><h3 class="box-title">No hay ningún pedido cancelado</h3></div></div>');
                    }
                }
            });
        }

    })
</script>

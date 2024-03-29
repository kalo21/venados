<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #f6032f">
                            <h3 class="box-title" style="color:white">Lista de Pedidos</h3>
                        </div>
                        <div class="box box-body" id="divPedido">
                            
                            <!--  Listado de pedidos  -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="infoPedido" hidden>
                    <div class="box box-solid">
                    <!--  Información del pedido  -->
                    </div>
                </div>
		</div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>
<script src="<?php echo base_url();?>nodejs/node_modules/socket.io-client/dist/socket.io.js"></script>
<script>
    var socket = io.connect('http://pespeciales.upsin.edu.mx',{'forceNew': true});
    socket.emit('add-user', {idEmpresa: <?php echo $this->session->idEmpresa;?>});
    nombreEmpresa = '<?php echo $this->session->nombreEmpresa;?>'; 
    $(document).ready(function(){
        obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
        
        socket.on('pedido',function(data) {
            obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
        });
       
        $(document).on('click', '#cancelar', function() {
            id = $(this).attr('data-id');
            var user = $(this).attr('data-name');
            var msg = "";
            BootstrapDialog.show({
				title: 'Cancelar pedido',
                message: `Se cambiará el estado del pedido seleccionado a cancelado. Por favor indica un motivo
                          al usuario por su cancelación.<br>
                          <input type="text" class="form-control" id="motivo" placeholder="Motivo de cancelación">`,
				type: BootstrapDialog.TYPE_DANGER,
                buttons: [{
                    label: 'Cancelar',
                    action: function(dialogRef){    
                        dialogRef.close();
                    }
                },{
                    id: 'btn-ok',        
                    label: 'Continuar',
                    cssClass: 'btn-rojo',
                    action: function(result){    
                        if(result && $('#motivo').val() != ''){
                            var empresa = "<?php echo $this->session->nombreEmpresa;?>"
                            msg = "Tu pedido de "+empresa+" se  ha cancelado por el siguiente motivo: "+$('#motivo').val();
                            $.ajax({
                                url: base_url+'index.php/Pedidos/cancelarPedido/',
                                type:'POST',
                                data: {id:id},
                                beforeSend: function(){
                                    $('#load').show();
                                },
                                success: function() {
                                    obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
                                    sendNotification(user, msg, id, 3);
                                    $('#infoPedido').fadeOut('slow');
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('error::'+errorThrown);
                                },
                                complete: function(){
                                    $('#load').hide();
                                    result.close();
                                }
                            });
                        }
                        else{
                            var input = $('#motivo');
                            input.attr('style','border: solid red 1px');
                            
                        }
                    }
                }],
          	});
        });

        $(document).on('click', '#entregar', function() {
            id = $(this).attr('data-id');
            var user = $(this).attr('data-name');
            var msg = "Su pedido de "+nombreEmpresa+" ha sido entregado";
            BootstrapDialog.show({
				title: 'Entregar pedido',
                message: `Se cambiará el estado del pedido seleccionado a Entregado. Por favor introduzca el ID del pedido proporcionado por el usuario para continuar.<br>
                          <input type="text" class="form-control" id="idPedido" placeholder="ID del pedido">`,
				type: BootstrapDialog.TYPE_DANGER,
                buttons: [{
                    label: 'Cancelar',
                    action: function(dialogRef){    
                        dialogRef.close();
                    }
                },{
                    id: 'btn-ok',        
                    label: 'Continuar',
                    cssClass: 'btn-rojo',
                    action: function(result){    
                        if(result && $('#idPedido').val() != ''){
                            $.ajax({
                                url: base_url+'index.php/Pedidos/entregarPedido/',
                                type:'POST',
                                data: {id:id, idPedido:$('#idPedido').val()},
                                beforeSend: function(){
                                    $('#load').show();
                                },
                                success: function(data) {
                                    if(data) {
                                        obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
                                        let notifData = {

                                        }
                                        sendNotification(user, msg, id, 2);
                                        $('#infoPedido').fadeOut('slow');
                                    }
                                    else {
                                        BootstrapDialog.show({
                                        title: 'Aviso',
                                        message: 'ID incorrecto',
                                        type: BootstrapDialog.TYPE_DANGER,
                                        buttons: [{ //agrega los botones del modal
                                            label: 'Cerrar',
                                            cssClass: 'btn-default',
                                            action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                                                dialogItself.close();
                                            },
                                        }]
                                    });
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('error::'+errorThrown);
                                },
                                complete: function(){
                                    $('#load').hide();
                                    result.close();
                                }
                            });
                        }
                        else{
                            var input = $('#idPedido');
                            input.attr('style','border: solid red 1px');
                            
                        }
                    }
                }],
          	});
        });

        $(document).on('click', '#finalizado', function() {
            id = $(this).attr('data-id');
            var user = $(this).attr('data-name');
            var msg = "Su pedido de "+nombreEmpresa+" está listo. Ya puedo pasar a recogerlo.";
            BootstrapDialog.confirm({
				title: 'Finalizar pedido',
				message: 'Se cambiará el estado del pedido seleccionado a finalizado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
						$.ajax({
							url: base_url+'index.php/Pedidos/finalizarPedido/',
							type:'POST',
							data: {id:id},
							beforeSend: function(){
								$('#load').show();
							},
							success: function() {
                                obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
                                sendNotification(user, msg, id, 1);
                                $('#infoPedido').fadeOut('slow');
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

        $(document).on('click', '#enproceso', function() {
            id = $(this).attr('data-id');
            BootstrapDialog.confirm({
				title: 'Pedido en proceso',
				message: 'Se cambiará el estado del pedido seleccionado a En proceso ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
						$.ajax({
							url: base_url+'index.php/Pedidos/enproceso/',
							type:'POST',
							data: {id:id},
							beforeSend: function(){
								$('#load').show();
							},
							success: function(data) {
                                data = JSON.parse(data);
                                if(!data['exito']) {
                                    BootstrapDialog.show({
                                        title: 'Aviso',
                                        message: data['msg'],
                                        type: BootstrapDialog.TYPE_DANGER,
                                        buttons: [{ //agrega los botones del modal
                                            label: 'Cerrar',
                                            cssClass: 'btn-default',
                                            action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                                                dialogItself.close();
                                            },
                                        }]
                                    });
                                }
                                $('#infoPedido').fadeOut('slow');
                                obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
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

        $(document).on('click', '#informacion', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url: base_url+'index.php/Pedidos/informacionPedido/',
                data: {id:id},
                type: 'POST',
                success: function(data) {
                    data = JSON.parse(data);
                    if(data) {
                        infopedido(data);
                        $('#infoPedido').fadeIn('slow');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
					console.log('error::'+errorThrown);
				},
            });
        });

        function obtenerPedidos(id) {
            $.ajax({
                url: base_url+'index.php/Pedidos/obtenerPedidos/',
                type: 'POST',
                beforeSend: function(){
                    $('#load').show();
                },
				success: function(data) {
                    data = JSON.parse(data);
					dibujarPedidos(data);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log('error::'+errorThrown);
				},
                complete:function(){
                    $('#load').hide();
                }
            });
        }
        function dibujarPedidos(data) {
            var divPedido = '';
            divPedido += '<div class="row">';
            divPedido += '<b class="col-xs-4">Nombre</b>';
            divPedido += '<b class="col-xs-4 text-center">Estado</b>';
            divPedido += '<b class="col-xs-2 text-right">Entregar</b>';
            divPedido += '<b class="col-xs-2 text-right">Detalles</b>';
            divPedido += '</div>';
            divPedido += '<br>';
            data.forEach(function(pedido, index){
                divPedido += '<div class="row">';
                divPedido +=    '<div class="col-xs-4" style="word-wrap: break-word">';
                divPedido +=        '<p>'+pedido['nombre']+'</p>';
                divPedido +=    '</div>';
                divPedido +=    '<div class="col-xs-4 text-center">';
                switch(pedido['estatus']) {
                    case 'Solicitado':
                        divPedido +=        '<label class="label label-warning">'+pedido['estatus']+'</label>';
                        break;
                    case 'En proceso':
                        divPedido +=        '<label class="label label-info">'+pedido['estatus']+'</label>';
                        break;
                    case 'Realizado':
                        divPedido +=        '<label class="label label-success">'+pedido['estatus']+'</label>';
                        break;
                    default:
                        break;
                }
                divPedido +=    '</div>';
                divPedido +=    '<a  class="col-xs-2 pull-left" ><span id="entregar" data-name="'+pedido['usuario']+'" data-id="'+pedido['id']+'" class="mano fa fa-check-square-o" style="font-size: 20px; color: green"></span></a>';
                divPedido +=    '<a  class="col-xs-2 pull-left" ><span id="informacion" data-id="'+pedido['id']+'" class="mano fa fa-plus" style="font-size: 20px; color: #f6032f"></span></a>';
                divPedido += '</div>'
            });
            $('#divPedido').html('');
            $('#divPedido').html(divPedido);
        }

        function infopedido(data) {
            var divInfo = '';
            divInfo += '<div class="box box-solid">'
            divInfo += '    <div class="box-header with-border" style="background-color: #f6032f">'
            divInfo += '        <h3 class="box-title col-xs-4" style="color:white">Pedido</h3>'
            divInfo += '        <h3 class="box-title col-xs-8 text-right" style="color:white; word-wrap: break-word">Cliente: '+data[0]['nombre']+'</h3>'
            divInfo += '    </div>'
            divInfo += '    <div class="box box-body">'
            divInfo += '<div class="row">'
            divInfo += '    <b class="col-xs-2 col-xs-offset-1">Cantidad</b>'
            divInfo += '    <b class="col-xs-6">Producto</b>'
            divInfo += '    <b class="col-xs-3">Precio</b>'
            divInfo += '</div>'
            divInfo += '<br>';
            data.forEach(function(pedido, index){
                divInfo += '<div class="row">'
                divInfo += '    <p class="col-xs-2 col-xs-offset-1">· '+pedido['cantidad']+'</p>'
                divInfo += '    <p class="col-xs-6">'+pedido['productoNombre']+'</p>'
                divInfo += '    <p class="col-xs-3">'+pedido['precio']+'</p>'
                divInfo += '</div>'
            });
            divInfo += '        <div class="row">'
            if(data[0].estatus == 'Realizado') {
                divInfo += '            <b class="col-xs-6 col-xs-offset-6 text-center">Total: $ '+data[0]['total']+'</b>'
            }
            else if(data[0].estatus == 'En proceso') {
                divInfo += '            <div class="col-sm-6">'
                divInfo += '                <button type="button" id="cancelar" data-id='+data[0]['id']+' data-name="'+data[0]['usuario']+'" class="btn btn-default btn-sm">Cancelar</button>'
                divInfo += '                <button type="button" id="finalizado" data-id='+data[0]['id']+' data-name="'+data[0]['usuario']+'" class="btn btn-rojo btn-sm">Finalizado</button>'
                divInfo += '            </div>'
                divInfo += '            <b class="col-xs-6 text-center">Total: $ '+data[0]['total']+'</b>'
            }
            else {
                divInfo += '            <div class="col-sm-6">'
                divInfo += '                <button type="button" id="cancelar" data-id='+data[0]['id']+' data-name="'+data[0]['usuario']+'" class="btn btn-default btn-sm">Cancelar</button>'
                divInfo += '                <button type="button" id="enproceso" data-id='+data[0]['id']+' data-name="'+data[0]['usuario']+'" class="btn btn-primary btn-sm">En proceso</button>'
                divInfo += '            </div>'
                divInfo += '            <b class="col-xs-6 text-center">Total: $ '+data[0]['total']+'</b>'
            }
            divInfo += '        </div>'
            divInfo += '    </div>'
            divInfo += '</div>'
            $('#infoPedido').html('');
            $('#infoPedido').html(divInfo);
        }
        /**
            user = nombre de usuario
            msg = Mensaje
            id_pedido = id del pedido
            type: 
                1: Pedido listo
                2: Pedido entregado
                3: pedido cancelado
         */
        function sendNotification(user, msg, id_pedido, type){
            $.ajax({
                url: base_url+'index.php/Api/send_notif/',
                type:'POST',
                data: {user:user, msg:msg, type: type, id_pedido: id_pedido, id_empresa: <?php echo $this->session->idEmpresa;?>},
                success: function() {
                    console.log("Notificación enviada")
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error::'+errorThrown);
                },
            });
        }
    });

</script>

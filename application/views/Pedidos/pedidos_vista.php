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
                            <h3 class="box-title" style="color:white">Lista de pedidos</h3>
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
<script>
    $(document).ready(function(){

        obtenerPedidos(<?php echo $this->session->idEmpresa;?>);

        $(document).on('click', '#cancelar', function() {
            id = $(this).attr('data-id');
            BootstrapDialog.confirm({
				title: 'Cancelar pedido',
				message: 'Se cambiará el estado del pedido seleccionado a cancelado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
						$.ajax({
							url: base_url+'index.php/Pedidos/cancelarPedido/',
							type:'POST',
							data: {id:id},
							beforeSend: function(){
								$('#load').show();
							},
							success: function() {
                                obtenerPedidos(<?php echo $this->session->idEmpresa;?>);
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

        $(document).on('click', '#finalizado', function() {
            id = $(this).attr('data-id');
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
            data.forEach(function(pedido, index){
                divPedido += '<div class="row">';
                divPedido +=    '<p class="col-xs-2 col-xs-offset-1">'+pedido['id']+'</p>';
                divPedido +=    '<p class="col-xs-3">'+pedido['nombre']+'</p>';
                divPedido +=    '<p class="col-xs-3">'+pedido['estatus']+'</p>';
                divPedido +=    '<a  id="informacion" data-id="'+pedido['id']+'"class="col-xs-1 col-xs-offset-1 text-middle" ><span class="fa fa-plus" style="font-size: 20px; color: #f6032f"></span></a>';
                divPedido += '</div>'
            });
            $('#divPedido').html('');
            $('#divPedido').html(divPedido);
        }

        function infopedido(data) {
            var divInfo = '';
            divInfo += '<div class="box box-solid">'
            divInfo += '    <div class="box-header with-border" style="background-color: #f6032f">'
            divInfo += '        <h3 class="box-title col-xs-4" style="color:white">Pedido '+data[0]['id']+'</h3>'
            divInfo += '        <h3 class="box-title col-xs-8 text-right" style="color:white">Cliente: '+data[0]['nombre']+'</h3>'
            divInfo += '    </div>'
            divInfo += '    <div class="box box-body">'
            data.forEach(function(pedido, index){
                divInfo += '<div class="row">'
                divInfo += '    <p class="col-xs-2 col-xs-offset-1">· '+pedido['cantidad']+'</p>'
                divInfo += '    <p class="col-xs-6">'+pedido['productoNombre']+'</p>'
                divInfo += '    <p class="col-xs-3">'+pedido['precio']+'</p>'
                divInfo += '</div>'
            });
            divInfo += '        <div class="row">'
            divInfo += '            <div class="col-xs-5">'
            divInfo += '                <button type="button" id="cancelar" data-id='+data[0]['id']+' class="btn btn-default btn-sm">Cancelar</button>'
            divInfo += '                <button type="button" id="finalizado" data-id='+data[0]['id']+' class="btn btn-rojo btn-sm">Finalizado</button>'
            divInfo += '            </div>'
            divInfo += '            <b class="col-xs-2 col-xs-offset-2">Total:</b>'
            divInfo += '            <b class="col-xs-3">$ '+data[0]['total']+'</b>'
            divInfo += '        </div>'
            divInfo += '    </div>'
            divInfo += '</div>'
            $('#infoPedido').html('');
            $('#infoPedido').html(divInfo);
        }

    });
</script>

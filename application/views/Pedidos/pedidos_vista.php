<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #f6032f">
                            <h3 class="box-title" style="color:white">Lista de pedidos</h3>
                        </div>
                        <div class="box box-body" id="divPedido">
                            <!--
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1"> 590</p>
                                <p class="col-xs-3">pepe</p>
                                <p class="col-xs-3">Soliciado</p>
                                <a href="" class="col-xs-1 col-xs-offset-1 text-middle" ><span class="fa fa-plus" style="font-size: 20px; color: #f6032f"></span></a>
                            </div>
                            -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="divPedido">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #f6032f">
                            <h3 class="box-title col-xs-4" style="color:white">Pedido #?</h3>
                            <h3 class="box-title col-xs-8 text-right" style="color:white">Cliente: Lorem ipsum dolor</h3>
                        </div>
                        <div class="box box-body">
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1">· 2</p>
                                <p class="col-xs-6">Café chico</p>
                                <p class="col-xs-3">$ 150.00</p>
                            </div>
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1">· 3</p>
                                <p class="col-xs-6">Café mediano</p>
                                <p class="col-xs-3">$ 150.00</p>
                            </div>
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1">· 1</p>
                                <p class="col-xs-6">Café grande,muy grande, demasiado grande</p>
                                <p class="col-xs-3">$ 150.00</p>
                            </div>
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1">· 6</p>
                                <p class="col-xs-6">Café premium</p>
                                <p class="col-xs-3">$ 150.00</p>
                            </div>
                            <div class="row">
                                <p class="col-xs-2 col-xs-offset-1">· 2</p>
                                <p class="col-xs-6">Café normal</p>
                                <p class="col-xs-3">$ 150.00</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <button class="btn btn-default btn-sm">Cancelar</button>
                                    <button class="btn btn-rojo btn-sm">Finalizado</button>
                                </div>
                                <b class="col-xs-2 col-xs-offset-2">Total:</b>
                                <b class="col-xs-3">$ 750.00</b>
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

        obtenerPedidos(<?php echo $this->session->idEmpresa;?>);

        $(document).on('click', '#informacion', function(){
            console.log($(this).attr('data-id'));
        });

        function obtenerPedidos(id) {
            $.ajax({
                url: base_url+'index.php/Pedidos/obtenerPedidos/'+<?php echo $this->session->idEmpresa;?>,
                data: id,
                type: 'POST',
                beforeSend: function(){
                    $('#load').show();
                },
				success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
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

    });
</script>

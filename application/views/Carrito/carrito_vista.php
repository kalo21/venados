
<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" id="contenedor">
                <!-- Pedidos por empresa -->
            </div>
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border" style="background-color: #f6032f">
                        <h3 class="box-title" style="color:white">Confirmación de pedidos</h3>
                    </div>
                    <div class="box box-body text-center">
                        <h3><strong class="col-xs-12">Total: $ <span id="total"></span></strong></h3>
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

        dibujarPedidos();

        $(document).on('click', '#confirmar', function() {
            $('.realizar').trigger('click');
        });

        $(document).on('click', '#cancelar', function() {
            var idEmpresa = $(this).parent().attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/cancelarPedido',
                type: 'POST',
                data: {idEmpresa:idEmpresa},
                success: function() {
                    location.reload();
                }
            });
        });

        $(document).on('click', '#realizar', function() {
            var idEmpresa = $(this).parent().attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/realizarPedido',
                type: 'POST',
                data: {idEmpresa:idEmpresa},
                success: function() {
                    location.reload();
                }
            });
        });

        $(document).on('click', '#eliminar', function() {
            var rowid = $(this).parent().attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/eliminarProducto/',
                type: "POST",
                data:{rowid:rowid},
                success: function() {
                    location.reload();
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

        function dibujarPedidos() {
            var data = <?php echo json_encode($this->cart->contents());?>;
            var contenedor = '';
            $.each(data, (function(index, producto) {
                if($('#'+producto.idEmpresa+'').length) {
                    contenedor += '        <div class="col-md-7 col-xs-8">';
                    contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                    contenedor += '            <p class="col-md-9 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut officia aliquid nihil quasi</p>';
                    contenedor += '        </div>';
                    contenedor += '        <div class="col-md-5 col-xs-4" data-id="'+producto.rowid+'">';
                    contenedor += '            <p class="col-md-5 col-xs-12 text-center text-success">$ '+producto.price+'</p>';
                    contenedor += '            <input type="number" min="1" class="form-group col-md-4 col-xs-12" value="'+producto.qty+'">';
                    contenedor += '            <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-3 col-xs-12 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                    contenedor += '        </div>';
                    $('#'+producto.idEmpresa+'').append(contenedor);
                    contenedor = '';
                }
                else {
                    contenedor += '<div class="col-md-12">';
                    contenedor += '    <div class="box box-solid">';
                    contenedor += '        <div class="box-header with-border" style="background-color: #f6032f">';
                    contenedor += '        <h3 class="box-title" style="color:white">Empresa: '+producto.idEmpresa+'</h3>';
                    contenedor += '    </div>';
                    contenedor += '    <div class="box box-body" id="'+producto.idEmpresa+'">';
                    contenedor += '        <div class="col-md-7 col-xs-8">';
                    contenedor += '            <p class="col-md-3">'+producto.name+'</p>';
                    contenedor += '            <p class="col-md-9 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut officia aliquid nihil quasi</p>';
                    contenedor += '        </div>';
                    contenedor += '        <div class="col-md-5 col-xs-4" data-id="'+producto.rowid+'">';
                    contenedor += '            <p class="col-md-5 col-xs-12 text-center text-success">$ '+producto.price+'</p>';
                    contenedor += '            <input type="number" min="1" class="form-group col-md-4 col-xs-12" value="'+producto.qty+'">';
                    contenedor += '            <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-3 col-xs-12 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                    contenedor += '        </div>';
                    contenedor += '    </div>';
                    contenedor += '    <div data-id="'+producto.idEmpresa+'" class="box box-footer">';
                    contenedor += '        <a id="cancelar" class="col-md-3 col-md-offset-6 col-xs-6" href="#">Cancelar pedido</a>';
                    contenedor += '        <a id="realizar" class="col-md-3 col-xs-6 realizar" href="#">Realizar pedido</a>';
                    contenedor += '    </div>';
                    contenedor += '</div>';
                    $('#contenedor').append(contenedor);
                    contenedor = '';
                }
            }));
            $('#total').html('<?php echo $this->cart->total();?>');
        }

    })
</script>


<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="row" id="">
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
            var rowid = $(this).attr('data-id');
            $.ajax({
                url: base_url+'index.php/Carrito/eliminarProducto/',
                type: "POST",
                data:{rowid:rowid},
                success: function() {
                    location.reload();
                }
            });
        });

        function dibujarPedidos() {
            var data = <?php echo json_encode($this->cart->contents());?>;
            var contenedor = '';
            $.each(data, (function(index, producto) {
                if($('#'+producto.idEmpresa+'').length) {
                    contenedor += '<div class="col-md-9">';
                    contenedor += '    <p class="col-md-2">'+producto.name+'</p>';
                    contenedor += '    <p class="col-md-7 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut officia aliquid nihil quasi, animi quam rerum expedita nisi, inventore veniam nemo et nesciunt molestiae iusto tempora a blanditiis pariatur!</p>';
                    contenedor += '    <p class="col-md-3 text-success text-center">$ '+producto.price+'</p>';
                    contenedor += '</div>';
                    contenedor += '<div class="col-md-3">';
                    contenedor += '    <input type="number" min="1" class="col-md-6 form-group" value="'+producto.qty+'">';
                    contenedor += '    <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-6 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                    contenedor += '</div>';
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
                    contenedor += '        <div class="col-md-9">';
                    contenedor += '            <p class="col-md-2">'+producto.name+'</p>';
                    contenedor += '            <p class="col-md-7 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut officia aliquid nihil quasi, animi quam rerum expedita nisi, inventore veniam nemo et nesciunt molestiae iusto tempora a blanditiis pariatur!</p>';
                    contenedor += '            <p class="col-md-3 text-success text-center">$ '+producto.price+'</p>';
                    contenedor += '        </div>';
                    contenedor += '        <div class="col-md-3">';
                    contenedor += '            <input type="number" min="1" class="form-group col-md-6" value="'+producto.qty+'">';
                    contenedor += '            <a href="#" id="eliminar" data-id="'+producto.rowid+'" class="col-md-6 text-center"><span class="fa fa-times" style="color:#f6032f"></span></a>';
                    contenedor += '        </div>';
                    contenedor += '    </div>';
                    contenedor += '    <div data-id="'+producto.idEmpresa+'" class="box box-footer">';
                    contenedor += '        <a id="cancelar" class="col-xs-3 col-xs-offset-6" href="#">Cancelar pedido</a>';
                    contenedor += '        <a id="realizar" class="col-xs-3 " href="#">Realizar pedido</a>';
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

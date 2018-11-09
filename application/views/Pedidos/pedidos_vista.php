<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
                <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de pedidos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <p class="col-xs-3">Pedido #527</p>
                                <p class="col-xs-4">kevin </p>
                                <p class="col-xs-4">Entregado</p>
                                <a class="align-middle"><span class="fa fa-plus fa-lg" style="color:#f6032f"></span></a>
                            </div>
                        </div>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                Pedido #2
                            </div>
                        </div>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                Pedido #3
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
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
                                <b class="col-xs-3">$ 900.00</b>
                            </div>
                        </div>
                    </div>
                </div>
		</div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>
<script>

</script>

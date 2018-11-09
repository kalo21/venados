<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
                <h2 class="page-header">Pedidos</h2>
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
                            <h4 class="box-title">
                                <a data-parent="#accordion" href="#">
                                Pedido #1
                                </a>
                            </h4>
                            </div>
                        </div>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-parent="#accordion" href="#">
                                Pedido #2
                                </a>
                            </h4>
                            </div>
                        </div>
                        <div class="box box-danger">
                            <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-parent="#accordion" href="#">
                                Pedido #3
                                </a>
                            </h4>
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
                    <div>
                    <h1>Hello, world!</h1>
                    <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    </div>
                </div>
		</div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>
<script>

</script>

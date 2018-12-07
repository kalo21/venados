<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>

<style>
    .btn-rojo{
        margin-bottom: 10px;
        float: right !important;
    }
    .col-xs-3 {
        padding-right:0px;
    }
    .encabezado {
        padding-top: 10px;
        padding-left: 0px;
        padding-right: 0px;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div style="display:flex; align-items:center; justify-content: center; height: 50px">
                    <p style="font-size:24px">Notificaciones</p>
                </div>
                <div id="contenedor" class="col-md-6 col-md-offset-3 text-center">
                    <!-- Pedidos -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

        obtenerNotificaciones();

        $(document).on('click', '#btnEliminar', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: base_url+'index.php/Notificaciones/eliminarNotificacion',
                type: 'POST',
                data: {id:id},
                success: function() {
                    $('#'+id+'').fadeToggle();
                }
            });
        });

        function obtenerNotificaciones() {
            $.ajax({
                url: base_url+'index.php/Notificaciones/obtenerNotificaciones',
                success: function(data) {
                    data = JSON.parse(data);
                    dibujarNotificaciones(data);
                }
            });
        }

        function dibujarNotificaciones(info) {
            contenedor = '';
            $.each(info, function(index, notificacion) {
                contenedor += '<div id="'+notificacion.id+'" class="col-xs-12" style="background-color: white; margin-bottom:10px">';
                contenedor += '    <strong class="encabezado col-xs-6 text-left">'+notificacion.titulo+'</strong>';
                contenedor += '    <p style="color: gray;" class="encabezado col-xs-6 text-right">'+notificacion.fecha.replace(/\-/g, '/')+'</p>';
                contenedor += '    <p class="col-md-xs text-justify">'+notificacion.mensaje+'</p>';
                contenedor += '    <div class="col-xs-3 col-xs-offset-9 pull-right">';
                contenedor += '        <button id="btnEliminar" data-id="'+notificacion.id+'" type="button" class="btn btn-rojo btn-sm">Eliminar</button>';
                contenedor += '    </div>';
                contenedor += '</div>';
            });
            $('#contenedor').html(contenedor);
        }
    });
</script>
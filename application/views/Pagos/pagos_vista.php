<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<style>

    .thumbnail {
        position: relative;
    }

    .caption {
        position: absolute;
        top: 35%;
        left: 0;
        width: 100%;
    }

    @media screen and (min-width: 768px) {
        .col-md-4 {
            width: calc(50% - 20px);
            margin-right: 10px;
            margin-left: 10px;
        }
    }

    @media screen and (min-width: 992px) {
        .col-md-4 {
            width: calc(33.3333% - 20px);
            margin-right: 10px;
            margin-left: 10px;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row" id="header">
            <!-- Encabezado -->
            </div>
            <div class="row form-group" id="contenedor">
            <!-- Contenidos -->
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

        obtenerEmpresas();

        $(document).on('click', '#pagar', function() {
        var id = $(this).parent().attr('data-id');
        var nombre = $(this).children().first().text();
            // id = $(this).attr('data-id');
            BootstrapDialog.show({
				title: nombre,
                message: `Se cambiará el saldo a la empresa Starbucks y se mostrará un recibo. ¿Deseas continuar?.<br>
                          <input type="number" class="form-control" id="monto" placeholder="Monto a pagar">`,
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
                        if(result) {
                            $.ajax({
                                url: base_url+'index.php/Pagos/pagarEmpresa/',
                                type:'POST',
                                data: {id:id, monto:$('#monto').val()},
                                beforeSend: function(){
                                    $('#load').show();
                                },
                                success: function(data) {
                                    data = JSON.parse(data);
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
                                    obtenerEmpresas();
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
                    }
                }],
          	});
        });


        function obtenerEmpresas() {
            $.ajax({
                url: base_url+'index.php/Pagos/obtenerEmpresas',
                success: function(data) {
                    if(data) {
                        data = JSON.parse(data);
                        dibujarEmpresas(data);
                    }
                }
            });
        }


        function dibujarEmpresas(info) {
            var contenedor = '';
            info.forEach(function(empresa, index) {
                contenedor += '<div style="height:182px" id="empresa" data-id="'+empresa['id']+'" class="thumbnail text-center col-md-4 col-sm-6">';
                contenedor += '<div style="height: 100%; width:100%; display:flex; justify-content: center; align-items:center">';
                contenedor += '    <img style="max-width:auto; max-height: 172px" class="img-responsive" src="'+base_url+empresa['img_fondo']+'" alt="">';
                contenedor += '</div>';
                contenedor += '    <div id="pagar" class="mano caption" style="background-color: rgba(0,0,0,0.6)">';
                contenedor += '        <strong id="nombre" style="color:white">'+empresa['nombre']+'</strong>';
                contenedor += '        <br>';
                contenedor += '        <strong style="color:white">$ '+empresa['saldo']+'</strong>';
                contenedor += '    </div>';
                contenedor += '</div>';
            });
            $('#contenedor').html(contenedor);
            $('#header').html('<div style="height:56.4px; display: flex; align-items: center; justify-content: center"><strong style="font-size:24px">Empresas</strong></div>');
        }

        
            
            
        

    });
</script>
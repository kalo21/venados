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

        $(document).on('click', '#regresar', function() {
            obtenerEmpresas();
        });

        $(document).on('click', '#empresa', function() {
            idEmpresa = $(this).attr('data-id');
            $.ajax({
                url: base_url+'index.php/Tiendas/productos/'+idEmpresa,
                success: function(data) {
                    if(data) {
                        data = JSON.parse(data);
                        dibujarProductos(data);
                    }
                }
            });
        });

        $(document).on('click', '#infoProducto', function() {
            var idProducto = $(this).attr('data-id');
            BootstrapDialog.show({
                title: 'Producto', // Aquí se pone el título
				size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
				message: function(dialog) { 
					var $message = $('<div></div>');
					var pageToLoad = dialog.getData('pageToLoad');
					$message.load(pageToLoad); //Cargamos la vista
					return $message;
				},
				data: {
					'pageToLoad': base_url+'index.php/Tiendas/infoProducto/'+idProducto
				},
				buttons: [{ //agrega los botones del modal
					label: 'Cerrar',
					cssClass: 'btn-default',
					action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						dialogItself.close();
					},

				},
                {	 //agrega los botones del modal
				  	label: 'Comprar',
				  	cssClass: 'btn-rojo',
                  	action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
                    var cantidad = parseInt($('#cantidad').text()); 
                    var nombre = $('#nombreProducto').text();
                    var precio = parseFloat($('#precio').text());
                    var descripcion = $('#descripcion').text();
                    console.log(precio);
                    $.ajax({
                        url: base_url+'index.php/Tiendas/agregarCarrito',
                        type: 'POST',
                        data: {idProducto:idProducto, descripcion:descripcion, cantidad:cantidad, nombre:nombre, precio:precio, idEmpresa:idEmpresa},
                        success: function(data) {
                            if(data) {
                                data = JSON.parse(data);
                                console.log(data);
                                dialogItself.close();
                            }
                        },
                    });
					},
			  	}]
            });
        });

        function obtenerEmpresas() {
            $.ajax({
                url: base_url+'index.php/Tiendas/obtenerEmpresas',
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
                contenedor += '<div style=" height:182px" id="empresa" data-id="'+empresa['id']+'" class="mano thumbnail text-center col-md-4 col-sm-6">';
                contenedor += '<div style="height: 100%; width:100%; display:flex; justify-content: center; align-items:center">';
                contenedor += '    <img style="max-width:auto; max-height: 172px" class="img-responsive" src="'+base_url+empresa['img_fondo']+'" alt="">';
                contenedor += '</div>';
                contenedor += '    <div class="caption" style="background-color: rgba(0,0,0,0.6)">';
                contenedor += '        <strong style="color:white">'+empresa['nombre']+'</strong>';
                contenedor += '        <br>';
                contenedor += '        <strong style="color:white">'+empresa['descripcion']+'</strong>';
                contenedor += '    </div>';
                contenedor += '</div>';
            });
            $('#contenedor').html(contenedor);
            $('#header').html('<div style="height:56.4px; display: flex; align-items: center; justify-content: center"><strong style="font-size:24px">Empresas</strong></div>');
        }
        
        function dibujarProductos(info) {
            var contenedor = '';
            info.forEach(function(producto, index) {
                contenedor += '<div id="infoProducto" data-id="'+producto['id']+'" class="mano thumbnail text-center col-md-4 col-sm-6">';
                contenedor += '<div style="display:flex; justify-content: center; align-items:center">';
                contenedor += '   <img style="max-width: auto; max-height:175px" class="img-responsive" src="'+base_url+producto['imagen']+'" alt="">'
                contenedor += '</div>';
                contenedor += '   <div class="row-fluid" style="padding-top: 3%">';
                contenedor += '       <div class="col-md-7 col-xs-6 text-left">';
                contenedor += '           <strong>'+producto['nombre']+'</strong>';
                contenedor += '       </div>';
                contenedor += '       <div class="col-md-4 col-xs-6 col-xs-offset-1">';
                contenedor += '           <p class="text-success">$ '+producto['precio']+'</p>';
                contenedor += '       </div>';
                contenedor += '   </div>';
                contenedor += '   <div class="row-fluid text-left">';
                contenedor += '       <p style="text-overflow: ellipsis; width: 100%; overflow:hidden; white-space: nowrap; display:block; padding-left:5%; padding-right:1%">'+producto['descripcion']+'</p>';
                contenedor += '   </div>';
                contenedor += '</div>';
            });
            $('#contenedor').html(contenedor)
            var encabezado = '';
            encabezado += '<div style="height: 56.4px; display: flex; align-items: center">';
            encabezado += '<a class="col-xs-2"><label id="regresar" class="mano fa fa-arrow-left" style="color:black; font-size: 24px; "></label></a>';
            encabezado += '<strong style="font-size:24px" class="col-xs-2 col-xs-offset-3">Productos</strong>';
            encabezado += '</div>';
            $('#header').html(encabezado);
        }
    });
</script>

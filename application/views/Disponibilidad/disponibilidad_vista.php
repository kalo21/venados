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
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Productos</h3>
            </div>
            <div class="row-fluid" id="divProductos">
                <!-- Productos -->
        </div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>

<script>
    $(document).ready(function() {

        obtenerProductos();

        function obtenerProductos() {
            $.ajax({
                url: base_url+'index.php/Disponibilidad/obtenerProductos',
                success: function(data) {
                    if(data) {
                        data = JSON.parse(data);
                        console.log(data);
                        dibujarProductos(data);
                    }
                }
            });
        }

        $(document).on("click", "#cambiarEstado", function () {
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');  
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se cambiará el estatus del producto seleccionado ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
						$.ajax({
							url: base_url+'index.php/Disponibilidad/cambiarEstado/',
							type:'POST',
							data: {
								id:id,
								estatus:estatus
							},
							beforeSend: function(){
								$('#load').show();
							},
							success: function() {
								obtenerProductos();
								/*BootstrapDialog.show({
									title: 'No se actualizó',
									message: 'No se modificó el estatus del perfil seleccionado'
								});*/
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

        function dibujarProductos(data) {
            var divProductos = '';
            data.forEach(function(producto, index){
                divProductos += '<div id="cambiarEstado" data-estatus="'+producto['estatus']+'" data-id="'+producto['id']+'" class="thumbnail text-center col-md-4">';
                divProductos += '   <img style="max-width: 312px; max-height:236px" class="img-responsive" src="'+base_url+producto['imagen']+'" alt="">'
                if(producto['estatus'] == 0) {
                    divProductos += '   <div class="caption" style="background-color: rgba(246,3, 47)">';
                    divProductos += '       <strong style="color:white">NO DISPONIBLE</strong>';
                }
                else {
                    divProductos += '   <div class="caption" style="background-color: rgba(0,188, 91)">';
                    divProductos += '       <strong style="color:white">DISPONIBLE</strong>';
                }
                divProductos += '   </div>';
                divProductos += '   <div class="row-fluid" style="padding-top: 3%">';
                divProductos += '       <div class="col-xs-7 text-left">';
                divProductos += '           <strong>'+producto['nombre']+'</strong>';
                divProductos += '       </div>';
                divProductos += '       <div class="col-xs-4 col-xs-offset-1">';
                divProductos += '           <p class="text-success">$ '+producto['precio']+'</p>';
                divProductos += '       </div>';
                divProductos += '   </div>';
                divProductos += '   <div class="row-fluid text-left">';
                divProductos += '       <p style="text-overflow: ellipsis; width: 100%; overflow:hidden; white-space: nowrap; display:block; padding-left:5%; padding-right:1%">'+producto['descripcion']+'</p>';
                divProductos += '   </div>';
                divProductos += '</div>';
            });
            $('#divProductos').html('');
            $('#divProductos').html(divProductos);
        }

    });
</script>

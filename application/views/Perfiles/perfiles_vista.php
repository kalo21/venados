<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
	<section class="content">
  		<div class="container-fluid">
  			<div class="row">
  				<h3 class="text-center">Perfiles</h3>
  			</div>
  			<div class="row">
  				<div class="col-xs-3">
					<select name="" id="opciones" class="form-control">
						<option value="-1">Todos</option>
						<option value="1">Activos</option>
						<option value="0">Inactivos</option>
					</select>
  				</div>
  			</div>
  			<br>
  			<div class="row">
				<div class="col-xs-12">
				    <div class="box box-danger">
					    <div class="box-header">
					        <h3 class="box-title">Listado de perfiles</h3>
					    </div>
					<!-- /.box-header -->
					    <div class="box-body table-responsive no-padding">
					        <table id="tabla" class="table table-hover">
					  	        <thead>
							        <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th style='text-align:center'>Modificar</th>
                                        <th style='text-align:center'>Activar/Desactivar</th>
							        </tr>
					  	        </thead>
					  	        <tbody>
							    <!-- /Contenido de la tabla -->
					  	        </tbody>
					        </table>
					    </div>
					    <!-- /.box-body -->
				        <div class="box-footer">
						    <div class="row-fluid pull-right">
							    <button type="button" id="btnAgregar" class="btn btn-rojo">Agregar</button>
						    </div>
					    </div>
				    </div>
				  <!-- /.box -->
				</div>
			</div>
		</div>
	</section>
</div>
<!--hola-->

<?php $this->load->view('Global/footer'); ?>

<!---------------------------------------------------------------------------------------------------------->

<script>
	$(document).ready(function(){

        /* paginado de la tabla */
		var tabla = insertarPaginado('tabla');
		obtenerDatos($('#opciones').val());
        function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Perfiles/obtenerPerfil/'+estatus,
				type:'POST',
                beforeSend: function(){
                    $('#load').show();
                },
				success: function(data) {
					data = JSON.parse(data);
					if(!data){
						tabla.clear().draw();
					}
					else {
						dibujarTabla(data);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log('error::'+errorThrown);
				},
                complete:function(){
                    $('#load').hide();
                }
			});
		}

        /*selector de cambio de estado  */
		$('#opciones').change(function(){
			obtenerDatos($('#opciones').val());
		});

        /* cambiar estado */
		$(document).on("click", "#cambiarEstado", function () {
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');  

            /* modal */
            BootstrapDialog.confirm({
                title: 'Advertencia',
                message: 'Se cambiará el estatus del perfil seleccionada ¿Desea continuar?',
                //type: BootstrapDialog.TYPE_DANGER, 
                btnCancelLabel: 'Cancelar', 
                btnOKLabel: 'Continuar', 
                btnOKClass: 'btn-rojo', 
                callback: function(result) {
                    if(result){
                        /* cambio de estado ajax */
                        $.ajax({
                            url: base_url+'index.php/Perfiles/cambiarEstado/',
                            type:'POST',
                            data: {
                                id:id,
                                estatus:estatus
                            },
                            beforeSend: function(){
                                $('#load').show();
                            },
                            success: function(info) {
                                info =  JSON.parse(info);
                            
                                if(info['exito']){
                                    obtenerDatos($('#opciones').val());
                                }
                                else{
                                    BootstrapDialog.show({
                                        title: 'No se actualizó',
                                        message: info['msg']
                                    });
                                    obtenerDatos($('#opciones').val());
                                }
                                
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


		$(document).on("click", "#modificar", function () {
			BootstrapDialog.show({
                title: 'modificar Perfil', // Aquí se pone el título
                size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
                message: function(dialog) { 
                    var $message = $('<div></div>');
                    var pageToLoad = dialog.getData('pageToLoad');
                    $message.load(pageToLoad); //Cargamos la vista
                    return $message;
                },
                data: {
                  'pageToLoad': base_url+'index.php/Perfiles/modificar/'
                },
                buttons: [{ //agrega los botones del modal
                    label: 'Cancelar',
                    cssClass: 'btn-default',
                    action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    dialogItself.close();
                    },
                },
                { //agrega los botones del modal
                    label: 'Guardar',
                    cssClass: 'btn-rojo',
                    action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK              
                    dialogItself.close();   
                    },
                }]
            });
    	});
     

		$('#btnAgregar').click(function() {
			BootstrapDialog.show({
                title: 'Agregar Perfil', // Aquí se pone el título
                size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
                message: function(dialog) { 
                    var $message = $('<div></div>');
                    var pageToLoad = dialog.getData('pageToLoad');
                    $message.load(pageToLoad); //Cargamos la vista
                    return $message;
                },
                data: {
                  'pageToLoad': base_url+'index.php/Perfiles/agregar/'
                },
                buttons: [{ //agrega los botones del modal
                    label: 'Cancelar',
                    cssClass: 'btn-default',
                    action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    dialogItself.close();
                    },
                },
                { //agrega los botones del modal
                    label: 'Guardar',
                    cssClass: 'btn-rojo',
                    action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
                        var val = validar();
                        if(val){
                            $.ajax({
                                url: base_url+'index.php/Perfiles/agregarPerfil/',
                                type: 'POST',
                                data: $('#frmAgregarPerfil').serialize(),
                                beforeSend: function(){
                                    $('#load').show();
                                },
                                success: function (data) {
                                    $('#error').html(data);
                                    $('#error').show();
                                    obtenerDatos($('#opciones').val());
                                    $('#frmAgregarPerfil')[0].reset();
                                    dialogItself.close();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('error::'+errorThrown);
                                },
                                complete: function(){
                                    $('#load').hide();
                                }
                            });
                        }  
                    },
                }]
            });
		});


		function validar(info="Campo requerido"){
            var x = 0;
            $.each($('#frmAgregarPerfil').serializeArray(),function(index, item){
                console.log(this['name']);
                if(this['value']== "" )  {
                    console.log('entro');
                    $('#'+this['name']).addClass('is-invalid');
                    $('#'+this['name'] ).siblings().show();
                    $('#'+this['name'] ).siblings().html(info);
                    x = 1;
                }                                                     
            });
            if(x==0){
                return true;
            }else{
                return false;
            }
        }


		function dibujarTabla(info) {
			tabla.clear().draw();
			$.each(info, function(index, item){
				var output = null;
				var output2 = null;
				if(item['estatus'] == '0') {
					output = "<small class='label label-danger'>Inactivo</small>";
					output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-plus-circle fa-sm fa-2x fa-lg'></i>";
				}
				else if(item['estatus'] == '1') {
					output = "<small class='label label-success'>Activo</small>";
					output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-minus-circle fa-sm fa-2x fa-lg'></i>";
				}
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['descripcion'],
					output,
					"<i id='modificar' class='fa fa-edit fa-sm fa-2x fa-lg'></i>",
					output2
				]).draw(false).node();
				$('td:eq(4)', fila).attr('class', 'text-center');
				$('td:eq(5)', fila).attr('class', 'text-center');
			});
		}
	});

</script>
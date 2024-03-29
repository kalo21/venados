<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Perfiles</h3>
            </div>
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
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de Perfiles</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table id="tabla" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th style='text-align:center'>Estatus</th>
                                        <th style='text-align:center'>Modificar</th>
                                        <th style='text-align:center'>Activar/Desactivar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row-fluid pull-right">
                            <button type="button" id="btnAgregar" class="btn btn-rojo">Agregar</button>
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
		$('#opciones').change(function(){
			obtenerDatos($('#opciones').val());
		});
		$(document).on("click", "#cambiarEstado", function () {
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');  
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se cambiará el estatus del perfil seleccionado ¿Desea continuar?',
				//type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                if(result){
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
                            else {
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
			var id = $(this).attr('data-id');
			BootstrapDialog.show({
				
                title: 'Modificar Perfil', // Aquí se pone el título
				size: BootstrapDialog.SIZE_NORMAL, //Indica el tamaño
				message: function(dialog) { 
					var $message = $('<div></div>');
					var pageToLoad = dialog.getData('pageToLoad');
					$message.load(pageToLoad); //Cargamos la vista
					return $message;
				},
				data: {
					'pageToLoad': base_url+'index.php/Perfiles/formulario/'+id
				},
				buttons: [{ //agrega los botones del modal
					label: 'Cancelar',
					cssClass: 'btn-default',
					action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						dialogItself.close();
					},

				},
                {	 //agrega los botones del modal
				  	label: 'Guardar',
				  	cssClass: 'btn-rojo',
                  	action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
						$.ajax({
							url: base_url+'index.php/Perfiles/modificarPerfil/',
						  	type: 'POST',
						  	data: $('#frmAgregarPerfil').serialize()+'&id='+id+'&oldNombre='+$('#inpNombre').attr('data-id')+'&oldDescripcion='+$('#inpDescripcion').attr('data-descripcion'),
						  	beforeSend: function(){
							$('#load').show();
							},
							success: function (data) {
								data = JSON.parse(data);
								if(!data['exito']) {
									$('#error').html(data['msg']);
									$('#error').show();
								}
								else if(data['exito']) {
									obtenerDatos($('#opciones').val());
									$('#frmAgregarPerfil')[0].reset();
									dialogItself.close();
								}
						  	},
						  	error: function(jqXHR, textStatus, errorThrown) {
								console.log('error::'+errorThrown);
							},
							complete: function(){
								$('#load').hide();
						  	}
					  	});
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
					'pageToLoad': base_url+'index.php/Perfiles/formulario/'
				},
				buttons: [{ //agrega los botones del modal
					label: 'Cancelar',
					cssClass: 'btn-default',
					action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						dialogItself.close();
					},

				},
                {	 //agrega los botones del modal
				  	label: 'Guardar',
				  	cssClass: 'btn-rojo',
                  	action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
						$.ajax({
							url: base_url+'index.php/Perfiles/agregarPerfil/',
						  	type: 'POST',
						  	data: $('#frmAgregarPerfil').serialize(),
						  	beforeSend: function(){
							$('#load').show();
							},
							success: function (data) {
								data = JSON.parse(data);
								if(!data['exito']) {
									$('#error').html(data['msg']);
									$('#error').show();
								}
								else if(data['exito']) {
									obtenerDatos($('#opciones').val());
									$('#frmAgregarPerfil')[0].reset();
									dialogItself.close();
								}
						  	},
						  	error: function(jqXHR, textStatus, errorThrown) {
								console.log('error::'+errorThrown);
							},
							complete: function(){
								$('#load').hide();
						  	}
					  	});
					},
			  	}]
            });
		});
		function dibujarTabla(info) {
			tabla.clear().draw();
			$.each(info, function(index, item){
				var output = null;
				var output2 = null;
				if(item['estatus'] == '0') {
					output = "<small class='label label-danger'>Inactivo</small>";
					output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-plus-circle fa-sm fa-2x fa-lg mano'></i>";
				}
				else if(item['estatus'] == '1') {
					output = "<small class='label label-success'>Activo</small>";
					output2 = "<i style='color:#f6032f' data-id='"+item['id']+"' data-estatus='"+item['estatus']+"' id='cambiarEstado' class='fa fa-minus-circle fa-sm fa-2x fa-lg mano'></i>";
				}
				var fila = tabla.row.add([
					item['id'],
					item['nombre'],
					item['descripcion'],
					output,
					"<i id='modificar' data-id='"+item['id']+"' class='fa fa-edit fa-sm fa-2x fa-lg mano'></i>",
					output2+"&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' data-id='"+item['id']+"' class='btn btn-rojo btnModulos'>Módulos<i class='entypo-layout'></i> </button>"
				]).draw(false).node();
				$('td:eq(3)', fila).attr('class', 'text-center');
				$('td:eq(4)', fila).attr('class', 'text-center');
				$('td:eq(5)', fila).attr('class', 'text-center');
			});
		}
	});
	$('#tabla').delegate(".btnModulos","click", function(){
	      var dodo = $(this); //Acceder al contenido de la etiqueta 'a'
	      var actualid = dodo.data('id');
	      BootstrapDialog.show({
	          title: 'Modulos en el perfil', // Aquí se pone el título
	          size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
	          message: function(dialog) { 
	              var $message = $('<div></div>');
	              var pageToLoad = dialog.getData('pageToLoad');
	              $message.load(pageToLoad); //Cargamos la vista

	              return $message;
	          },
	          data: {
	              'pageToLoad': base_url+'index.php/Perfiles/agregarModulos_modal/'+actualid
	          },
	          buttons: [{ //agrega los botones del modal
	              label: 'Cerrar',
	              cssClass: 'btn-rojo',
	              action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
	                  dialogItself.close();
	              },

	          }]
	        });

	    });
</script>
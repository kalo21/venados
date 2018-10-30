<!-- MENU MENU MENU MENU MENU -->
  <?php $this->load->view('Global/header'); ?>
  <?php $this->load->view('Global/menu'); ?>
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<!-- El div con la clase content-wrapper segido de la etiqueta section
con la clase content es la estructura básica -->
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<blockquote style="border-left: 5px solid #2f4159">
					<h1 class="text-justify">Categorias</h1>
				</blockquote>
			</div>
			<div class="row">
				<div class="col-md-4">
					<select name="estado" id="estado" class="form-control">
						<option value="3">Seleccione una opción</option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-graduation-cap"></i> Listado de categorias</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><li class="fa fa-minus"> </li></button>
						</div>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="tabla" class="table table-striped no-margin" style="width: 100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Estatus</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody id="contenidoTabla">
									
								</tbody>
							</table>
							<button type="button" class="btn btn-primary btn-lg" id="agregarCategoria" style="background-color: #264d78">Agregar categoria</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> <!-- /.content -->
</div>

<?php $this->load->view('Global/footer')?>

<script>
	var avisoCargando = new BootstrapDialog({
		title: 'Cargando',
		closable: false,
		message: 'Por favor espere, cargando la información'
	});

	var x = $('#estado').val();
	obtenerDatos(x);
	//console.log(x);
	//Declaro la tabla 
	var tabla = insertarPaginado("tabla",10,true);

	function obtenerDatos(estatus){
		$.ajax({
			url:base_url+'index.php/Administrador/obtenerCategorias/'+estatus,
			type: 'POST',
			beforeSend: function(){
				avisoCargando.open();
			},
			success:function(respuesta){
				respuesta = JSON.parse(respuesta);
				// console.log(respuesta);
				var x = "";
				var varStatus = '';
				var ac = '';
				//Borrar contenido de tabla
				tabla.clear().draw();
				$.each(respuesta,function(index, item){
					if(item['estatus'] == '0'){
						ac = 'Inactivo';
						varStatus = "<a href='#' class='cambiarEstatus' data-id="+item['id']+" data-actual="+item['estatus']+" ><span class='fa fa-toggle-off' style='font-size: 2.3em; color: #264d78;'></span></a>";
					}
					else if(item['estatus'] == '1'){
						ac = 'Activo';
						varStatus = "<a href='#' class='cambiarEstatus' data-id="+item['id']+" data-actual="+item['estatus']+" ><span class='fa fa-toggle-on' style='font-size: 2.3em; color: #264d78;'></span></a>";
					}
					//Agregar nueva fila
					var fila = tabla.row.add([
							item['id'], // una celda
							item['descripcion'],
							ac,
							"<a href='#' class = 'editarCategoria' data-id="+item['id']+"><span class = 'fa fa-edit' style='font-size: 2.3em; color: #264d78'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+varStatus+'&nbsp;&nbsp;&nbsp;&nbsp;'
						]).draw(false).node();
					$('td:eq(0)', fila).attr('id', item['id']);
				});
			}, error: function(jqXHR, textStatus, errorThrown){
				console.log('error::'+errorThrown);
			},
			complete: function(){
				avisoCargando.close();
			}
		});
	}

	$('#contenidoTabla').delegate('.editarCategoria', 'click', function(){
		var dodo = $(this); // Acceddr al contenido de la etiqueta 'a'
		var actualid = dodo.data('id');
		BootstrapDialog.show({
			title: 'Editar categoria', // Aqui se pone el titulo
			size: BootstrapDialog.SIZE_WIDE,
			message: function(dialog){
				var $message = $('<div>','</div>');
				var pageToLoad = dialog.getData('pageToLoad');
				$message.load(pageToLoad); //Cargamos la vista
				return $message;
			},
			data: {
				'pageToLoad': base_url+'index.php/administrador/formularioCategorias/'+actualid
			},
			buttons: [{
					label: 'Cancelar',
					cssClass: 'btn-danger',
					action: function(dialogItself) {
						// Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						dialogItself.close();
					}
				},
				{ //agrega los botones del modal
					label: 'Guardar',
					cssClass: 'btn-primary',
					action: function(dialogItself){
						// Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						//Obtendremos la informacion desde php que contiene el formulario
						var descripcionVieja = $('#txtnombre').data('info');
						var descripcion = $('#txtnombre').val();
						var id = $('#txtnombre').data('id');
						//Terminamos de obtener la informacion desde php
						if (descripcion != descripcionVieja) {
							//Comparamos si se hizo un cambio con la informacion que ya se tenia
							BootstrapDialog.confirm({
								title: 'informacion',
								message: 'La siguiente categoria sera modificada ¿Desea continuar?',
								//type: BootstrapDialog.TYPE_INFO, 
								btnCancelLabel: 'Cancelar',
								btnOKLabel: 'Continuar',
								btnOKClass: 'btn-info', 
								callback: function(result){
									if (result) {
										var formData = new FormData($('#formulario')[0]);
										formData.append('id', id);
										formData.append('devieja', descripcionVieja);
										$.ajax({
											url:base_url+"index.php/Administrador/editarCategoria",
											type:"POST",
											data:formData,
											cache:false,
											contentType:false,
											processData:false,
											beforeSend: function(){
												avisoCargando.open();
											},
											success:function(respuesta){
												switch(parseInt(respuesta)){
													case 1: 
														var x = $("#estado").val();
														obtenerDatos(x);
														dialogItself.close();
													break;
													case 0:
														BootstrapDialog.show({
                                                 			title: 'Error',
                                                			message: 'Ups. Ha ocurrido un error, Se va a recargar la pagina.',
                                                			closable: false
                                            			});
                                            			setTimeout(function(){
                                            				window.location.href = base_url+'index.php/Administrador/categorias'
                                            			},1000);
                                            			$('#txtnombre').val('');
                                            		break;
                                            		case 2:
                                            			BootstrapDialog.alert({
                                            				title: 'Error',
                                            				message: 'El nombre '+$('#txtnombre').val()+' ya existe. Por favor, ingrese uno diferente'
                                            			});
                                            		default :
                                            			$('#msg-error').show();
				                                		$('.list-errors').html(respuesta);
				                                	break;
												}
											}, error:function(jqXHR, textStatus, errorThrown){
												console.log('error:: '+ errorThrown);
											},
											complete: function(){
												avisoCargando.close();
											}
										});
									}
								}
							});
						}else{
							BootstrapDialog.alert({
								title: 'Modificar al menos un campo',
								message: 'Para editar una carrera, debe cambiar al menos un campo',
							});
						}

					},
				}
			]
		});
	});

	$('#agregarCategoria').click(function(){
		BootstrapDialog.show({
			title: 'Nueva categoria', // Aquí se pone el titulo
			size: BootstrapDialog.SIZE_WIDE, // Indica el tamaño
			message: function(dialog){
				var $message = $('<div></div>');
				var pageToLoad = dialog.getData('pageToLoad');
				$message.load(pageToLoad); // Cargamos la vista

				return $message;
			},
			data: {
				'pageToLoad': base_url+'index.php/administrador/formularioCategorias'
			},
			buttons:[{ // Agregamos los botones
					label: 'Cancelar',
					cssClass: 'btn-danger',
					action: function(dialogItself){
						// Funciones del boton del modal. El atributo es obligatorio para correrlo
						dialogItself.close();
					},
				},
				{ // Agrega los botones del modal
					label: 'Guardar',
					cssClass: 'btn-primary',
					action: function(dialogItself){
						// Funciones del boton del modal. El atributo es obligatorio para cerrarlo
						var formData = new FormData($('#formulario')[0]);
						$.ajax({
							url:base_url+"index.php/Administrador/agregarCategoria",
							type: 'POST',
							data:formData,
							cache:false,
							contentType: false,
							processData: false,
							beforeSend: function(){
								avisoCargando.open();
							},
							success: function(respuesta){
								switch(parseInt(respuesta)){
									case 1:
										var x = $('#estado').val();
										obtenerDatos(x);
										dialogItself.close();
									break;
									case 0: 
										BootstrapDialog.show({
											title: 'Error',
											message: 'Ups ha surgido un error. Recargar la pagina'
										});
									break;
									case 2: 
										BootstrapDialog.alert({
											title: 'Error',
											message: 'El nombre '+$('#txtnombre').val()+' ya exsiste. Por favor '
										});
										$('#txtnombre').val('');
									break;
									default :
										$('#msg-error').show();
										$('.list-errors').html(respuesta);
								}
							}, error:function(jqXHR, textStatus, errorThrown){
								console.log('error:: '+ errorThrown);
							},
							complete: function(){
								avisoCargando.close();
							}
						});
					}
				}
			]
		});
	});
</script>
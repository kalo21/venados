<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Empresas</h3>
            </div>
        </div>
        <div class="row">
  			<div class="col-xs-3 col-md-offset-1">
				<select name="" id="opciones" class="form-control">
					<option value="-1">Todos</option>
					<option value="1">Activos</option>
					<option value="0">Inactivos</option>
				</select>
  			</div>
  		</div>
  		<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Listado de Empresas</h3>
						<div class="box-tools pull-right">
							 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
					 	<div class="box-body table-responsive no-padding">
						 	<table id="tabla" class="table table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th style='text-align:center'>Logotipo</th>
										<th style='text-align:center'>Estatus</th>
										<th style='text-align:center'>Ver Mas</th>
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

<?php $this->load->view('Global/footer')?>
<script>
	$(document).ready(function(){
        var cambio = 0;
		var cambioV = 0;
		var tabla = insertarPaginado('tabla');
		obtenerDatos($('#opciones').val());
        
		$('#opciones').change(function(){
			obtenerDatos($('#opciones').val());
		});
        
        $(document).on("change", "#foto", function () {
			cambio++;
		});
		$(document).on("change", "#fotoV", function () {
			cambioV++;
		});
        
		$(document).on("click", "#cambiarEstado", function () {
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');  
            BootstrapDialog.confirm({
				title: 'Advertencia',
				message: 'Se cambiará el estatus de la empresa seleccionada ¿Desea continuar?',
				type: BootstrapDialog.TYPE_DANGER, 
				btnCancelLabel: 'Cancelar', 
				btnOKLabel: 'Continuar', 
				btnOKClass: 'btn-rojo', 
				callback: function(result) {
                	if(result){
                     	$.ajax({
							url: base_url+'index.php/Empresa/cambiarEstado/',
							type:'POST',
                        	data: {
								id:id,
								estatus:estatus
                        	},
                        	beforeSend: function(){
                            	$('#load').show();
                        	},
                        	success: function() {
                            	obtenerDatos($('#opciones').val());
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

        $('#btnAgregar').click(function() {
			BootstrapDialog.show({
                title: '<b>Agregar Empresa</b>(1/3 - Usuario)',
				size: BootstrapDialog.SIZE_NORMAL,
				message: function(dialog) { 
					var $message = $('<div></div>');
					var pageToLoad = dialog.getData('pageToLoad');
					$message.load(pageToLoad);
					return $message;
				},
				data: {
					'pageToLoad': base_url+'index.php/Empresa/formulariousuario/'
				},
				buttons: [{
					label: 'Cancelar',
					cssClass: 'btn-default',
					action: function(dialogItself) {
						dialogItself.close();
					},
				},
                {
				  	label: 'Siguiente',
				  	cssClass: 'btn-rojo',
                  	action: function(dialogItself) {
						var form = $('#frmEmpresaUsuario')[0];
						var formData = new FormData(form);
						$.ajax({
							url: base_url+'index.php/Empresa/agregarUsuario/',
							type: 'POST',
							data: formData,
							processData:false,
							contentType:false,
							cache:false,
							beforeSend: function(){
								$('#load').show();
							},
							success: function (data) {
								data = JSON.parse(data);
								if(!data['exito']) {
									$('#error2').html(data['msg']);
									$('#error2').show();
									location.href = '#error';
								}
								else if(data['exito']) {
									obtenerDatos($('#opciones').val());
									$('#frmEmpresaUsuario')[0].reset();
									ids = data['msg'];
									dialogItself.close();
									BootstrapDialog.show({
										title: '<b>Agregar Empresa</b>(2/3 - Informacion)',
										size: BootstrapDialog.SIZE_NORMAL,
										message: function(dialog) { 
											var $message = $('<div></div>');
											var pageToLoad = dialog.getData('pageToLoad');
											$message.load(pageToLoad);
											return $message;
										},
										data: {
											'pageToLoad': base_url+'index.php/Empresa/formularioinformacion/'
										},
										buttons: [{ 
											label: 'Cancelar',
											cssClass: 'btn-default',
											action: function(dialogItself) {
												dialogItself.close();
											},	
										},
										{
											label: 'Siguiente',
											cssClass: 'btn-rojo',
											action: function(dialogItself) {
												var form = $('#frmEmpresaInfo')[0];
												var formData = new FormData(form);
												formData.append('idUsuario', ids);
												$.ajax({
													url: base_url+'index.php/Empresa/agregarInfo/',
													type: 'POST',
													data: formData,
													processData:false,
													contentType:false,
													cache:false,
													beforeSend: function(){
														$('#load').show();
													},
													success: function (data) {
														data = JSON.parse(data);
														if(!data['exito']) {
															$('#error1').html(data['msg']);
															$('#error1').show();
															location.href = '#error';
														}
														else if(data['exito']) {
															obtenerDatos($('#opciones').val());
															$('#frmEmpresaInfo')[0].reset();
															idEmpresa = data['msg'];
															dialogItself.close();
															BootstrapDialog.show({
																title: '<b>Agregar Empresa</b>(3/3 - Imagenes)',
																size: BootstrapDialog.SIZE_NORMAL,
																message: function(dialog) { 
																	var $message = $('<div></div>');
																	var pageToLoad = dialog.getData('pageToLoad');
																	$message.load(pageToLoad);
																	return $message;
																},
																data: {
																	'pageToLoad': base_url+'index.php/Empresa/formulario/'
																},
																buttons: [{
																	label: 'Cancelar',
																	cssClass: 'btn-default',
																	action: function(dialogItself) {
																		dialogItself.close();
																	},

																},
																{
																	label: 'Agregar',
																	cssClass: 'btn-rojo',
																	action: function(dialogItself) {
																		var form = $('#frmEmpresaImagen')[0];
																		var formData = new FormData(form);
																		formData.append('idEmpresa', idEmpresa);
																		$.ajax({
																			url: base_url+'index.php/Empresa/agregarImagen/',
																			type: 'POST',
																			data: formData,
																			processData:false,
																			contentType:false,
																			cache:false,
																			beforeSend: function(){
																				$('#load').show();
																			},
																			success: function (data) {
																				data = JSON.parse(data);
																				if(!data['exito']) {
																					$('#error').html(data['msg']);
																					$('#error').show();
																					location.href = '#error';
																				}
																				else if(data['exito']) {
																					obtenerDatos($('#opciones').val());
																					$('#frmEmpresaImagen')[0].reset();
																					dialogItself.close();
																				}
																			},
																			error: function(jqXHR, textStatus, errorThrown) {
																				console.log('error::'+errorThrown);
																			},
																			complete: function(){
																				$('#load').hide();
																				cambio = 0;
																				cambioV = 0;
																			}
																		});
																	},
																}]
															});
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

		$(document).on("click", "#ver", function () {
			var id = $(this).attr('data-id');
			var nombre = $(this).parent().siblings(':first').html();
			BootstrapDialog.show({
                title: nombre,
				size: BootstrapDialog.SIZE_NORMAL,
				message: function(dialog) { 
					var $message = $('<div></div>');
					var pageToLoad = dialog.getData('pageToLoad');
					$message.load(pageToLoad);
					return $message;
				},
				data: {
					'pageToLoad': base_url+'index.php/Empresa/formulario/'+id
				},
				buttons: [{
					label: 'Salir',
					cssClass: 'btn-default',
					action: function(dialogItself) {
						dialogItself.close();
					},
				},
                {
				  	label: 'Modificar',
				  	cssClass: 'btn-rojo',
                  	action: function(dialogItself) { 
						dialogItself.close();
						BootstrapDialog.show({
							title: '<b>Modificar Empresa</b>(1/2 - Imagenes)',
							size: BootstrapDialog.SIZE_NORMAL,
							message: function(dialog) { 
								var $message = $('<div></div>');
								var pageToLoad = dialog.getData('pageToLoad');
								$message.load(pageToLoad);
								return $message;
							},
							data: {
								'pageToLoad': base_url+'index.php/Empresa/modificarImagen/'+id
							},
							buttons: [{
								label: 'Cancelar',
								cssClass: 'btn-default',
								action: function(dialogItself) {
									dialogItself.close();
								},
							},
							{
								label: 'Guardar',
								cssClass: 'btn-rojo',
								action: function(dialogItself) { 

									BootstrapDialog.show({
										title: '<b>Modificar Empresa</b>(2/2 - Informacion)',
										size: BootstrapDialog.SIZE_NORMAL,
										message: function(dialog) { 
											var $message = $('<div></div>');
											var pageToLoad = dialog.getData('pageToLoad');
											$message.load(pageToLoad);
											return $message;
										},
										data: {
											'pageToLoad': base_url+'index.php/Empresa/modificarTexto/'+id
										},
										buttons: [{
											label: 'Cancelar',
											cssClass: 'btn-default',
											action: function(dialogItself) {
												dialogItself.close();
											},
										},
										{
											label: 'Guardar',
											cssClass: 'btn-rojo',
											action: function(dialogItself) { 
											},
										}]
									});
								},
							}]
						});
                    //AQUI VA TODO LO QUE DEBE DE HACER SI SE DA CLICK
                        /*var form = $('#frmEmpresa')[0];
						var formData = new FormData(form);
						formData.append('cambio', cambio);
						formData.append('cambioV', cambioV);
						formData.append('id',id);
                        formData.append('oldNombre',$('#inpNombreE').attr('data-nombre'));
                        formData.append('oldDescripcion',$('#inpDescripcion').attr('data-descripcion'));
                        formData.append('oldRazonSocial',$('#inpRazonSocial').attr('data-razonsocial'));
                        formData.append('oldRFC',$('#inpRFC').attr('data-rfc'));
                        formData.append('oldDomicilio',$('#inpDomicilio').attr('data-domicilio'));
                        formData.append('oldTelefono',$('#inpTelefono').attr('data-telefono'));
                        formData.append('oldLocal',$('#inpLocal').attr('data-local'));
                        
						$.ajax({
							url: base_url+'index.php/Empresa/modificarEmpresa/',
						  	type: 'POST',
						  	data:formData,
                            processData: false,
							contentType: false,
						  	beforeSend: function(){
							$('#load').show();
							},
							success: function (data) {
								data = JSON.parse(data);
								if(!data['exito']) {
									$('#error').html(data['msg']);
									$('#error').show();
                                    location.href = '#error';
								}
								else if(data['exito']) {
									obtenerDatos($('#opciones').val());
									$('#frmEmpresa')[0].reset();
									dialogItself.close();
								}
						  	},
						  	error: function(jqXHR, textStatus, errorThrown) {
								console.log('error::'+errorThrown);
							},
							complete: function(){
								$('#load').hide();
                                cambio = 0;
								cambioV = 0;
						  	}
					  	});*/
					},
			  	}]
            });
    	});

		function obtenerDatos(estatus) {
			$.ajax({
				url: base_url+'index.php/Empresa/obtenerEmpresa/'+estatus,
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

		function dibujarTabla(info) {
			tabla.clear().draw();
			$.each(info, function(index, item){
				var output = null;
				var output2 = null;
				if(item['estatus'] == '0') {
					output = "<small class='label label-danger'>Inactivo</small>";
					output2 = "<i style='color:#f6032f' data-estatus='"+item['estatus']+"' data-id='"+item['id']+"' id='cambiarEstado' class='fa fa-plus-circle fa-sm fa-2x fa-lg mano'></i>";
				}
				else if(item['estatus'] == '1') {
					output = "<small class='label label-success'>Activo</small>";
					output2 = "<i style='color:#f6032f' data-estatus='"+item['estatus']+"' data-id='"+item['id']+"' id='cambiarEstado' class='fa fa-minus-circle fa-sm fa-2x fa-lg mano '></i>";
				}
				var fila = tabla.row.add([
					item['nombre'],
					"<img height='40' src='"+base_url+item['logotipo']+"'></img>",
					output,
					"<i id='ver' data-id='"+item['id']+"' class='fa  fa-eye fa-sm fa-2x fa-lg mano'></i>",
					output2
				]).draw(false).node();
				$('td:eq(1)', fila).attr('class', 'text-center');
				$('td:eq(2)', fila).attr('class', 'text-center');
				$('td:eq(3)', fila).attr('class', 'text-center');
				$('td:eq(4)', fila).attr('class', 'text-center');
			});
		}
	});
</script>
<!-- MENU MENU MENU MENU MENU -->
  <?php $this->load->view('Global/header'); ?>
  <?php $this->load->view('Global/menu'); ?>
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
  
  <div class="content-wrapper">
     <section class="content">
          <div class="container-fluid">
               <div class="row">
                    <blockquote style=" border-left: 5px solid #dd4b39;">
                        <h1 class="text-justify">Firmas de los responsables</h1>
                        <!--<small id="verDocumentacion"><cite title="Source Title"><strong>Dar clic para ver la información requerida</strong></cite></small>-->
                    </blockquote>
               </div>
               <div class="row">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-inbox"></i>Listado de firmas</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                      </div>
                    </div>
                    <div class="box-body">
                    	<div class="table-responsive">
                    		<table id="tablaFirmas" class="table no-margin" style="width:100%">
	                    		 <thead>
						            <tr> 
						                <th>ID</th>
						                <th>Nombre</th>
						                <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Cargo</th>
						                <th>Opciones</th>
						            </tr>
						        </thead>
						        <tbody id="contenidoTabla">
						           
						        </tbody>
						    </table>
                <button type="button" class="btn btn-primary btn-lg" id="agregarFirmas">Agregar una firma nueva</button> 
                    	</div>
                    	
					       
                     
                    </div>
                  </div>
               </div>
               
           
          </div>
     </section><!-- /.content -->
</div>
<!--<div class="block" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 8000;opacity: .8; background-color: black;">-->
    
    
   
<!--</div>-->

<?php $this->load->view('Global/footer')?>

<script type="text/javascript">
  $(document).ready(function(){
    var avisoCargando = new BootstrapDialog({
        title: 'Cargando',
        closable: false,
        message: 'Porfavor espere, cargando la informacion'
    });

  
    obtenerDatos();
    //Declaro la tabla
    var tabla = insertarPaginado("tablaFirmas",10,true);

    function obtenerDatos(){
      $.ajax({
              url:base_url+"index.php/Instituciones/obtenerDatosFirmantes/",
              type:"POST",
              beforeSend: function(){
                avisoCargando.open();
              },
                success:function(respuesta){
                   respuesta = JSON.parse(respuesta);
                   var x = "";
                   var varStatus = '';
                   var ac = '';
                   //Borrar Contenido Tabla
                   tabla.clear().draw();
                   $.each(respuesta,function(index, item){
                      //Agregar una nueva fila
                      var  fila = tabla.row.add([
                                  item['id'], //Una celda
                                  item['nombre'],
                                  item['apellido_paterno'],
                                  item['apellido_materno'],
                                  item['cargo_firmante'],
                                  "<a href='#' class='editarFirma' data-id="+item['id']+" ><span class='fa fa-eye' style='font-size: 2.3em'></span></a>"/*&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='eliminarFirma' data-id="+item['id']+" ><span class='fa fa-trash' style='font-size: 2.3em'></span></a>"*/
                              ]).draw(false).node();
                      $('td:eq(0)',fila).attr('id', item['id']);
                    });
                
              },error:function(jqXHR, textStatus, errorThrown){
                    console.log('error:: '+ errorThrown);
                },
                complete: function(){
                  avisoCargando.close();

               }
          });
    }

    
      $('#agregarFirmas').click(function(){
         BootstrapDialog.show({
          title: 'Nueva firma', // Aquí se pone el título
          size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
          message: function(dialog) { 
              var $message = $('<div></div>');
              var pageToLoad = dialog.getData('pageToLoad');
              $message.load(pageToLoad); //Cargamos la vista

              return $message;
          },
          data: {
              'pageToLoad': base_url+'index.php/Instituciones/formularioFirmas'
          },
          buttons: [{ //agrega los botones del modal
              label: 'Cancelar',
              cssClass: 'btn-danger',
              action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                  dialogItself.close();
              },

          },
          { //agrega los botones del modal
              label: 'Guardar',
              cssClass: 'btn-primary',
              action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                  
                    var formData = new FormData($('#formulario')[0]);
                    //console.log(formulariovariable);
                    if(curpValida($('#txtcurp').val())){
	                    $.ajax({
	                        url:base_url+"index.php/Instituciones/guardarFirma",
	                        type:"POST",
	                        data:formData,
	                        cache:false,
	                        contentType:false,
	                        processData:false,
	                        beforeSend: function(){
	                          avisoCargando.open();
	                        },
	                          success:function(respuesta){
	                            console.log(respuesta);
	                            switch(parseInt(respuesta)){

	                              case 1: 
	                                var x = $("#estado").val();
	                                obtenerDatos(x);
	                                dialogItself.close();
	                              break;
                                case 2: 
                                  $('#msg-error').show();
                                  $('.list-errors').html('<li>Contraseña incorrecta</li>');
                                  break;
	                              case 0:
	                                      BootstrapDialog.show({
	                                          title: 'Error',
	                                          message: 'ups ah surgido un error. Recargar la pagina'
	                                      });
	                              break;
	                              default :
	                                $('#msg-error').show();
	                                $('.list-errors').html(respuesta);
	                                break;
	                            }
	                          
	                        },error:function(jqXHR, textStatus, errorThrown){
	                              console.log('error:: '+ errorThrown);
	                          },
	                          complete: function(){
	                            avisoCargando.close();

	                         }
	                    });
                	}
                	else{
                    	var algo = '<li>CURP inválida</li>';
                    	$('#msg-error').show();
                        $('.list-errors').html(algo);
                    }

              },

          }]
        });
    });

      $('#contenidoTabla').delegate(".editarFirma","click", function(){
      var dodo = $(this); //Acceder al contenido de la etiqueta 'a'
      var actualid = dodo.data('id');
      BootstrapDialog.show({
          title: 'Ver datos de la firma', // Aquí se pone el título
          size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
          message: function(dialog) { 
              var $message = $('<div></div>');
              var pageToLoad = dialog.getData('pageToLoad');
              $message.load(pageToLoad); //Cargamos la vista

              return $message;
          },
          data: {
              'pageToLoad': base_url+'index.php/Instituciones/formularioFirmas/'+actualid
          },
          buttons: [{ //agrega los botones del modal
              label: 'Cancelar',
              cssClass: 'btn-danger',
              action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                  dialogItself.close();
              },

          },
          /*{ //agrega los botones del modal
              label: 'Guardar',
              cssClass: 'btn-primary',
              action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                //Obtendremos la informacion desde php que contiene el formulario
                var nombreViejo = $("#txtnombre").data('info');
                var descripcionViejo = $("#txtdescripcion").data('info');
                var nombre = $("#txtnombre").val();
                var descripcion = $("#txtdescripcion").val();
                var id = $("#txtnombre").data('id');
                //Terminamos de obtener la informacion desde php
                if(nombre != nombreViejo || descripcion != descripcionViejo){//Comparamos si se hizo un cambio con la informacion que ya se tenia
                      BootstrapDialog.confirm({
                    title: 'Información',
                    message: 'La siguiente firma va ser modificada ¿Desea continuar?',
                    //type: BootstrapDialog.TYPE_INFO, 
                    btnCancelLabel: 'Cancelar', 
                    btnOKLabel: 'Continuar', 
                    btnOKClass: 'btn-info', 
                    callback: function(result) {
                      if(result){
                        var formData = new FormData($('#formulario')[0]);
                            formData.append('id', id);
                            if(curpValida($('#txtcurp').val())){
                            	$.ajax({
	                                url:base_url+"index.php/Administrador/editarPerfil",
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
	                                              BootstrapDialog.alert({
	                                                  title: 'Error',
	                                                  message: 'Ups ah surgido un error. Recargar la pagina'
	                                              });
	                                      break;
	                                      case 2: 
	                                              BootstrapDialog.alert({
	                                                  title: 'Error',
	                                                  message: 'El nombre '+$('#txtnombre').val()+' ya existe. Por favor, ingrese uno diferente'
	                                              });
	                                              $('#txtnombre').val('');
	                                      break;
	                                      default :
	                                        $('#msg-error').show();
	                                        $('.list-errors').html(respuesta);
	                                        break;
	                                    }
	                                  
	                                },error:function(jqXHR, textStatus, errorThrown){
	                                      console.log('error:: '+ errorThrown);
	                                  },
	                                  complete: function(){
	                                    avisoCargando.close();

	                                 }
	                            });
                            }
                            else{
                            	var algo = '<li>CURP inválida</li>';
                            	$('#msg-error').show();
	                            $('.list-errors').html(algo);
                            }
                            
                      }
                    }
                });
                        
                    }//Si no se hizo ningun cambio entonces le mostramos una alerta
                    else{
                      BootstrapDialog.alert({
                          title: 'Modificar al menos un campo',
                          message: 'Para editar una firma, debe cambiar al menos un campo',
                          type: BootstrapDialog.TYPE_DANGER             
                      });
                      
                    
                    }
                      
                

              },

          }*/]
        });

    });

	function curpValida(curp) {
	    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
	        validado = curp.match(re);
		
	    if (!validado)  //Coincide con el formato general?
	    	return false;
	    
	    //Validar que coincida el dígito verificador
	    function digitoVerificador(curp17) {
	        //Fuente https://consultas.curp.gob.mx/CurpSP/
	        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
	            lngSuma      = 0.0,
	            lngDigito    = 0.0;
	        for(var i=0; i<17; i++)
	            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
	        lngDigito = 10 - lngSuma % 10;
	        if (lngDigito == 10) return 0;
	        return lngDigito;
	    }
	  
	    if (validado[2] != digitoVerificador(validado[1])) 
	    	return false;
	        
	    return true; //Validado
	}



  });
</script>
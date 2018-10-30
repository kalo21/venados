<!-- MENU MENU MENU MENU MENU -->
  <?php $this->load->view('Global/header'); ?>
  <?php $this->load->view('Global/menu'); ?>
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
  
  <div class="content-wrapper">
     <section class="content">
          <div class="container-fluid">
               <div class="row">
                    <blockquote style=" border-left: 5px solid #264d78;">
                        <h1 class="text-justify">Modulos</h1>
                        <!--<small id="verDocumentacion"><cite title="Source Title"><strong>Dar clic para ver la información requerida</strong></cite></small>-->
                    </blockquote>
               </div>
               <div class="row">
                 <div class="col-md-4">
                   <select name="estado" id="estado" class="form-control">
                     <option value="-1">Seleccione una opción</option>
                     <option value="1">Activo</option>
                     <option value="0">Inactivo</option>
                   </select>
                 </div>
               </div>
               <br><br> 
               <div class="row">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-inbox"></i>  Listado de modulos</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                      </div>
                    </div>
                    <div class="box-body">
                    	<div class="table-responsive">
                    		<table id="tablaModulos" class="table no-margin" style="width:100%">
	                    		 <thead>
						            <tr> 
						                <th>ID</th>
						                <th>Nombre</th>
						                <th>Descripción</th>
                            <th>Ruta</th>
                            <th>Icono</th>
                            <th>Estatus</th>
						                <th>Opciones</th>
						            </tr>
						        </thead>
						        <tbody id="contenidoTabla">
						           
						        </tbody>
						    </table>
                <button type="button" class="btn btn-primary btn-lg" id="agregarModulo" style="background-color: #264d78;">Agregar modulo</button> 
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
<script>
   $(document).ready(function(){
    //Inicialize
    avisoCargando = new BootstrapDialog({
        title: 'Cargando',
        closable: false,
        message: 'Porfavor espere, cargando la informacion'
    });
    //Declaro la tabla
    var tabla = insertarPaginado("tablaModulos",15,true);
    
   
   $('#estado').change(function(){
      var estado = $(this).val();
      obtenerDatos(estado);
        
    });
   var x = $("#estado").val()
   obtenerDatos(x);
   function obtenerDatos(estado){
      $.ajax({
              url:base_url+"index.php/Administrador/obtenerModulosPorEstado/"+estado,
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
                      if (item['estatus'] == '0') {
                        ac = 'Inactivo';
                        varStatus = "<a href='#' class='cambiarEstatus' data-id="+item['id']+" data-actual="+item['estatus']+" ><span class='fa fa-toggle-off' style='font-size: 2.3em;  color: #264d78;'></span></a>";
                      }
                      else if(item['estatus'] == '1'){
                        ac = 'Activo';
                        varStatus = "<a href='#' class='cambiarEstatus' data-id="+item['id']+" data-actual="+item['estatus']+" ><span class='fa fa-toggle-on' style='font-size: 2.3em;  color: #264d78;'></span></a>";
                      }
                      //Agregar una nueva fila
                      var  fila = tabla.row.add([
                                  item['id'], //Una celda
                                  item['nombre'],
                                  item['descripcion'],
                                  item['ruta'],
                                  "<span class='"+item['icono']+"' style='font-size: 2.5em'></span>",
                                  ac,
                                  "<a href='#' class='editarModulo' data-id="+item['id']+" ><span class='fa fa-edit' style='font-size: 2.3em; color: #264d78;'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+varStatus
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
    $('#agregarModulo').click(function(){
         BootstrapDialog.show({
          title: 'Nuevo modulo', // Aquí se pone el título
          size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
          message: function(dialog) { 
              var $message = $('<div></div>');
              var pageToLoad = dialog.getData('pageToLoad');
              $message.load(pageToLoad); //Cargamos la vista

              return $message;
          },
          data: {
              'pageToLoad': base_url+'index.php/administrador/formularioModulos'
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
                    $.ajax({
                        url:base_url+"index.php/Administrador/agregarModulo",
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
                              case 0:
                                      BootstrapDialog.show({
                                          title: 'Error',
                                          message: 'ups ah surgido un error. Recargar la pagina'
                                      });
                              break;
                              case 2: BootstrapDialog.alert({
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
                

              },

          }]
        });
    });
     $('#contenidoTabla').delegate(".editarModulo","click", function(){
      var dodo = $(this); //Acceder al contenido de la etiqueta 'a'
      var actualid = dodo.data('id');
      BootstrapDialog.show({
          title: 'Editar modulo', // Aquí se pone el título
          size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
          message: function(dialog) { 
              var $message = $('<div></div>');
              var pageToLoad = dialog.getData('pageToLoad');
              $message.load(pageToLoad); //Cargamos la vista

              return $message;
          },
          data: {
              'pageToLoad': base_url+'index.php/administrador/formularioModulos/'+actualid
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
                //Obtendremos la informacion desde php que contiene el formulario
                var nombreViejo = $("#txtnombre").data('info');
                var descripcionViejo = $("#txtdescripcion").data('info');
                var iconoViejo = $("#txticono").data('info');
                var padreViejo = $("#txtopciones").data('info');
                var enlaceViejo = $("#txtenlace").data('info');
                var rutaViejo = $("#txtruta").data('info');
                var nombre = $("#txtnombre").val();
                var descripcion = $("#txtdescripcion").val();
                var icono = $("#txticono").val();
                var padre = "";
                if($("#txtopciones").is(":checked")){
                  padre = "1";
                }
                else{
                  padre = "0";
                }
                
                //console.log(padre);
                
                //console.log("Padreviejo "+padreViejo +" padre "+padre);
                var enlace = $("#txtenlace").val();
                var ruta = $("#txtruta").val();

                var id = $("#txtnombre").data('id');
                //Terminamos de obtener la informacion desde php
                    if(nombre != nombreViejo || descripcion != descripcionViejo || iconoViejo != icono || padreViejo != padre || enlaceViejo != enlace || rutaViejo != ruta){//Comparamos si se hizo un cambio con la informacion que ya se tenia
                      BootstrapDialog.confirm({
                    title: 'Información',
                    message: 'El siguiente modulo va ser modificado ¿Desea continuar?',
                    //type: BootstrapDialog.TYPE_INFO, 
                    btnCancelLabel: 'Cancelar', 
                    btnOKLabel: 'Continuar', 
                    btnOKClass: 'btn-info', 
                    callback: function(result) {
                      if(result){
                        var formData = new FormData($('#formulario')[0]);
                            formData.append('id', id);
                            $.ajax({
                                url:base_url+"index.php/Administrador/editarModulo",
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
                    }
                });
                        
                    }//Si no se hizo ningun cambio entonces le mostramos una alerta
                    else{
                      BootstrapDialog.alert({
                    title: 'Modificar al menos un campo',
                    message: 'Para editar un modulo, debe cambiar al menos un campo',
                    type: BootstrapDialog.TYPE_DANGER             
                });
                      
                    
                    }
                      
                

              },

          }]
        });

    });

 $('#contenidoTabla').delegate(".cambiarEstatus","click", function(){
      var dodo = $(this); //Acceder al contenido de la etiqueta 'a'
      var actualid = dodo.data('id');
      var actualado = dodo.data('actual');
      var msg = "";
      if (actualado == '1') {
        actualado = 0;
         msg ="<br><br> <strong>Nota:</strong> A dar de baja un modulo, todos los perfiles ligados a este modulo no podran acceder";
      }else{
        actualado = 1;
      }
      BootstrapDialog.confirm({
          title: 'Advertencia',
          message: 'Se cambiará el estatus del modulo ¿Desea continuar?'+msg,
          type: BootstrapDialog.TYPE_DANGER, 
          btnCancelLabel: 'Cancelar', 
          btnOKLabel: 'Continuar', 
          btnOKClass: 'btn-danger', 
          callback: function(result) {
            if(result){
              $.ajax({
                  url:base_url+"index.php/Administrador/cambiarEstatusModulo/",
                  type:"POST",
                  data:{
                      id: actualid,
                      estatus: actualado
                  },
                  beforeSend: function(){
                    avisoCargando.open();
                  },
                    success:function(respuesta){
                      switch (parseInt(respuesta)){
                        case 1:
                               var x = $("#estado").val()
                               obtenerDatos(x);
                               break;
                        case 2:
                              if(actualado === 0){
                                /*BootstrapDialog.show({
                                    title: 'Modulos con hijos',
                                    message: 'El modulo se dio de baja correctamente, pero cuenta con hijos'
                                });*/
                                funcionAdiccional(actualid);
                              }
                              var x = $("#estado").val()
                              obtenerDatos(x);
                              break;
                        default:
                        BootstrapDialog.show({
                            title: 'No se actualizó',
                            message: 'No se modificó el estatus del modulo seleccionado'
                        });
                        break;
                      }
                    
                     console.log(respuesta);
                    
                  },error:function(jqXHR, textStatus, errorThrown){
                        console.log('error:: '+ errorThrown);
                    },
                    complete: function(){
                      avisoCargando.close();

                   }
              });
            }
          }
      });
    });
 
  function funcionAdiccional(idvar){
    BootstrapDialog.show({
        title: 'Modulos con hijos', // Aquí se pone el título
        size: BootstrapDialog.SIZE_WIDE, //Indica el tamaño
        message: "El modulo se dio de baja correctamente, pero cuenta con hijos con estatus activos<br><br>Que desea hacer?",
        buttons: [
        { //agrega los botones del modal
            label: 'Dar de bajas a modulos hijos',
            cssClass: 'btn-primary',
            action: function(dialogItself) {
              BootstrapDialog.confirm({
                title: 'Advertencia',
                message: 'Se dara de baja a todos los modulos associados al padre que se acaba de dar de baja ¿Desea continuar?<br><br> <strong>Nota:</strong> A dar de baja un modulo, todos los perfiles ligados a este modulo no podran acceder',
                type: BootstrapDialog.TYPE_DANGER, 
                btnCancelLabel: 'Cancelar', 
                btnOKLabel: 'Continuar', 
                btnOKClass: 'btn-danger', 
                callback: function(result) {
                  if(result){
                    $.ajax({
                        url:base_url+"index.php/Administrador/cambiarEstatusModuloHijo/",
                        type:"POST",
                        data:{
                            id: idvar,
                        },
                        beforeSend: function(){
                          avisoCargando.open();
                        },
                          success:function(respuesta){
                            switch (parseInt(respuesta)){
                              case 1:
                                    var x = $("#estado").val()
                                     obtenerDatos(x);
                                     dialogItself.close();
                                     break;
                              default:
                              BootstrapDialog.show({
                                  title: 'No se actualizó',
                                  message: 'No se modificó el estatus del modulo seleccionado'
                              });
                              break;
                            }
                          
                           console.log(respuesta);
                          
                        },error:function(jqXHR, textStatus, errorThrown){
                              console.log('error:: '+ errorThrown);
                          },
                          complete: function(){
                            avisoCargando.close();

                         }
                    });
                  }
                }
            });

            }

        },
        { //agrega los botones del modal
            label: 'Designarle este padre',
            cssClass: 'btn-primary',
            action: function(dialogItself) {
               BootstrapDialog.confirm({
                title: 'Advertencia',
                message: 'Se dejara sin enlace a los modulos associados al padre que se acaba de dar de baja ¿Desea continuar?<br><br> <strong>Nota:</strong> A dejar sin padres a los modulos asosiados, seran una opcion en el menu.',
                type: BootstrapDialog.TYPE_DANGER, 
                btnCancelLabel: 'Cancelar', 
                btnOKLabel: 'Continuar', 
                btnOKClass: 'btn-danger', 
                callback: function(result) {
                  if(result){
                    $.ajax({
                        url:base_url+"index.php/Administrador/cambiarEnlaceModuloHijo/",
                        type:"POST",
                        data:{
                            id: idvar,
                        },
                        beforeSend: function(){
                          avisoCargando.open();
                        },
                          success:function(respuesta){
                            switch (parseInt(respuesta)){
                              case 1:
                                    var x = $("#estado").val()
                                     obtenerDatos(x);
                                     dialogItself.close();
                                     break;
                              default:
                              BootstrapDialog.show({
                                  title: 'No se actualizó',
                                  message: 'No se modificó el estatus del modulo seleccionado'
                              });
                              break;
                            }
                          
                           console.log(respuesta);
                          
                        },error:function(jqXHR, textStatus, errorThrown){
                              console.log('error:: '+ errorThrown);
                          },
                          complete: function(){
                            avisoCargando.close();

                         }
                    });
                  }
                }
            });
            }

        },
        { //agrega los botones del modal
            label: 'No realizar niguna acción',
            cssClass: 'btn-danger',
            action: function(dialogItself) { // Funciones del boton del modal. El atributo es obligatorio para cerrarlo
                dialogItself.close();
            },

        }]
      });
  }

});

</script>

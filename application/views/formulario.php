<!-- MENU MENU MENU MENU MENU -->
  <?php $this->load->view('Global/header'); ?>
  <?php $this->load->view('Global/menu'); ?>
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<style>
	input[type="text"]{text-transform:uppercase;}
</style>
  
  <div class="content-wrapper">
     <section class="content">
          <div class="container-fluid">
               <div class="row">
                    <blockquote style=" border-left: 5px solid #dd4b39;">
                        <h3 class="text-justify"><strong>"</strong>Es importante antes de realizar este procedimiento, contar con toda la información requerida para el seguimiento del proceso<strong>"</strong></h3>
                        <!--<small id="verDocumentacion"><cite title="Source Title"><strong>Dar clic para ver la información requerida</strong></cite></small>-->
                    </blockquote>
               </div>
               <div class="row">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-inbox"></i>  Formulario</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                      </div>
                    </div>
                    <div class="box-body">
                      <form role="form" id="formulario" autocomplete="off">
                      	
						<input type="password" style="opacity: 0;position: absolute;">

						<!--<input type="text" name="codigo" placeholder="Código promocional..." autocomplete="off" />	-->
                        <h3>Firmas de Responsables</h3>
						<div class="container-fluid">
							<div class="row">	
								<div class="col-md-12">	
									<div class="pull-left tituloRepresetante">	
										<h5>Responsable 1</h5>
									</div>
								</div>
							</div>
							<div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtNombre" class="control-label">Nombre</label>
		                            <input type="text" class="form-control" id="txtNombre" name="nombre" placeholder="Nombre">
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="txtApellidoPaterno" class="control-label">Apellido Paterno</label>
		                            <input type="text" class="form-control" id="txtApellidoPaterno" name="apellidoPaterno" placeholder="Apellido paterno">
		                        </div>
	                        </div>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtApellidoMaterno" class="control-label">Apellido Materno</label>
		                            <input type="text" class="form-control" id="txtApellidoMaterno" name="apellidoMaterno" placeholder="Apellido materno">
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="txtCurp" class="control-label">CURP</label>
		                            <input type="text" autocomplete="ÑÖcompletes" class="form-control" id="txtCurp" name="curp" placeholder="CURP">
		                        </div>
	                        </div>

	                         <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="cmbCargo" class="control-label">Cargo</label>
		                            <select name="cargo" class="form-control" id="cmbCargo">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <?php
		                                	foreach($cargos as $cargo){
		                                		echo '<option value="'.$cargo->id.'">'.$cargo->cargo_firmante.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="cmbGrado" class="control-label">Abreviatura para Título o Grado de Estudio</label>
		                            <select name="gradoEstudio" class="form-control" id="cmbGrado">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <?php
		                                	foreach($gradoEstudio as $estudios){
		                                		echo '<option value="'.$estudios->id.'">'.$estudios->abreviatura.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>

		                       
	                        </div>

	                         <div class="row-fluid form-group">
	                         	<div class="form-group col-md-6">
		                          <label for="txtCer" class="control-label">Llave pública (Archivo .CER)</label>
		                            <input type="file" accept=".cer" class="form-control" id="txtCer" name="cer" placeholder="CURP">
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="txtKey" class="control-label">Llave pública (Archivo .KEY)</label>
		                            <input type="file" accept=".key" class="form-control" id="txtKey" name="key" placeholder="CURP">
		                        </div>
		                        
	                        </div>
	                         <div class="row-fluid form-group">
		                       <div class="form-group col-md-6">
		                       	<input type="text" style="opacity: 0;position: absolute;">
		                          <label for="txtContraseña" class="control-label">Contraseña</label>
		                            <input type="password" autocomplete="ÑÖcompletes" class="form-control" id="txtContraseña" name="contraseña" placeholder="CONTRASEÑA">
		                        </div>
		                        <div class="form-group col-md-6">
		                         <!-- <label for="txtnoCertificado" class="control-label">No. Certificado</label>
		                            <input type="text" class="form-control" id="txtnoCertificado" name="noCertificadoResponsable" placeholder="Numero del certificado">-->
		                        </div>
	                        </div>
						</div>
                        <div class="nuevaFirma">
                        	<!--aca va las nuevas firmas-->
                        </div>
						
                         <div class="row-fluid form-group">
	                        <div class="form-group pull-right">
	                          <button class="btn btn-info btn-lg" id="btnAgregar" type="button">Agregar Responsables</button>
	                        </div>
	                        
                        </div>
                        <div class="container-fluid">
	                        <br>
							<hr style="width: 100%;  height: 1px;" />

	                        <h3>Datos de la Carrera  a Titular</h3>
	                        <br>
	                       
	                         <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="cmbInstitucion" class="control-label">Institución</label>
		                            <select name="institucion" class="form-control" id="cmbInstitucion">
		                                <option value="0">NOMBRE DE LA INSTITUCIÓN</option>
		                                <?php
		                                	foreach($institucionesPrivadasSuperiores as $institucion){
		                                		echo '<option value="'.$institucion->id.'">'.$institucion->nombre.'</option>';
		                                	}
		                                ?>
		                              
		                            </select>
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="cmbCarrera" class="control-label">Carrera</label>
		                            <select disabled name="carrera" class="form-control" id="cmbCarrera">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                              
		                            </select>
		                        </div>

	                        </div>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtFechaInicio" class="control-label">Fecha de Inicio de la Carrera </label>
		                            <input type="date" class="form-control" name="fechainicio" id="txtFechaInicio" p>
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="txtFechaTerminacion" class="control-label">Fecha de Terminación de la Carrera</label>
		                            <input type="date" class="form-control" name="fechaterminacion" id="txtFechaTerminacion">
		                        </div>
	                        </div>

	                         <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="cmbModalidad" class="control-label">Modalidad Titulación</label>
		                            <select name="modalidad" class="form-control" id="cmbModalidad">
		                            	<option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <?php
		                                	foreach($modalidades as $modalidad){
		                                		echo '<option value="'.$modalidad->id.'">'.$modalidad->nombre.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="txtnumeroRvoe" class="control-label">No. RVOE</label>
		                            <input type="text" class="form-control" id="txtnumeroRvoe" name="numeroRvoe" placeholder="NUMERO DEL RVOE">
		                        </div>

	                        </div>
	                    </div>
						<div class="container-fluid">
	                       <hr style="width: 100%;  height: 1px;" />
	                        <h3>Datos del Profesionista</h3>
	                        <br>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtNombreProfeccionista" class="control-label">Nombre</label>
		                            <input type="text" class="form-control" id="txtNombreProfeccionista" name="nombreProfeccionista" placeholder="Nombre">
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="txtApellidoPaternoProfeccionista" class="control-label">Apellido Paterno</label>
		                            <input type="text" class="form-control" id="txtApellidoPaternoProfeccionista" name="apellidoPaternoProfeccionista" placeholder="Apellido paterno">
		                        </div>
	                        </div>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtApellidoMaternoProfeccionista" class="control-label">Apellido Materno</label>
		                            <input type="text" class="form-control" id="txtApellidoMaternoProfeccionista" name="apellidoMaternoProfeccionista" placeholder="Apellido materno">
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="txtCurpProfeccionista" class="control-label">CURP</label>
		                            <input type="text" class="form-control" id="txtCurpProfeccionista" name="curpProfeccionista" placeholder="CURP">
		                        </div>
	                        </div>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtCorreo" class="control-label">Correo</label>
		                            <input type="email" class="form-control" id="txtCorreo" name="correo" placeholder="EJEMPLO@EJEMPLO.COM">
		                        </div>
	                        </div>
	                    </div>
						<div class="container-fluid">
	                        <hr style="width: 100%;  height: 1px;" />
	                        <h3>Datos de Expedición del Título Electrónico</h3>
	                        <br>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtFechaExpedicion" class="control-label">Fecha Expedición</label>
		                            <input type="date" class="form-control" id="txtFechaExpedicion" name="fechaExpedicion" placeholder="Fecha expedición">
		                        </div>
								<div class="form-group col-md-6">
		                          <label for="cmbAutorizacion" class="control-label">Autorización del Reconocimiento</label>
		                            <select name="autorizacion" class="form-control" id="cmbAutorizacion">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <?php
		                                	foreach($autorizaciones as $autorizacion){
		                                		echo '<option value="'.$autorizacion->id.'">'.$autorizacion->nombre.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>
		                       
	                        </div>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtFechaExamen" class="control-label">Fecha de Examen Profesional</label>
		                            <input type="date" class="form-control" id="txtFechaExamen" name="fechaExamen" placeholder="Fecha examen">
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="txtfechaExencionExamen" class="control-label">Fecha de Exención de Examen Profesional (opcional)</label>
		                            <input type="date" class="form-control" id="txtfechaExencionExamen" name="fechaExencionExamen" placeholder="Fecha de exención de examen profesional (opcional)">
		                        </div>
								 
	                        </div>
	                         <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="cmbServicio" class="control-label">Cumplió con el Servicio Social</label>
		                            <select name="servicio" class="form-control" id="cmbServicio">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <option value="1">SI</option>
		                                <option value="2">NO</option>
		                                
		                            </select>
		                        </div>
								<div class="form-group col-md-6">
		                          <label for="cmbFundamento" class="control-label">Fundamento Legal de Servicio Social</label>
		                            <select name="fundamento" disabled class="form-control" id="cmbFundamento">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                 <?php
		                                	foreach($fundamentos as $fundamento){
		                                		echo '<option value="'.$fundamento->id.'">'.$fundamento->nombre.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>
		                       
		                       
	                        </div>
	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="cmbEntidad" class="control-label">Entidad Federativa</label>
		                            <select name="entidad" class="form-control" id="cmbEntidad">
		                                <!--<option value="0">SELECCIONE UNA OPCIÓN</option>-->
		                                 <?php
		                                	foreach($entidades as $entidad){
		                                		if($entidad->id == "25"){
		                                			echo '<option selected value="'.$entidad->id.'">'.$entidad->nombre.'</option>';
		                                		}
		                                		
		                                	}
		                                ?>
		                            </select>
		                        </div>
		                    </div>

	                       
	                    </div>
							
						<div class="container-fluid">
							<hr style="width: 100%;  height: 1px;" />
	                        <h3>Antecedentes</h3>
	                        <br>

	                        <div class="row-fluid form-group">
	                        	<div class="form-group col-md-6">
		                          <label for="txtInstitucionAntecedentes" class="control-label">Institución</label>
		                          <select name="institucionAntecedentes" class="form-control" id="txtInstitucionAntecedente">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                <?php
		                                	foreach($instituciones as $institucion){
		                                		echo '<option value="'.$institucion->id.'">'.$institucion->nombre.'</option>';
		                                	}
		                                ?>
		                              
		                            </select>
		                        </div>
		                        <div class="form-group col-md-6">
		                          <label for="cmbEntidades" class="control-label">Entidad Federativa</label>
		                            <select name="entidadesAntecedentes" class="form-control" id="cmbEntidadesAntecedentes">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                 <?php
		                                	foreach($entidades as $entidad){
		                                		echo '<option value="'.$entidad->id.'">'.$entidad->nombre.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>
	                        </div>

	                        <div class="row-fluid form-group">
		                        <div class="form-group col-md-6">
		                          <label for="cmbTipoEstudioAntecedentes" class="control-label">Tipo Estudio</label>
		                            <select name="tipoEstudioAntecedentes" class="form-control" id="cmbTipoEstudioAntecedentes">
		                                <option value="0">SELECCIONE UNA OPCIÓN</option>
		                                 <?php
		                                	foreach($antecedentes as $antecedente){
		                                		echo '<option value="'.$antecedente->id.'">'.$antecedente->tipo_estudio.'</option>';
		                                	}
		                                ?>
		                            </select>
		                        </div>

		                        <div class="form-group col-md-6">
		                          <label for="txtFechaInicioAntecedentes" class="control-label">Fecha Inicio</label>
		                            <input type="date" class="form-control" name="fechaInicioAntecedentes" id="txtFechaInicioAntecedentes" p>
		                        </div>

	                        </div>

	                         <div class="row-fluid form-group">
		                        <div class="form-group col-md-6">
		                          <label for="txtFechaTerminacionAntecedentes" class="control-label">Fecha Terminación</label>
		                            <input type="date" class="form-control" name="fechaTerminacionAntecedentes" id="txtFechaTerminacionAntecedentes">
		                        </div>
		                        <div class="form-group col-md-6">
		                          	<label for="txtnoCedula" class="control-label">No. Cedula </label>
		                            <input type="text" class="form-control" id="txtnoCedula" name="noCedula" placeholder="NUMERO DE CEDULA">
		                        </div>
	                        </div>
	                         <div class="row-fluid form-group">
		                        <div class="form-group pull-right">
		                          <button id="btnEnviar"class="btn btn-success btn-lg" type="button">Generar XML</button>
		                        </div>
		                        
	                        </div>
	                    </div>
 						
                      </form>
                    </div>
                  </div>
               </div>
           
          </div>
     </section><!-- /.content -->
</div>
<?php $this->load->view('Global/footer')?>


<script>
$(document).ready(function(){

	//var base_url = "<?php //echo base_url();?>";
	var i=0;
	var arregloNumeros = [];
	var arregloCarreras;
	var alertCargando = new BootstrapDialog({
        title: 'Cargando',
        message: 'Espere porfavor ... estamos cargando la información'
    });
	var alertEnviando = new BootstrapDialog({
        title: 'Enviando',
        message: 'Espere porfavor ... estamos generando el xml'
      });
	$('#cmbServicio').change(function(){
		if ($(this).val() == "0"|| $(this).val() == "2" ){
			$('#cmbFundamento').attr('disabled', true);
			$("#cmbFundamento").val("0");
		}
		else{
			$('#cmbFundamento').attr('disabled', false);
		}
	});
	$('#cmbInstitucion').change(function(){
		if ($(this).val() == "0"){
			$('#cmbCarrera').html("");
			y='<option selected value="0">SELECCIONE UNA OPCIÓN</option>';
			$('#cmbCarrera').attr('disabled', true);
			$('#cmbCarrera').append(y);
		}
		else{

			$('#cmbCarrera').attr('disabled', false);
			obtenerCarreras($(this).val());
		}


	});
	function llenarCarreras(){
		$('#cmbCarrera').html("");
		x='<option selected value="0">SELECCIONE UNA OPCIÓN</option>';
		$('#cmbCarrera').append(x);
		$.each(arregloCarreras,function(index, item){
				x='<option value="'+item['id']+'">'+item['nombre']+'</option>';
				$('#cmbCarrera').append(x);
			});
	}
	function obtenerCarreras(id){
		$.ajax({
	        url:base_url+"index.php/Inicio/obtenerCarrerasIdInstititucion/"+id,
	        type:"POST",
	        beforeSend: function(){
	        	alertCargando.open();
	        },
            success:function(respuesta){
               respuesta = JSON.parse(respuesta);
	           arregloCarreras = respuesta;
	           llenarCarreras();
	        },error:function(jqXHR, textStatus, errorThrown){
                console.log('error:: '+ errorThrown);
            },
            complete: function(){
	            alertCargando.close();

	         }
	    });
	}
	function dialogo(titulo,mensaje){
		BootstrapDialog.confirm({
            title: titulo,
            message: mensaje,
            type: BootstrapDialog.TYPE_DANGER, 
            btnCancelLabel: 'Cancelar', 
            callback: function(result) {
            	if(result){
            		
            	}
            }
        });
	}
	function limpiar(){
		/*$('#txtNombre').val();  
		$('#txtApellidoPaterno').val();  
		$('#txtApellidoMaterno').val(); 
		$('#txtCurp').val();
		$('#cmbCargo').val();
		$('#txtCer').val();
		$('#txtKey').val();
		$('#txtContraseña').val();
		$('#txtnoCertificado').val();
		$('#cmbInstitucion').val();
		$('#cmbCarrera').val();
		$('#txtFechaInicio').val();
		$('#txtFechaTerminacion').val();
		$('#cmbModalidad').val();
		$('#cmbGrado').val();*/
		$('#cmbAutorizacion').val("0");
		$('#txtNombreProfeccionista').val("");
		$('#txtApellidoPaternoProfeccionista').val("");
		$('#txtApellidoMaternoProfeccionista').val("");
		$('#txtCurpProfeccionista').val("");
		$('#txtCorreo').val("");
		//$('#txtFechaExpedicion').val("");
		$('#txtFechaExamen').val("");
		//$('#cmbEntidad').val("0");
		$('#cmbServicio').val("0");
		$('#cmbFundamento').val("0");
		$('#txtInstitucionAntecedentes').val(0);
		$('#cmbEntidades').val(0);
		$('#cmbTipoEstudioAntecedentes').val("0");
		$('#txtFechaInicioAntecedentes').val("");
		$('#txtFechaTerminacionAntecedentes').val("");
		$('#txtnoCedula').val("")
		
	}
	function validaciones(){
		//Declaraciones de variables definidas
		var nombreResponsable = $('#txtNombre').val();  
		var apellidoPaternoResponsable = $('#txtApellidoPaterno').val();  
		var apellidoMaternoResponsable = $('#txtApellidoMaterno').val(); 
		var curpResponsable = $('#txtCurp').val();
		var cargoResponsable = $('#cmbCargo').val();
		//var gradoResponsable = $('#cmbGrado').val();
		var llaveResponsable = $('#txtCer').val();
		var llaveKey = $('#txtKey').val();
		var contraseñaResponsable = $('#txtContraseña').val();
		var noCertificado = $('#txtnoCertificado').val();
		var institucion = $('#cmbInstitucion').val();
		var carrera = $('#cmbCarrera').val();
		var fechaInicio = $('#txtFechaInicio').val();
		var fechaterminacion = $('#txtFechaTerminacion').val();
		var autorizacion = $('#cmbAutorizacion').val();
		var nombreProfecionista = $('#txtNombreProfeccionista').val();
		var apellidoPaternoProfeccionista = $('#txtApellidoPaternoProfeccionista').val();
		var apellidoMaternoProfeccionista = $('#txtApellidoMaternoProfeccionista').val();
		var curpProfeccionista = $('#txtCurpProfeccionista').val();
		var correoProfeccionista = $('#txtCorreo').val();
		var fechaExpedicion = $('#txtFechaExpedicion').val();
		var modalidad = $('#cmbModalidad').val();
		var fechaExamen = $('#txtFechaExamen').val();
		var entidadFederativa = $('#cmbEntidad').val();
		var cumplioServicio = $('#cmbServicio').val();
		var fundamentoLegal = $('#cmbFundamento').val();
		var institucionAntecedentes = $('#txtInstitucionAntecedentes').val();
		var entidadesAntecedentes = $('#cmbEntidades').val();
		var tipoEstudioAntecedentes = $('#cmbTipoEstudioAntecedentes').val();
		var fechaInicioAntecedentes = $('#txtFechaInicioAntecedentes').val();
		var fechaterminacionAntecendentes = $('#txtFechaTerminacionAntecedentes').val();
		var gradoEstudio = $('#cmbGrado').val();
		var titulo = "Falta campos por llenar";
		var mensaje = "";
		if(nombreResponsable == ""){
			mensaje = "Llenar el nombre del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtNombre');
			return false;
		}
		else if(apellidoPaternoResponsable == ""){
			mensaje = "Llenar el apellido paterno del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtApellidoPaterno');
			return false;
		}
		else if(apellidoMaternoResponsable == ""){
			mensaje = "Llenar el apellido materno del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtApellidoMaterno');
			return false;
		}
		else if(curpResponsable == ""){
			mensaje = "Llenar la curp del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCurp');
			return false;
		}
		else if(!curpValida(curpResponsable)){
			mensaje = "Capturar CURP corretamente en responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCurp');
			return false;
		}
		else if(cargoResponsable == "0"){
			mensaje = "Seleccionar cargo del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbCargo');
			return false;
		}
		else if(gradoEstudio == "0"){
			mensaje = "Seleccionar grado de estudio del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbGrado');
			return false;
		}
		/*else if(noCertificado == ""){
			mensaje = "LLenar el no. del certificado del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtnoCertificado');
			return false;
		}*/
		else if(llaveResponsable == ""){
			mensaje = "Seleccionar un archivo tipo .CER en llave de resposable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCer');
			return false;
		}
		else if(llaveKey == ""){
			mensaje = "Seleccionar un archivo tipo .KEY en llave de resposable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtKey');
			return false;
		}
		else if(contraseñaResponsable == ""){
			mensaje = "Llenar contraseña del responsable 1";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtContraseña');
			return false;
		}
		else if(institucion == "0"){
			mensaje = "Seleccionar una institucción";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbInstitucion');
			return false;
		}
		else if(carrera == "0"){
			mensaje = "Seleccionar una carrera";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbCarrera');
			return false;
		}
		else if(fechaInicio == ""){
			mensaje = "Llenar fecha inicio";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaInicio');
			return false;
		}
		else if(fechaterminacion == ""){
			mensaje = "Llenar fecha terminación";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaTerminacion');
			return false;
		}
		else if(autorizacion == "0"){
			mensaje = "Seleccionar autorización del reconocimiento";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbAutorizacion');
			return false;
		}
		else if(nombreProfecionista == ""){
			mensaje = "Llenar nombre del profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtNombreProfeccionista');
			return false;
		}
		else if(apellidoPaternoProfeccionista == ""){
			mensaje = "Llenar el apellido paterno del profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtApellidoPaternoProfeccionista');
			return false;
		}
		else if(apellidoMaternoProfeccionista == ""){
			mensaje = "Llenar el apellido materno del profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtApellidoMaternoProfeccionista');
			return false;
		}
		else if(curpProfeccionista == ""){
			mensaje = "Llenar curp del profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCurpProfeccionista');
			return false;
		}
		else if(!curpValida(curpProfeccionista)){
			mensaje = "Capturar CURP corretamente en el apartado de profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCurpProfeccionista');
			return false;
		}
		else if(correoProfeccionista == ""){
			mensaje = "Llenar correo del profesionista";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtCorreo');
			return false;
		}
		else if(fechaExpedicion == ""){
			mensaje = "Llenar fecha de expedición";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaExpedicion');
			return false;
		}
		else if(modalidad == "0"){
			mensaje = "Seleccionar modalidad";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbModalidad');
			return false;
		}
		else if(fechaExamen == ""){
			mensaje = "Llenar fecha examen";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaExamen');
			return false;
		}
		else if(entidadFederativa == "0"){
			mensaje = "Seleccionar entidad federativa";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbEntidad');
			return false;
		}
		else if(cumplioServicio == "0" ){
			mensaje = "Seleccionar si el profesionista realizó el servicio social";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbServicio');
			return false;
		}
		else if(cumplioServicio == "2" ){
			mensaje = "Es imposible continuar, el profesionista debe de cumplir con el servicio social";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbServicio');
			return false;
		}
		else if(fundamentoLegal == "0"){
			mensaje = "Seleccionar el fundamento legal del servicio social";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbFundamento');
			return false;
		}
		else if(institucionAntecedentes == "0"){
			mensaje = "Seleccionar institución en el apartado de antecedente";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtInstitucionAntecedentes');
			return false;
		}
		else if(entidadesAntecedentes == "0"){
			mensaje = "Seleccionar entidad federativa en el apartado de antecedente";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbEntidades');
			return false;
		}
		else if(tipoEstudioAntecedentes == "0"){
			mensaje = "Seleccionar el tipo de estudio antecedente";
			dialogo(titulo,mensaje);
			$(location).attr('href','#cmbTipoEstudioAntecedentes');
			return false;
		}
		else if(fechaInicioAntecedentes == ""){
			mensaje = "Llenar fecha inicio en el apartado de antecedentes";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaInicioAntecedentes');
			return false;
		}
		else if(fechaterminacionAntecendentes == ""){
			mensaje = "Llenar fecha de terminación en el apartado de antecedentes";
			dialogo(titulo,mensaje);
			$(location).attr('href','#txtFechaTerminacionAntecedentes');
			return false;
		}
		else if(!validarIn($('#txtnoCedula').val()) && $('#txtnoCedula').val() != ""){
			//if(){
				mensaje = "El numero de cedula profesional debe de tener 7-8 digitos";
				dialogo(titulo,mensaje);
				$(location).attr('href','#txtFechaTerminacionAntecedentes');
				return false;
			//}
		}
		else{
			var resultado = true;
			var cont=2;
			$.each(arregloNumeros,function(index, item){
				nombreResponsable = $('#txtNombre'+item).val();  
				apellidoPaternoResponsable = $('#txtApellidoPaterno'+item).val();  
				apellidoMaternoResponsable = $('#txtApellidoMaterno'+item).val(); 
				curpResponsable = $('#txtCurp'+item).val();
				cargoResponsable = $('#cmbCargo'+item).val();
				llaveResponsable = $('#txtCer'+item).val();
				llaveKey = $('#txtKey'+item).val();
				contraseñaResponsable = $('#txtContraseña'+item).val();
				noCertificado = $('#txtnoCertificado'+item).val();
				if(nombreResponsable == ""){
					mensaje = "Llenar el nombre del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtNombre'+item);
					return false;
				}
				else if(apellidoPaternoResponsable == ""){
					mensaje = "Llenar el apellido paterno del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtApellidoPaterno'+item);
					return false;
				}
				else if(apellidoMaternoResponsable == ""){
					mensaje = "Llenar el apellido materno del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtApellidoMaterno'+item);
					return false;
				}
				else if(curpResponsable == ""){
					mensaje = "Llenar la curp del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtCurp'+item);
					return false;
				}
				else if(!curpValida(curpResponsable)){
					mensaje = "Capturar CURP corretamente en responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtCurp'+item);
					return false;
				}
				else if(cargoResponsable == "0"){
					mensaje = "Seleccionar cargo del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#cmbCargo'+item);
					return false;
				}
				else if(gradoEstudio == "0"){
					mensaje = "Seleccionar grado de estudio del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#cmbGrado'+item);
					return false;
				}
				/*else if(noCertificado == ""){
					mensaje = "LLenar el no. del certificado del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtnoCertificado'+item);
					return false;
				}*/
				else if(llaveResponsable == ""){
					mensaje = "Seleccionar un archivo tipo .CER en llave de resposable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtCer'+item);
					return false;
				}
				else if(llaveKey == ""){
					mensaje = "Seleccionar un archivo tipo .KEY en llave de resposable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtKey'+item);
					return false;
				}
				else if(contraseñaResponsable == ""){
					mensaje = "Llenar contraseña del responsable "+cont;
					dialogo(titulo,mensaje);
					$(location).attr('href','#txtContraseña'+item);
					return false;
				}

			cont++;
			});
			return resultado;
		}

	}
	$('#btnAgregar').click(function(){
		i++;
		var x ="";
		x+='<div class="container-fluid" id="contenidoRepresetante'+i+'">';
		x += '<hr style="width: 100%;  height: 1px; background: black" />';
			x+='<div class="row">';
					x+='<div class="col-md-6">';
						x+='<div class="pull-left">';
							x+='<h5 id="tituloRepresetante'+i+'">Responsable '+(i+1)+'</h5>';
						x+='</div>';
					x+='</div>';
					x+='<div class="col-md-6">';
						x+='<div class="pull-right">';
							x+='<a class="btn btn-social-icon btn-danger btnEliminar" data-numero="'+i+'"><i class="fa fa-remove"></i></a>';
						x+='</div>';
					x+='</div>';
			x+='</div>';
			x+='<div class="row-fluid">';
	        	x+='<div class="form-group col-md-6">';
	              x+='<label for="txtNombre" class="control-label">Nombre</label>';
	                x+='<input type="text" class="form-control" id="txtNombre'+i+'" name="nombre'+i+'" placeholder="Nombre">';
	            x+='</div>';

	            x+='<div class="form-group col-md-6">';
	              x+='<label for="txtApellidoPaterno" class="control-label">Apellido Paterno</label>';
	                x+='<input type="text" class="form-control" id="txtApellidoPaterno'+i+'" name="apellidoPaterno'+i+'" placeholder="Apellido paterno">';
	            x+='</div>';
	        x+='</div>';

	        x+='<div class="row-fluid">';
	        	x+='<div class="form-group col-md-6">';
	              x+='<label for="txtApellidoMaterno" class="control-label">Apellido Materno</label>';
	                x+='<input type="text" class="form-control" id="txtApellidoMaterno'+i+'" name="apellidoMaterno'+i+'" placeholder="Apellido materno">';
	            x+='</div>';

	            x+='<div class="form-group col-md-6">';
	              x+='<label for="txtCurp" class="control-label">CURP</label>';
	                x+='<input type="text" class="form-control" id="txtCurp'+i+'" name="curp'+i+'" placeholder="CURP">';
	            x+='</div>';
	        x+='</div>';

	         x+='<div class="row-fluid">';
	        	x+='<div class="form-group col-md-6">';
	             x+=' <label for="cmbCargo" class="control-label">Cargo</label>';
	                x+='<select name="cargo'+i+'" class="form-control" id="cmbCargo'+i+'">';
	                   x+=' <option value="0">SELECCIONE UNA OPCIÓN</option>';
	                x+='</select>';
	           x+=' </div>';
	            x+='<div class="form-group col-md-6">';
	              x+='<label for="cmbGrado" class="control-label">Abreviatura para Título o Grado de Estudio (Opcional)</label>';
	               x+=' <select name="gradoEstudio'+i+'" class="form-control" id="cmbGrado'+i+'">';
	                   x+=' <option value="0">SELECCIONE UNA OPCIÓN</option>';
	                  
	                x+='</select>';
	            x+='</div>';

	           
	        x+='</div>';

	         x+='<div class="row-fluid">';
	         	x+='<div class="form-group col-md-6">';
	            x+='  <label for="txtCer" class="control-label">Llave Pública (Archivo .CER)</label>';
	               x+=' <input type="file" accept=".cer" class="form-control" id="txtCer'+i+'" name="cer'+i+'" placeholder="CURP">';
	           x+=' </div>';
	           x+=' <div class="form-group col-md-6">';
	             x+=' <label for="txtKey" class="control-label">Llave Pública (Archivo .KEY)</label>';
	                x+='<input type="file" accept=".key" class="form-control" id="txtKey'+i+'" name="key'+i+'" placeholder="CURP">';
	           x+=' </div>';
	            
	        x+='</div>';
	        x+=' <div class="row-fluid">';
	          x+=' <div class="form-group col-md-6">';
	          		x+='<input type="text" style="opacity: 0;position: absolute;">';
	              x+='<label for="txtContraseña" class="control-label">Contraseña</label>';
	                x+='<input type="password" autocomplete="new-password" class="form-control" id="txtContraseña'+i+'" name="contraseña'+i+'" placeholder="CONTRASEÑA">';
	            x+='</div>';
	            x+='<div class="form-group col-md-6">';
                 // x+='<label for="txtnoCertificado'+i+'" class="control-label">No. Certificado</label>';
                 //   x+='<input type="text" class="form-control" id="txtnoCertificado'+i+'" name="noCertificadoResponsable'+i+'" placeholder="No. certificado">';
                x+='</div>';
	        x+='</div>';
	     x+='</div>';
        $('.nuevaFirma').append(x);
        arregloNumeros.push(i);
        //console.log("el arreglo:  "+ arregloNumeros);
        //console.log("------------------------------");
        obtenerCargos();
        obtenerEstudios();
        recomodarTitulos()
	});
	function obtenerCargos(id){
		$.ajax({
	        url:base_url+"index.php/Inicio/obtenerTodosCargos/",
	        type:"POST",
	        beforeSend: function(){
	        	alertCargando.open();
	        },
            success:function(respuesta){
               respuesta = JSON.parse(respuesta);
               var x = "";
               $.each(respuesta,function(index, item){
					x='<option value="'+item['id']+'">'+item['cargo_firmante']+'</option>';
					$('#cmbCargo'+i).append(x);
				});
	          
	        },error:function(jqXHR, textStatus, errorThrown){
                console.log('error:: '+ errorThrown);
            },
            complete: function(){
	            alertCargando.close();

	         }
	    });
	}
	function obtenerEstudios(id){
		$.ajax({
	        url:base_url+"index.php/Inicio/obtenerEstudios/",
	        type:"POST",
	        beforeSend: function(){
	        	alertCargando.open();
	        },
            success:function(respuesta){
               respuesta = JSON.parse(respuesta);
               var x = "";
               $.each(respuesta,function(index, item){
					x='<option value="'+item['id']+'">'+item['abreviatura']+'</option>';
					$('#cmbGrado'+i).append(x);
				});
	          
	        },error:function(jqXHR, textStatus, errorThrown){
                console.log('error:: '+ errorThrown);
            },
            complete: function(){
	            alertCargando.close();

	         }
	    });
	}
	//Funcion de enviar formulario
	$('#btnEnviar').click(function(){
		var val = validaciones();
		if(val){
			var formData = new FormData($("#formulario")[0]);
			formData.append('folio', "2015030691");
			formData.append('nombreArchivo', "juan");
			arregloNumeros.forEach(function (elemento, indice, arregloNumeros) {
                   formData.append('numeros[]', elemento);
                 });
   			$.ajax({
		        url: base_url+"index.php/Inicio/generarXml/",
		        type:"POST",
		        data:formData,
		        cache:false,
		        contentType:false,
		        processData:false,
		        beforeSend: function(){
		          alertEnviando.open();
		        },
		        success:function (data)
		        {
		        	//alert(base_url+"index.php/Inicio/prueba/"+data);
		        	//$("#formulario")[0].reset();
		        	limpiar();
		        	window.location=base_url+"index.php/Inicio/prueba/"+data
		        	 /*BootstrapDialog.show({
		                title: 'PRUEBAS ESTAMOS TRABAJANDO',
		                message: data
		            });*/
		           /* BootstrapDialog.show({
			            title: 'Datos',
			            message:'<form action="#" method="post" style="width:100%; height:100%;">'
			                     +'<div class="row">'
			                        +'<div class="form-group col-md-12">'
			                          +'<label for="txtNombreArchivo">Nombre archivo:</label>'
			                          +'<input type="text" name="nombre" id="txtNombreArchivo" value="'+$('#txtCurpProfeccionista').val()+'" class="form-control" placeholder="Ingresar nombre archivo">'
			                        +'</div>'
			                      +'</div>'
			                    +'</form>',
			            buttons: [{
					                label: 'Cerrar',
					                cssClass: 'btn-danger',
					                action: function(dialogItself) {
					                    dialogItself.close();
					                }
					            },
					            	{
					                label: 'Descargar',
					                cssClass: 'btn-primary',
					                action: function(dialogItself) { 
					                	
					                	var nombreArchivo = $("#txtNombreArchivo").val();
			                       		var titulo = "Falta campos por llenar";
			                       		var mensaje = "";
			                       		if(nombreArchivo == ""){
			                       			mensaje = "Llenar nombre del archivo";
											dialogo(titulo,mensaje);
			                       		}
			                       		else{//-Quiere decir que todo es correcto y continuara con el proceso
			                       			window.location=base_url+"index.php/Inicio/prueba/"+nombreArchivo;
			                       		}
			                       		dialogItself.close();
					                }
					            }]
			        });*/
		        },error:function(jqXHR, textStatus, errorThrown){
		            console.log('error:: '+ errorThrown);
		        },
		        complete: function(){
		          alertEnviando.close();

		        }
		    });	
		}
		
    });
    function recomodarTitulos(){
    	var x= "";
    	var cont=2;
    	$.each(arregloNumeros,function(index, item){
    		x = "Responsable "+cont;
			$("#tituloRepresetante"+item).html('');
			$("#tituloRepresetante"+item).append(x);
			cont++;
		});
		//console.log("xd");
    }
    //Función para validar una CURP
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
    $(".nuevaFirma").delegate(".btnEliminar","click", function() {
    	var doc = $(this);
    	var numero = doc.data('numero');
    	BootstrapDialog.confirm({
	        title: 'Advertencia',
	        message: 'Los datos capturados en este represetante seran eliminados ¿Desea continuar?',
	        type: BootstrapDialog.TYPE_DANGER, 
	        btnCancelLabel: 'Cancelar', 
	        btnOKLabel: 'Continuar', 
	        btnOKClass: 'btn-danger', 
	        callback: function(result) {
	        	if(result){
	        		$('#contenidoRepresetante'+numero).html('');
	        		$.each(arregloNumeros,function(index, item){
						if(item == numero){
							arregloNumeros.splice(index,1);
						}
					});
	        		
	        		recomodarTitulos();
	        	}
	        }
	    });
    });
    function validarIn(clave){
	    var regex = /^[a-zA-Z0-9]{7,8}$/;
	    return regex.test(clave) ? true : false;
	}
    var some_id = $('#contraseña');
    some_id.prop('type', 'text');
    some_id.removeAttr('autocomplete');
});
</script>
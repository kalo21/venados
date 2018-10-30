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
                        <h1 class="text-justify">Capturar</h1>
                        <!--<small id="verDocumentacion"><cite title="Source Title"><strong>Dar clic para ver la información requerida</strong></cite></small>-->
                    </blockquote>
               </div>
               <div class="row">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-file"></i>  Formulario</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div class="alert alert-danger" hidden id="msg-error" style="text-align:left;">
                          <strong>¡Importante!</strong> Corregir los siguientes errores.
                          <div class="list-errors">
                            
                          </div>
                      </div>
                     <h3>Firmas de Responsables</h3>
                     <div class="container-fluid">
                      <?php
                      $contador = 1;
                      foreach($firmantes as $firmas){ ?>
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="pull-left">  
                              <h5>Responsable <?php echo $contador;?></h5>
                            </div>
                          </div>
                        </div>
                        <div class="row-fluid">
                            <div class="form-group col-md-8">
                              <label for="txtNombre" class="control-label Letras">Nombre completo</label>
                                <input type="text" value="<?php echo $firmas->nombre.' '.$firmas->apellido_paterno.' '.$firmas->apellido_materno;?>" disabled class="form-control" id="txtNombre" name="nombre" placeholder="Nombre completo">
                            </div>

                            <div class="form-group col-md-2">
                              <label for="txtApellidoPaterno" class="control-label">Cargo</label>
                                <input type="text" disabled value="<?php echo $firmas->cargo_firmante;?>" class="form-control Letras" id="txtApellidoPaterno" name="apellidoPaterno" placeholder="Cargo">
                            </div>
                            <div class="form-group col-md-2">
                              <label for="txtApellidoPaterno" class="control-label">Abreviatura</label>
                                <input type="text" disabled  value="<?php echo $firmas->abreviatura;?>" class="form-control Letras" id="txtApellidoPaterno" name="apellidoPaterno" placeholder="Abreviatura">
                            </div>
                        </div> 
                        <?php
                        $contador ++;
                      }?>
                                     
                      </div>
                    <form id="formulario">
                      <div class="container-fluid">
                        <br>
                        <hr style="width: 100%;  height: 1px; background: black;" />
                          <h3>Datos de la Carrera  a Titular</h3>
                          <br>
                         <div class="row-fluid">
                          <div class="form-group col-md-6">
                            <label for="cmbCarrera" class="control-label">Carrera</label>
                              <select name="carrera" class="form-control" id="cmbCarrera">
                                  <option value="0">SELECCIONE UNA OPCIÓN</option>
                                  <?php
                                    foreach($carreras as $carrera){
                                      echo '<option value="'.$carrera->id.'">'.$carrera->nombre.'</option>';
                                    }
                                  ?>
                              </select>
                          </div>
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

                        </div>

                        <div class="row-fluid">
                          <div class='col-md-6'>
                              <div class="form-group">
                                <label for="txtFechaTerminacion" class="control-label">Fecha de Inicio de la Carrera </label>
                                  <div class='input-group date' id='txtfechaInicio'>
                                      <input type='text' name="fechainicio" class="form-control" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <div class='col-md-6'>
                              <div class="form-group">
                                 <label for="txtFechaTerminacion" class="control-label">Fecha de Terminación de la Carrera</label>
                                  <div class='input-group date' id="txtFechaTerminacion">
                                      <input type='text' name="fechaterminacion" class="form-control" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>


                      <div class="container-fluid">
                         <hr style="width: 100%;  height: 1px;  background: black;" />
                          <h3>Datos del Profesionista</h3>
                          <br>

                          <div class="row-fluid form-group">
                            <div class="form-group col-md-6">
                              <label for="txtNombreProfeccionista" class="control-label">Nombre</label>
                                <input type="text" class="form-control Letras" id="txtNombreProfeccionista" name="nombreProfeccionista" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-6">
                              <label for="txtApellidoPaternoProfeccionista" class="control-label">Apellido Paterno</label>
                                <input type="text" class="form-control Letras" id="txtApellidoPaternoProfeccionista" name="apellidoPaternoProfeccionista" placeholder="Apellido paterno">
                            </div>
                          </div>

                          <div class="row-fluid form-group">
                            <div class="form-group col-md-6">
                              <label for="txtApellidoMaternoProfeccionista" class="control-label">Apellido Materno</label>
                                <input type="text" class="form-control Letras" id="txtApellidoMaternoProfeccionista" name="apellidoMaternoProfeccionista" placeholder="Apellido materno">
                            </div>

                            <div class="form-group col-md-6">
                              <label for="txtCurpProfeccionista" class="control-label">CURP</label>
                                <input type="text" class="form-control LetrasNumeros" id="txtCurpProfeccionista" name="curpProfeccionista" placeholder="CURP">
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
                          <hr style="width: 100%;  height: 1px;  background: black;" />
                          <h3>Datos de Expedición del Título Electrónico</h3>
                          <br>

                          

                          <div class="row-fluid form-group">
                            <div class='col-md-6'>
                              <div class="form-group">
                                <label for="txtFechaExamen" class="control-label">Fecha de Examen Profesional </label>
                                  <div class='input-group date' id='txtFechaExamen'>
                                      <input type='text' name="fechaexamen" id="inpFechaExamen" class="form-control" />
                                      <span class="input-group-addon" id="btnFechaExamen">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                            </div>
                            <div class='col-md-6'>
                              <div class="form-group">
                                <label for="txtfechaExencionExamen" class="control-label">Fecha de Exención de Examen Profesional </label>
                                  <div class='input-group date' id='txtfechaExencionExamen'>
                                      <input type='text' name="fechaexencion"  id="inpfechaExencionExamen" class="form-control" />
                                      <span class="input-group-addon" id="btnfechaExencionExamen">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                            </div>
                 
                          </div>
                           <div class="row-fluid form-group">
                            <div class="form-group col-md-6">
                              <label for="cmbServicio" class="control-label">Cumplió con el Servicio Social</label>
                                <select name="servicio" class="form-control" id="cmbServicio">
                                    <option value="">SELECCIONE UNA OPCIÓN</option>
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>
                                    
                                </select>
                            </div>
                              <div class="form-group col-md-6">
                                <label for="cmbFundamento" class="control-label">Fundamento Legal de Servicio Social</label>
                                  <select name="fundamento" disabled class="form-control" id="cmbFundamento">
                                      <option value="">SELECCIONE UNA OPCIÓN</option>
                                       <?php
                                        foreach($fundamentos as $fundamento){
                                          echo '<option value="'.$fundamento->id.'">'.$fundamento->nombre.'</option>';
                                        }
                                      ?>
                                  </select>
                              </div>
                  
                          </div>        
                      </div>

                      <div class="container-fluid">
                          <hr style="width: 100%;  height: 1px; background: black;" />
                          <h3>Antecedentes del programa a titular</h3>
                          <br>

                          <div class="row-fluid form-group">
                            <div class="form-group col-md-6">
                              <label for="txtInstitucionAntecedentes" class="control-label">Institución</label>
                              <select name="institucionAntecedentes" class="form-control" id="txtInstitucionAntecedente">
                                    <option value="">SELECCIONE UNA OPCIÓN</option>
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
                                    <option value="">SELECCIONE UNA OPCIÓN</option>
                                     <?php
                                      foreach($entidades as $entidad){
                                        echo '<option value="'.$entidad->id.'">'.$entidad->nombre.'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                          </div>

                          <div class="row-fluid">
                            <div class="form-group col-md-6">
                              <label for="cmbTipoEstudioAntecedentes" class="control-label">Nivel de Estudios</label>
                                <select name="tipoEstudioAntecedentes" class="form-control" id="cmbTipoEstudioAntecedentes">
                                    <option value="">SELECCIONE UNA OPCIÓN</option>
                                     <?php
                                      foreach($antecedentes as $antecedente){
                                        echo '<option value="'.$antecedente->id.'">'.$antecedente->tipo_estudio.'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtnoCedula" class="control-label">No. Cedula </label>
                                <input type="text" class="form-control LetrasNumeros" id="txtnoCedula" name="noCedula" placeholder="NÚMERO DE CEDULA">
                            </div>
                            

                          </div>

                          <div class="row-fluid">
                          	<div class='col-md-6'>
                              <div class="form-group">
                                <label for="txtFechaInicioAntecedentes" class="control-label">Fecha Inicio</label>
                                  <div class='input-group date' id='txtFechaInicioAntecedentes'>
                                      <input type='text' name="fechainicioantecedentes"class="form-control" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                            </div>
                            
                            <div class='col-md-6'>
                              <div class="form-group">
                                <label for="txtFechaTerminacionAntecedente" class="control-label">Fecha Terminación</label>
                                  <div class='input-group date' id='txtFechaTerminacionAntecedente'>
                                      <input type='text' name="fechaterminacionantecedente" class="form-control" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                            </div>
                            
                          </div>
                          <div class="row-fluid">
                            <div class="form-group pull-right">
                              <button id="btnEnviar" class="btn btn-success btn-lg" type="button">Generar XML</button>
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
<!--<div class="block" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 8000;opacity: .8; background-color: black;">-->
    
    
   
<!--</div>-->

<?php $this->load->view('Global/footer')?>

<script type="text/javascript">
  $(document).ready(function(){
    var firmas = "<?php echo $totalFirmas;?>";

    if(firmas == "0"){
      BootstrapDialog.alert({
              title: 'Registrar firmas',
              message: 'Para poder acceder a este modulo es necesario contar con al menos una firma registrada, sera enviado al modulo para capturar firmas !',
              type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
              closable: false, // <-- Default value is false
              draggable: true, // <-- Default value is false
              buttonLabel: 'Ok entiendo', // <-- Default value is 'OK',
              callback: function(result) {
                  window.location.href = base_url+"index.php/instituciones/firmas";
              }
          });
    }

    $('#txtfechaInicio').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD'

    });
    $('#txtFechaTerminacion').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
      useCurrent: false

    });
    $("#txtfechaInicio").on("dp.change", function (e) {
        $('#txtFechaTerminacion').data("DateTimePicker").minDate(e.date);
        $('#txtFechaExamen').data("DateTimePicker").minDate(e.date);
        $('#txtfechaExencionExamen').data("DateTimePicker").minDate(e.date);
        $('#txtFechaInicioAntecedentes').data("DateTimePicker").maxDate(e.date);
        $('#txtFechaTerminacionAntecedente').data("DateTimePicker").maxDate(e.date);
        

        
    });
    $("#txtFechaTerminacion").on("dp.change", function (e) {
        $('#txtfechaInicio').data("DateTimePicker").maxDate(e.date);
    });

    $("#txtFechaInicioAntecedentes").on("dp.change", function (e) {
        $('#txtFechaTerminacionAntecedente').data("DateTimePicker").minDate(e.date);

    });
    
    $("#txtFechaTerminacionAntecedente").on("dp.change", function (e) {
        $('#txtFechaInicioAntecedentes').data("DateTimePicker").maxDate(e.date);
    });

    $("#txtFechaExamen").on("dp.change", function (e) {
        $("#btnfechaExencionExamen").attr("disabled",true);
        $("#inpfechaExencionExamen").attr("disabled",true);
    });
    $("#txtfechaExencionExamen").on("dp.change", function (e) {
        $("#btnFechaExamen").attr("disabled",true);
        $("#inpFechaExamen").attr("disabled",true);
    });


    $('#txtFechaExamen').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
      useCurrent: false

    });
    
    $('#txtfechaExencionExamen').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
      useCurrent: false

    });
    $('#txtFechaInicioAntecedentes').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
      useCurrent: false

    });
    $('#txtFechaTerminacionAntecedente').datetimepicker({
      locale: 'es',
      format: 'YYYY-MM-DD',
      useCurrent: false

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
    $('#btnEnviar').click(function(){
        if(!curpValida($('#txtCurpProfeccionista').val())){
          $('#msg-error').show();
          $('.list-errors').html('<li>CURP inválida</li>');
          $(location).attr('href','#msg-error');
        }
        else if(!validarIn($('#txtnoCedula').val()) && $('#txtnoCedula').val() != ""){
          $('#msg-error').show();
          $('.list-errors').html('<li>La cedula profesional debe de contener 7 o 8 digitos</li>');
          $(location).attr('href','#msg-error');
        }
        else if($('#cmbServicio').val() == "2"){
          $('#msg-error').show();
          $('.list-errors').html('<li>Es imposible continuar, el profesionista debe de cumplir con el servicio social</li>');
          $(location).attr('href','#msg-error');
        }
        else{
          alert("aca");
          var formData = new FormData($("#formulario")[0]);
          $.ajax({
              url: base_url+"index.php/Instituciones/generarXML/",
              type:"POST",
              data:formData,
              cache:false,
              contentType:false,
              processData:false,
              beforeSend: function(){
                //alertEnviando.open();
              },
              success:function (data)
              {
                console.log(data);
                //$("#formulario")[0].reset();
               //limpiar();
                //window.location=base_url+"index.php/Inicio/prueba/"+data
                 
              },error:function(jqXHR, textStatus, errorThrown){
                  console.log('error:: '+ errorThrown);
              },
              complete: function(){
                //alertEnviando.close();

              }
          }); 
        }
        
    });

    function validarIn(clave){
        var regex = /^[a-zA-Z0-9]{7,8}$/;
        return regex.test(clave) ? true : false;
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


  });
</script>
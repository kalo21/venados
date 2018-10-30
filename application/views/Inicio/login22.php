<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/almacen.png">
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
<!--===============================================================================================-->
	<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
<!--===============================================================================================-->
	
	<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css'); ?>">

<!--===============================================================================================-->	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/hamburgers.min.css'); ?>">
<!--===============================================================================================-->
	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css'); ?>">
<!--===============================================================================================-->

<link rel="stylesheet" href="<?php echo base_url('assets/css/util.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url();?>assets/images/almacen.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="login">

					<div class="col-md-12"  id="error">
				      <div class="box box-danger box-solid">
				        <div class="box-header with-border">
				          <h4 class="box-title text-center">Inicio de sesión fallido</h4>
				        </div>
				        <div class="box-body text-center" style="color:red;" id="contenido">
				          
				        </div>
				      </div>
				    </div>
					<span class="login100-form-title">
						Inicio de sesión
					</span>
					
					<div class="wrap-input100 validate-input" id="erroru" data-validate = "El usuario es requerido">
						<input class="input100" type="text" name="usuario" placeholder="Usuario" id="usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" id="errorc" data-validate = "Contraseña es requerida">
						<input class="input100" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" id="btnInicio">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Olvido
						</span>
						<a class="txt2" href="#">
							Usuario / Contraseña?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Crear cuenta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
	
<!--===============================================================================================-->
	
	<script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/js/tilt.jquery.min.js'); ?>"></script>
	
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

</body>
</html>
<script>
  $(document).ready(function(){
    var base_url = '<?php echo base_url(); ?>';
  	$("#error").hide();
    $('#olvidar').click(function(){
      BootstrapDialog.confirm({
              title: '¿Olvidaste tu contraseña?',
              message: 'Si olvidaste tu contraseña o no tienes acceso a tu cuenta, avisar al correo del soporte',
              type: BootstrapDialog.TYPE_INFO, 
              btnCancelLabel: 'Cancelar', 
              callback: function(result) {
                
              }
          });
    }); 
    $('#btnInicio').click(function(){
    	var x="";
      if($('#contraseña').val() == ""){
      	var thisAlert = $('#contraseña').parent();
        $(thisAlert).addClass('alert-validate');
        $(location).attr('href','#contraseña');
        $("#error").show();
        x += "<li>Ingresar una contraseña</li>";
        
        $('#errorc').addClass('alert-validate');
      }
      if($('#contraseña').val() != ""){
      	
      	$('#errorc').removeClass('alert-validate');
      }
      if($('#usuario').val() == ""){
        $(location).attr('href','#usuario');
        $("#error").show();
        x += "<li>Ingresar un usuario</li>";
       
       
        $('#erroru').addClass('alert-validate');

      }
      if($('#usuario').val() != ""){
      	$('#erroru').removeClass('alert-validate');
      }
      $("#contenido").html(x);
      if($('#usuario').val() != "" && $('#contraseña').val() != "" ){
          var formData = new FormData($("#login")[0]);
          $.ajax({
              url:base_url+"index.php/Inicio/ingresar/",
              type:"POST",
              data:formData,
              cache:false,
              contentType:false,
              processData:false,
                success:function(respuesta){
                  if (respuesta) {
                  	$("#error").hide();
                    //console.log(respuesta);
                  	 
                    window.location.href = base_url+'index.php/Inicio/index';
                      
                
                  }
                  else{
                     var x = "<li>El usuario ó contraseña invalido.</li>";
                     $("#error").show();
			      	 $("#contenido").html(x);
                  }
                  
              }
          });
      }
    });
  });
  $('#usuario').keyup(function (e) {
      if (e.keyCode === 13) {
        if($('#contraseña').val() == ""){
          $(location).attr('href','#contraseña');
        }
        else{
          $( "#btnInicio" ).trigger( "click" );
        } 
      }
    });
    $('#contraseña').keyup(function (e) {
      if (e.keyCode === 13) {
        if($('#usuario').val() == ""){
          $(location).attr('href','#usuario');
        }
        else{
          $( "#btnInicio" ).trigger( "click" );
        } 
      }
    });
</script>
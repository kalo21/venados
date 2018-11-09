<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | VenadoSnacks</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<!--===============================================================================================-->
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-v.jpg">
<style>
	#load { height: 100%; width: 100%; }
	#load {
	  position    : fixed;
	  z-index     : 99999; /* or higher if necessary */
	  top         : 0;
	  left        : 0;
	  overflow    : hidden;
	  /*text-indent : 100%;*/
	  text-align: center;
	  font-family: Poppins-Regular;
	  color: white;
	  font-size   : 40px;
	  opacity     : 0.8;
	  background  : #000  url(<?php echo base_url('assets/images/carga.gif');?>) center no-repeat;
	}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="frmLogin">
					<span class="login100-form-logo">
						<i class="fa fa-users"></i>
						<!--<img class="" src="images/logo.jpg" alt="aa" style="width: 100%;">-->
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Inicio de sesión
					</span>
					<div class="col-12">
						
					</div>
					<div id="divUsuario" class="wrap-input100 validate-input" data-validate = "El usuario es requerido">
						<input class="input100" type="text" name="inpUsuario" id="inpUsuario" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div id="divContrasena" class="wrap-input100 validate-input" data-validate="Contraseña es requerida">
						<input class="input100" type="password" name="inpContrasena" id="inpContrasena" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div id="error" hidden class="contact100-form-checkbox" >
						<!--<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
						<label  id="msg-error" class="label-error text-center border">
							Usuario/Contraseña incorrecta
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="button" id="btnInicio" class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-40" >
						<a id="olvContra" class="txt1">
							Olvido Usuario / Contraseña?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/main.js"></script>
<div hidden id="load" >Iniciando sesión ...</div>
</body>
</html>
<script>
	$(document).ajaxStart(function() {$('#load').show();});
	$(document).ajaxStop(function() {$('#load').hide();});
	$(document).ready(function(){
		var base_url = "<?php echo base_url();?>";
		$('#olvContra').click(function(){
			alert('click');
		});
		$('#inpUsuario').keyup(function(e) {
			if(e.keyCode === 13) {
				if($('#inpContrasena').val() == "") {
					$('#inpContrasena').focus();
				}
				else {
					$('#btnInicio').trigger('click');
				}
			}
		});
		$('#inpContrasena').keyup(function(e) {
			if(e.keyCode === 13) {
				if($('#inpUsuario').val() == "") {
					$('#inpUsuario').focus();
				}
				else {
					$('#btnInicio').trigger('click');
				}
			}
		});
		$('#btnInicio').click(function(){
			if($('#inpContrasena').val() == "") {
				$(location).attr('href', '#inpContrasena');
				$('#divContrasena').addClass('alert-validate');
			}
			if($('#inpContrasena').val() != "") {
				$('#divContrasena').removeClass('alert-validate');
			}
			if($('#inpUsuario').val() == "") {
				$(location).attr('href', '#inpUsuario');
				$('#divUsuario').addClass('alert-validate');
			}
			if($('#inpUsuario').val() != "") {
				$('#divUsuario').removeClass('alert-validate');
			}
			if($('#inpUsuario').val() != "" && $('#inpContrasena').val() != "") {
				$('#error').hide();
				$.ajax({
					url: base_url+'index.php/Inicio/ingresar',
					method:'post',
					data: $('#frmLogin').serialize(),
					success: function(data) {
						data =  JSON.parse(data);
						console.log(data);
						if(data['code']) {
							$('#error').show();
							$('#msg-error').html(data['message']);
							window.location.href = base_url;
						}
						else if(!data['code']){
							$('#error').show();
							$('#msg-error').html(data['message']);
						}
					}
				});
			}
		});
	});
</script>
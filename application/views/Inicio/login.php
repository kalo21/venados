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
	.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {

	position: relative;
	min-height: 1px;
	padding-right: 0px;
	padding-left: 0px;

	}
	@media only screen and (min-width: 800px) {
		.logomitad{
			display: none;
		}
	}
	/* #ecf0f5 */
</style>
</head>
<body>
	<div class="col-md-6 hidden-xs hidden-sm" style="display: flex; align-items: center; justify-content : center;  background: #f6032f;
								background: -webkit-linear-gradient(top, #f6032f, #7b1821);
								background: -o-linear-gradient(top, #f6032f, #7b1821);
								background: -moz-linear-gradient(top, #f6032f, #7b1821); 
								background: linear-gradient(top, #f6032f, #7b1821); height : 100%;" id="logomitad">
		<img height='350' src="<?= base_url('assets/images/logoch.png');?>" alt="">
		
	</div>
	<div class="col-md-6">
		<div class="limiter">
			<div class="container-login100" style="background-color: #ecf0f5; height : 100%;">
				<div class="wrap-login100" >
					<form class="login100-form validate-form" id="frmLogin">
						<span class="login100-form-logo hidden-lg hidden-md">
							<i class="fa fa-users"></i>
						</span>

						<span class="login100-form-title p-b-34 p-t-27">
							Inicio de sesión
						</span>
						<!-- <div class="col-12">
							hola
						</div> -->
						<div id="divUsuario" class="wrap-input100 validate-input" data-validate = "El usuario es requerido">
							<input class="input100" type="text" name="inpUsuario" id="inpUsuario" placeholder="Usuario">
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>

						<div id="divContrasena" class="wrap-input100 validate-input" data-validate="Contraseña es requerida">
							<input class="input100" type="password" name="inpContrasena" id="inpContrasena" placeholder="Contraseña">
							<span class="focus-input100" data-placeholder="&#xf191;"></span>
						</div>

						<div id="error" hidden class="contact100-form-checkbox" >
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
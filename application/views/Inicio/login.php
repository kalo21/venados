<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TítuloElectrónico | Iniciar Sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
   <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE1.min.css'); ?>">
  <!-- iCheck -->
  <!--<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">-->


<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/icono.png">
</head>

<body class="hold-transition login-page">
<div class="login-box">
	<div class="col-md-12" hidden id="error">
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-center">Inicio de sesión fallido</h3>
        </div>
        <div class="box-body" id="contenido">
          
        </div>
      </div>
    </div>
  <div class="login-logo">
    <img style="width:80%" src="<?php echo base_url();?>/assets/images/sepycsinfondo.png" alt="">
    <a href="#"><b>TÍTULO</b>ELECTRÓNICO</a>
  </div>
  

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos para inicar sesión</p>

    <form id="login" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!--<input type="checkbox"> Recordar contraseña-->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="btnInicio">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->

    <a href="#" id="olvidar">Olvide mi contraseña</a><br>
    <!--<a href="register.html" class="text-center">Registra una nueva cuenta</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/js/jquery.sparkline.min.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/js/jquery.knob.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-checkbox.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-filestyle.min.js'); ?>"></script>
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
      if($('#usuario').val() == ""){
        $(location).attr('href','#usuario');
        $("#error").show();
        var x = "<li>Ingresar un usuario</li>";
        $("#contenido").html(x);


      }
      else if($('#contraseña').val() == ""){
        $(location).attr('href','#contraseña');
        $("#error").show();
        var x = "<li>Ingresar una contraseña</li>";
        $("#contenido").html(x);
      }
      else{
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
</body>
</html>

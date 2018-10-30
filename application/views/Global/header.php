<!DOCTYPE html>
<html>
<head>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>venados</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url('assets/css/carga.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-dialog.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE1.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-red-light.css'); ?>">
  


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  
  
   <link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css'); ?>">
   
  
   <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-v.jpg">
   <style>
       
       .btn-rojo {
          color: #fff;
          background-color: #f6032f;
          border-color: #f6032f;
        }

        .btn-rojo:hover {
          color: #fff;
          background-color: #c82333;
          border-color: #bd2130;
        }

        .btn-rojo:focus, .btn-rojo.focus {
          box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
        }

        .btn-rojo.disabled, .btn-danger:disabled {
          color: #fff;
          background-color: #f6032f;
          border-color: #f6032f;
        }

        .btn-rojo:not(:disabled):not(.disabled):active, .btn-rojo:not(:disabled):not(.disabled).active,
        .show > .btn-rojo.dropdown-toggle {
          color: #fff;
          background-color: #bd2130;
          border-color: #b21f2d;
        }

        .btn-rojo:not(:disabled):not(.disabled):active:focus, .btn-rojo:not(:disabled):not(.disabled).active:focus,
        .show > .btn-rojo.dropdown-toggle:focus {
          box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
        }
       
       .btn-outline-rojo {
          color: #f6032f !important;
          background-color: white !important;
          background-image: none !important;
          border-color: #f6032f !important;
        }

        .btn-outline-rojo:hover {
          color: #fff !important;
          background-color: #f6032f !important;
          border-color: #f6032f !important;
        }

        .btn-outline-rojo:focus, .btn-outline-rojo.focus {
          box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5) !important;
        }

        .btn-outline-rojo.disabled, .btn-outline-rojo:disabled {
          color: #f6032f !important;
          background-color: transparent !important;
        }

        .btn-outline-rojo:not(:disabled):not(.disabled):active, .btn-outline-rojo:not(:disabled):not(.disabled).active,
        .show > .btn-outline-rojo.dropdown-toggle {
          color: #fff !important;
          background-color: #f6032f !important;
          border-color: #f6032f !important;
        }

        .btn-outline-rojo:not(:disabled):not(.disabled):active:focus, .btn-outline-rojo:not(:disabled):not(.disabled).active:focus,
        .show > .btn-outline-rojo.dropdown-toggle:focus {
          box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5) !important;
        }
        #load { height: 100%; width: 100%; }
          #load {
            position    : fixed;
            z-index     : 99999; /* or higher if necessary */
            top         : 0;
            left        : 0;
            overflow    : hidden;
            text-indent : 100%;
            font-size   : 0;
            opacity     : 0.6;
            background  : #E0E0E0  url(<?php echo base_url('assets/images/carga.gif');?>) center no-repeat;
  }
   </style>
</head>
<body class="hold-transition skin-red-light sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>index.php/Inicio" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>VS</b></span>
      <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>VenadoSnacks</b></span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" >
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>/assets/images/desarollador.png" class="user-image" alt="jjk">
              <span class="hidden-xs">jose</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #264d78;">
              <?php
                function fechaEspañol ($fecha) {
                    $fecha = substr($fecha, 0, 10);
                    $numeroDia = date('d', strtotime($fecha));
                    $dia = date('l', strtotime($fecha));
                    $mes = date('F', strtotime($fecha));
                    $anio = date('Y', strtotime($fecha));
                    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
                    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
                    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
                    return $nombredia." ".$numeroDia." de ".$nombreMes." del ".$anio;
                }
                ?>
                <img src="<?php echo base_url();?>/assets/images/desarrollador.png" class="img-circle" alt="jose">
                <p>
                  jose
                  <small><?php echo fechaEspañol(date('Y-m-d H:i:s', time())); ?><br><span id="hora"></span></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body" style="border: 1px solid #264d78;">
                <div class="row">
                  <div class="col-xs-12 text-center" >
                    <a href="<?php echo base_url();?>">Inicio</a>
                  </div>
                  <!--<div class="col-xs-4 text-center">
                    <a href="#">Ejemplo</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Ejemplo</a>
                  </div>-->
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>index.php/Inicio/salir" class="btn btn-default" style="background-color: #264d78; color: #fff">Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>


      </div>
    </nav>
   
  </header> 
<div id="load" hidden >Please wait ...</div>
      
       <!--<div id="contenedor_carga"> 
    <div id="carga"></div>
</div>-->
  
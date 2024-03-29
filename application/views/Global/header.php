<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo(isset($informacion['titulo'])) ? $informacion['titulo'] : 'VenadoSnacks' ;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/carga.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.css'); ?>">
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
      .mano{
        cursor : pointer;
      }
       
       .nav-tabs-custom > .nav-tabs > li.active {
            border-top-color: #f6032f;
        }
       
       .card {
          position: relative;
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
          -ms-flex-direction: column;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 1px solid rgba(0, 0, 0, 0.125);
          border-radius: 0.25rem;
        }

        .card > hr {
          margin-right: 0;
          margin-left: 0;
        }

        .card > .list-group:first-child .list-group-item:first-child {
          border-top-left-radius: 0.25rem;
          border-top-right-radius: 0.25rem;
        }

        .card > .list-group:last-child .list-group-item:last-child {
          border-bottom-right-radius: 0.25rem;
          border-bottom-left-radius: 0.25rem;
        }

        .card-body {
          -webkit-box-flex: 1;
          -ms-flex: 1 1 auto;
          flex: 1 1 auto;
          padding: 1.25rem;
        }

        .card-title {
          margin-bottom: 0.75rem;
        }

        .card-subtitle {
          margin-top: -0.375rem;
          margin-bottom: 0;
        }

        .card-text:last-child {
          margin-bottom: 0;
        }

        .card-link:hover {
          text-decoration: none;
        }

        .card-link + .card-link {
          margin-left: 1.25rem;
        }

        .card-header {
          padding: 0.75rem 1.25rem;
          margin-bottom: 0;
          background-color: rgba(0, 0, 0, 0.03);
          border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header:first-child {
          border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }

        .card-header + .list-group .list-group-item:first-child {
          border-top: 0;
        }

        .card-footer {
          padding: 0.75rem 1.25rem;
          background-color: rgba(0, 0, 0, 0.03);
          border-top: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-footer:last-child {
          border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
        }

        .card-header-tabs {
          margin-right: -0.625rem;
          margin-bottom: -0.75rem;
          margin-left: -0.625rem;
          border-bottom: 0;
        }

        .card-header-pills {
          margin-right: -0.625rem;
          margin-left: -0.625rem;
        }

        .card-img-overlay {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          padding: 1.25rem;
        }

        .card-img {
          width: 100%;
          border-radius: calc(0.25rem - 1px);
        }

        .card-img-top {
          width: 100%;
          border-top-left-radius: calc(0.25rem - 1px);
          border-top-right-radius: calc(0.25rem - 1px);
        }

        .card-img-bottom {
          width: 100%;
          border-bottom-right-radius: calc(0.25rem - 1px);
          border-bottom-left-radius: calc(0.25rem - 1px);
        }

        .card-deck {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
          -ms-flex-direction: column;
          flex-direction: column;
        }

        .card-deck .card {
          margin-bottom: 15px;
        }

        @media (min-width: 576px) {
          .card-deck {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            margin-right: -15px;
            margin-left: -15px;
          }
          .card-deck .card {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-right: 15px;
            margin-bottom: 0;
            margin-left: 15px;
          }
        }

        .card-group {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
          -ms-flex-direction: column;
          flex-direction: column;
        }

        .card-group > .card {
          margin-bottom: 15px;
        }

        @media (min-width: 576px) {
          .card-group {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
          }
          .card-group > .card {
            -webkit-box-flex: 1;
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            margin-bottom: 0;
          }
          .card-group > .card + .card {
            margin-left: 0;
            border-left: 0;
          }
          .card-group > .card:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
          }
          .card-group > .card:first-child .card-img-top,
          .card-group > .card:first-child .card-header {
            border-top-right-radius: 0;
          }
          .card-group > .card:first-child .card-img-bottom,
          .card-group > .card:first-child .card-footer {
            border-bottom-right-radius: 0;
          }
          .card-group > .card:last-child {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
          }
          .card-group > .card:last-child .card-img-top,
          .card-group > .card:last-child .card-header {
            border-top-left-radius: 0;
          }
          .card-group > .card:last-child .card-img-bottom,
          .card-group > .card:last-child .card-footer {
            border-bottom-left-radius: 0;
          }
          .card-group > .card:only-child {
            border-radius: 0.25rem;
          }
          .card-group > .card:only-child .card-img-top,
          .card-group > .card:only-child .card-header {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
          }
          .card-group > .card:only-child .card-img-bottom,
          .card-group > .card:only-child .card-footer {
            border-bottom-right-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
          }
          .card-group > .card:not(:first-child):not(:last-child):not(:only-child) {
            border-radius: 0;
          }
          .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-top,
          .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,
          .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-header,
          .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-footer {
            border-radius: 0;
          }
        }

        .card-columns .card {
          margin-bottom: 0.75rem;
        }

        @media (min-width: 576px) {
          .card-columns {
            -webkit-column-count: 3;
            -moz-column-count: 3;
            column-count: 3;
            -webkit-column-gap: 1.25rem;
            -moz-column-gap: 1.25rem;
            column-gap: 1.25rem;
          }
          .card-columns .card {
            display: inline-block;
            width: 100%;
          }
        }
       
       .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
            background-color: #f6032f !important;
        }
       
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
          color: #fff;
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
       .modal-header {
            background-color: #f6032f !important;
        }
       .bootstrap-dialog .bootstrap-dialog-title {
            color: #fff !important;
            display: inline-block !important;
            font-size: 24px !important;

        }
       .modal-body {
            position: relative;
            padding: 15px;
            background: #ecf0f5 !important;
        }
       .modal-footer {
            padding: 15px;
            text-align: right;
            border-top: 1px solid #e5e5e5;
            background: #d2d6de !important;
        }

       .valid-feedback {
          display: none;
          width: 100%;
          margin-top: 0.25rem;
          font-size: 80%;
          color: #28a745;
        }

        .valid-tooltip {
          position: absolute;
          top: 100%;
          z-index: 5;
          display: none;
          max-width: 100%;
          padding: .5rem;
          margin-top: .1rem;
          font-size: .875rem;
          line-height: 1;
          color: #fff;
          background-color: rgba(40, 167, 69, 0.8);
          border-radius: .2rem;
        }

        .was-validated .form-control:valid, .form-control.is-valid, .was-validated
        .custom-select:valid,
        .custom-select.is-valid {
          border-color: #28a745;
        }

        .was-validated .form-control:valid:focus, .form-control.is-valid:focus, .was-validated
        .custom-select:valid:focus,
        .custom-select.is-valid:focus {
          border-color: #28a745;
          box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .was-validated .form-control:valid ~ .valid-feedback,
        .was-validated .form-control:valid ~ .valid-tooltip, .form-control.is-valid ~ .valid-feedback,
        .form-control.is-valid ~ .valid-tooltip, .was-validated
        .custom-select:valid ~ .valid-feedback,
        .was-validated
        .custom-select:valid ~ .valid-tooltip,
        .custom-select.is-valid ~ .valid-feedback,
        .custom-select.is-valid ~ .valid-tooltip {
          display: block;
        }

        .was-validated .form-check-input:valid ~ .form-check-label, .form-check-input.is-valid ~ .form-check-label {
          color: #28a745;
        }

        .was-validated .form-check-input:valid ~ .valid-feedback,
        .was-validated .form-check-input:valid ~ .valid-tooltip, .form-check-input.is-valid ~ .valid-feedback,
        .form-check-input.is-valid ~ .valid-tooltip {
          display: block;
        }

        .was-validated .custom-control-input:valid ~ .custom-control-label, .custom-control-input.is-valid ~ .custom-control-label {
          color: #28a745;
        }

        .was-validated .custom-control-input:valid ~ .custom-control-label::before, .custom-control-input.is-valid ~ .custom-control-label::before {
          background-color: #71dd8a;
        }

        .was-validated .custom-control-input:valid ~ .valid-feedback,
        .was-validated .custom-control-input:valid ~ .valid-tooltip, .custom-control-input.is-valid ~ .valid-feedback,
        .custom-control-input.is-valid ~ .valid-tooltip {
          display: block;
        }

        .was-validated .custom-control-input:valid:checked ~ .custom-control-label::before, .custom-control-input.is-valid:checked ~ .custom-control-label::before {
          background-color: #34ce57;
        }

        .was-validated .custom-control-input:valid:focus ~ .custom-control-label::before, .custom-control-input.is-valid:focus ~ .custom-control-label::before {
          box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .invalid-feedback {
          display: none;
          width: 100%;
          margin-top: 0.25rem;
          font-size: 80%;
          color: #dc3545;
        }

        .invalid-tooltip {
          position: absolute;
          top: 100%;
          z-index: 5;
          display: none;
          max-width: 100%;
          padding: .5rem;
          margin-top: .1rem;
          font-size: .875rem;
          line-height: 1;
          color: #fff;
          background-color: rgba(220, 53, 69, 0.8);
          border-radius: .2rem;
        }

        .was-validated .form-control:invalid, .form-control.is-invalid, .was-validated
        .custom-select:invalid,
        .custom-select.is-invalid {
          border-color: #dc3545;
        }

        .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus, .was-validated
        .custom-select:invalid:focus,
        .custom-select.is-invalid:focus {
          border-color: #dc3545;
          box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .was-validated .form-control:invalid ~ .invalid-tooltip, .form-control.is-invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-tooltip, .was-validated
        .custom-select:invalid ~ .invalid-feedback,
        .was-validated
        .custom-select:invalid ~ .invalid-tooltip,
        .custom-select.is-invalid ~ .invalid-feedback,
        .custom-select.is-invalid ~ .invalid-tooltip {
          display: block;
        }

        .was-validated .form-check-input:invalid ~ .form-check-label, .form-check-input.is-invalid ~ .form-check-label {
          color: #dc3545;
        }

        .was-validated .form-check-input:invalid ~ .invalid-feedback,
        .was-validated .form-check-input:invalid ~ .invalid-tooltip, .form-check-input.is-invalid ~ .invalid-feedback,
        .form-check-input.is-invalid ~ .invalid-tooltip {
          display: block;
        }

        .was-validated .custom-control-input:invalid ~ .custom-control-label, .custom-control-input.is-invalid ~ .custom-control-label {
          color: #dc3545;
        }

        .was-validated .custom-control-input:invalid ~ .custom-control-label::before, .custom-control-input.is-invalid ~ .custom-control-label::before {
          background-color: #efa2a9;
        }

        .was-validated .custom-control-input:invalid ~ .invalid-feedback,
        .was-validated .custom-control-input:invalid ~ .invalid-tooltip, .custom-control-input.is-invalid ~ .invalid-feedback,
        .custom-control-input.is-invalid ~ .invalid-tooltip {
          display: block;
        }

        .was-validated .custom-control-input:invalid:checked ~ .custom-control-label::before, .custom-control-input.is-invalid:checked ~ .custom-control-label::before {
          background-color: #e4606d;
        }

        .was-validated .custom-control-input:invalid:focus ~ .custom-control-label::before, .custom-control-input.is-invalid:focus ~ .custom-control-label::before {
          box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

       .pagination > li > a:focus, .pagination > li > a:hover, .pagination > li > a, pagination > li > a, .pagination > li > span:focus, .pagination > li > span:hover {
            z-index: 2;
            color: #000;
            background-color: white;
            border-color: #ddd;

        }
       .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #f6032f;
            border-color: #f6032f;
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
            background  : #000  url(<?php echo base_url('assets/images/carga.gif');?>) center no-repeat;
  }
  .carrito::before{
    content: "\f07a" !important;
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
              <img src="<?php echo base_url(); echo (isset($informacion['imagen'])) ? $informacion['imagen'] : 'hacker.png' ;?>" class="user-image" alt="<?php echo(isset($informacion['imagen'])) ? $informacion['imagen'] : 'No seleccionada' ;?>">
              <span class="hidden-xs"><?php echo(isset($informacion['nombre'])) ? $informacion['nombre'] : 'Infiltrado :o' ;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
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
                <img src="<?= base_url(); echo (isset($informacion['imagen'])) ? $informacion['imagen'] : 'hacker.png' ;?>" class="user-image" alt="<?php echo(isset($informacion['imagen'])) ? $informacion['imagen'] : 'No seleccionada' ;?>" class="img-circle" >
                <p style="color : black;">
                  <?php echo(isset($informacion['nombre'])) ? $informacion['nombre'] : 'Infiltrado :o' ;?>
                  <small><?php echo fechaEspañol(date('Y-m-d H:i:s', time())); ?><br><span id="hora"></span></small>
                  <br>
                  <a href="<?= base_url(); ?>index.php/Inicio/salir" class="btn btn-rojo btn-block" >Salir</a>
                </p>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <?php 
        if($this->session->idPerfil == 4) {
          echo '<a id="carrito" href="'.base_url('index.php/Carrito/').'" class="sidebar-toggle carrito" role="button" style="float: right">
                <span class="sr-only"></span>
                </a>';
        }
      ?>
    </nav>

   
  </header> 
<div id="load" hidden >Please wait ...</div>
      
       <!--<div id="contenedor_carga"> 
    <div id="carga"></div>
</div>-->
  
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">

        <!--<div class="pull-left image">
          <img src="<?php //echo base_url();?>/assets/images/sinaloacuadrado.png" alt="SEPyC" class="img-circle" >
        </div>
        <div class="pull-left info">

          <p>Nombre del usuario</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
        </div>-->
        <div class="text-center">
          <img src="<?= base_url(); ?>/assets/images/logo2.png" alt="Venados" style="width: 40%">
        </div>
        
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú de navegación</li>
        <li style="border-top: 1px solid #ffffff;"><a href="<?= base_url();?>index.php/Inicio/index"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/Empresa"><i class="fa fa-building"></i> <span>Empresa</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/productos"><i class="fa fa-product-hunt"></i> <span>Productos</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/eventos"><i class="fa fa-user-circle"></i> <span>Eventos</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/Inicio/salir"><i class="fa fa-shopping-cart"></i> <span>Pedidos</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/Usuarios"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/perfiles"><i class="fa fa-user-circle"></i> <span>Perfiles</span></a></li>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/modulos"><i class="fa fa-th-large "></i> <span>Módulos</span></a></li>
        <li style="border-top: 1px solid #ffffff;"><a href="<?= base_url();?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <?php
            if(isset($modulos)){
                foreach ($modulos as $modulo) {
                    echo '<li style="border-top: 1px solid #ffffff;">';
                    echo  '<a href="'.base_url().$modulo->ruta.'">';
                    echo    '<i class="'.$modulo->icono.'"></i>';
                    echo    '<span>'.$modulo->nombre.'</span>';
                    echo  '</a>';
                    echo'</li>';
                }
            }
        ?>
        <li style="border-top: 1px solid #ffffff;" ><a href="<?= base_url();?>index.php/Inicio/salir"><i class="fa fa-power-off"></i> <span>Salir</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



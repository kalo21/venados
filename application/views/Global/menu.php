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



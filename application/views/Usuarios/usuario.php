<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
               
                <h3 class="text-center">Usuarios</h3>
            </div>
        </div>
        
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-8"><input type="text" class="form-control" id="NombreEmpresa"></div>        
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Contrasena</label>
                <div class="col-sm-8"><input type="password" class="form-control" id="RazonSocial"></div> 
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Verificar Contrasena</label>
                <div class="col-sm-8"><input type="password" class="form-control" id="RazonSocial"></div> 
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Correo</label>
                <div class="col-sm-8"><input type="text" class="form-control" id="RFC"></div> 
            </div>
            <div class="col-sm-8"></div>
            <div class="row-fluid col-sm-4 ">
                <button type="button" class="btn btn-default btn-lg">Cancelar</button>
                <button type="button" class="btn btn-rojo btn-lg">Registrar</button>
            </div>
            </form>
    </section>
</div>

<?php $this->load->view('Global/footer')?>
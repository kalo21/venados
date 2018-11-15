<?php $this->load->view('Global/header'); ?>
<?php $this->load->view('Global/menu'); ?>
<style>

.thumbnail {
    position: relative;
}

.caption {
    position: absolute;
    top: 35%;
    left: 0;
    width: 100%;
}
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <h3 class="text-center">Productos</h3>
            </div>
            <div class="row form-group">
                <div class="thumbnail text-center col-md-4">
                    <img class="img-responsive" src="<?php echo base_url('assets/Empresas/1/295693_Starbucks.jpg');?>" alt="">
                    <div class="caption" style="background-color: rgba(0,0,0,0.6)">
                        <strong style="color:white">Starbucks</strong>
                        <br>
                        <strong style="color:white">café-snacks</strong>
                    </div>
                </div>
                <div class="thumbnail text-center col-md-4">
                    <img class="img-responsive" src="<?php echo base_url('assets/Empresas/1/295693_Starbucks.jpg');?>" alt="">
                    <div class="caption" style="background-color: rgba(0,0,0,0.6)">
                        <strong style="color:white">Starbucks</strong>
                        <br>
                        <strong style="color:white">café-snacks</strong>
                    </div>
                </div>
                <div class="thumbnail text-center col-md-4">
                    <img class="img-responsive" src="<?php echo base_url('assets/Empresas/1/295693_Starbucks.jpg');?>" alt="">
                    <div class="caption" style="background-color: rgba(0,0,0,0.6)">
                        <strong style="color:white">Starbucks</strong>
                        <br>
                        <strong style="color:white">café-snacks</strong>
                    </div>
                </div>
            </div>
            
            
        </div>
    </section>
</div>

<?php $this->load->view('Global/footer'); ?>

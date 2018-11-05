<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct(){
        parent::__construct();

    }
    public function index(){
        //$this->load->view('inicio');/Se utiliza casos para controlar el acceso al servidor depende del tipo de usuario (perfil) se mostrara la pantalla principal correspodiente
       $this->load->view('Inicio/login');
    }
   

}

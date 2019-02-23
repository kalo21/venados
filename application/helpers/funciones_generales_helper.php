<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('informacionInicial')){
	function informacionInicial($titulo){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
         switch ($ci->session->userdata('idPerfil')) {
            case '1':
                $data['imagen'] = "assets/images/desarollador.png";
                $data['nombre'] = "Administrador - ".$ci->session->userdata('nombre');
                break;
            case '2':
                $data['imagen'] = $ci->session->userdata('imagen');
                $data['nombre'] = "Empresa - ".$ci->session->userdata('nombreEmpresa');
                break;
            case '3':
                $data['imagen'] = "assets/images/sistemas.png";
                $data['nombre'] = "Sistemas - ".$ci->session->userdata('nombre');
                break;
            case '4':
                $data['imagen'] = "assets/images/cliente.png";
                $data['nombre'] = "Cliente - ".$ci->session->userdata('nombre');
                break;
            case '5':
                $data['imagen'] = "assets/images/cliente.png";
                $data['nombre'] = "Empleado - ".$ci->session->userdata('nombre');
                break;
            default:
                $data['imagen'] = "assets/images/hacker.png";
                $data['nombre'] = "Infiltrado - ".$ci->session->userdata('nombre');
                break;
        }
        $data['titulo'] = $titulo;
        return $data;
    }
}
if(!function_exists('validacion')){
    function validacion(){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
        $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"],"index.php"));//--TOMO EL URL A QUE SE QUIERE ACCEDER
        $ci->load->Model('Modulos_modelo');
        if($ci->session->userdata('idPerfil') == true){//-- SI EL 'id_usuario' EXISTE EN LA SESSION QUIERE DECIR QUE SI HUBO ALGUIEN LOGUEADO
            if($ci->Modulos_modelo->validarPerfil($ci->session->userdata('idPerfil'),$url)==true){//--VALIDA QUE EL PERFIL LOGUEADO LE PERTENECE EL MODULO AL QUE DESEA ACCEDER.
              return true;
            }
            else{
              header('Location: '.base_url().'index.php/Inicio/index');
            }
        }
        else{
          header('Location: '.base_url().'index.php/Inicio/index');
        }
    }
}
if(!function_exists('modulos')){
    function modulos(){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
        $ci->load->model('Modulos_modelo');
        return $ci->Modulos_modelo->obtenerModulosXPerfil($ci->session->userdata('idPerfil'));
    }

        
}

function GenerarPDFLogo($contenidoPDF,$leterAction,$ruta_and_Name){
    $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
      $ci->load->library('Pdf');
      $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('VENADOS SNACKS');
      $pdf->SetTitle('Archivo generado por VENADOS SNACKS');
      $pdf->SetSubject('VENADOS');
      $pdf->SetKeywords('Proyecto especiales, VENADOS, SNACKS');  

      $pdf->setPrintHeader(false);
      //$pdf->setPrintFooter(false);
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config esta carpeta esta en ejemplos buscar ese archivo,en caso solo buscar sin al_alt al final.
        //$pdf->SetHeaderData(PDF_HEADER_LOGOSENCILLO, PDF_HEADER_LOGO_WIDTH);
        //$pdf->setFooterData();
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); //-linea original
        $pdf->SetMargins(PDF_MARGIN_LEFT, 18, PDF_MARGIN_RIGHT);

        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.freemono
        $pdf->SetFont('Helvetica', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
// Imprimimos el texto con writeHTMLCell()
      // $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
      // $contenidoPDF .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
      $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $contenidoPDF, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        #$nombre_archivo = base_url('/assets/documentos/oficios_secretario_tecnico/'.utf8_decode("oficio_favorable.pdf"));
        $nombre_archivo = $ruta_and_Name.'.pdf';
          ob_end_clean();
        //echo $nombre_archivo; die();
          //i muestra el archivo y la D lo baja 
        $pdf->Output($nombre_archivo, $leterAction);
    }
//end application/helpers/inicio_helper.php
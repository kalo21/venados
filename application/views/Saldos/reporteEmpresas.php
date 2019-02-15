<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('VENADOS SNACKS');
$pdf->SetTitle('REPORTE');
$pdf->SetSubject('Tutorial TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//************TODO ESTO ES LA CAECERA**************** */
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
$pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, 'REPORTES DE COMPRAS', 'REPORTE DE COMPRAS REALIZADAS POR CLIENTES', array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
// Helvetica para reducir el tamaño del archivo.
$pdf->SetFont('freemono', '', 10, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
$pdf->AddPage();
//fijar efecto de sombra en el texto
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

/**********AQUI SE ESCRIBE TODO EL CONTENIDO DE EL DOCMENTO */
//preparamos y maquetamos el contenido a crear
$html = '
<table style="border-radius:4px; width: 1070; font-size: 15">
        <tr>
            <td style="width: 100">Cliente</td>
            <td style="text-align: left">Cesar Ulises Cedillo Serrano</td>
        </tr>
        <tr>
            <td>Fecha</td>
            <td>14/Febrero/2019</td>
        </tr>
    </table>
';


// Imprimimos el texto con writeHTMLCell()
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
$nombre_archivo = utf8_decode("Localidades de ");
$pdf->Output($nombre_archivo, 'I');
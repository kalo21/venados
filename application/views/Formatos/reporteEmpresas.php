<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .tabla-regitros {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .tabla-regitros td, #tabla-regitros th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .tabla-regitros th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #808080;
        color: white;
        }

        .tabla-registros tr {
            heigth: 2%;
        }
    </style>

</head>
<body>
    <table><!--Para el logo -->
        <tr>
            <td  align="center" >
                <img src="<?php echo base_url('assets/images/logo-venados-grande.png') ?>" width="70">
            </td>
        </tr>
        
        <tr>
            <td align="center" > 
                <h3>REPORTE DE VENTAS DE TIENDAS</h3>
            </td>
        </tr>
    </table>
    
        
    <br><br>
    

    <table class="tabla-regitros"><!--Para los datos del reporte -->
        <tr>
        
            <th width="200">Empresa</th>
            <td width="420"><?php 
            if(is_array($nombre)) {    
                foreach
                   ($nombre as $key => $value) {
                    echo $value->nombre;
                };
            }else{
                echo "Todas las empresas";
            }
            ?></td>
        </tr>
        
        <tr>
            <th>Fecha de inicio</th>
            <td ><?php echo $datos['fechaInicio'] ?></td>

        </tr>

        <tr>
            <th>Fecha final</th>
            <td><?php echo $datos['fechaFinal'] ?></td>
        </tr>

        <tr>
            <th>Fecha de creacion</th>
            <td><?php 
                date_default_timezone_set('UTC');
                echo date("Y-m-d");
            ?></td>
        </tr>

    </table>

    <br>

            <h4 align="center">REPORTE</h4>

    <table class="tabla-regitros"> <!--Para los registros del reporte -->
        <tr>
            <th width="150">EMPRESA</th>
            <th>FECHA (A-M-D) </th>
            <th width="200">CLIENTE</th>
            <th>MONTO</th>
        </tr>
        <?php
        if (is_array($registros)) {
            foreach($registros as $index => $registro) {
                echo '<tr>
                        <td width="150">'.$registro->nombre.'</td>
                        <td>'.$registro->fecha.'</td>
                        <td>'.$registro->cliente.'</td>
                        <td>$ '.$registro->total.' MXN</td>
                    </tr>';
                    $total = $total + $registro->total;
            }
            
        }else{
            echo $registros;
        }
            
        ?>
        <br>
        <tr class="tabla-regitros">
            <td colspan="3">Total de ventas</td>
            <td >$ 
                <?php echo $total?>
                 MXN
            </td>
        </tr>
    </table>
    <br><br><br><br><br>
    <table>
        <tr>
            <td align="center"><p>FIRMA</p></td>
        </tr>
        
        <br>

        <tr align="center">
            <td>________________________________</td>
        </tr>
    </table>
    
</body>
</html>
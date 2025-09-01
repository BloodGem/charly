<?php
error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";


require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


$no_rango = $_POST['no_rango'];
$id_sucursal = $_POST['id_sucursal'];

if($no_rango == "" || $id_sucursal == ""){
    return;
}


switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 3:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d");
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('this Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 4:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('last Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 9:

    if(isset($_POST['rango_fecha'])){
    $rango_fecha = $_POST['rango_fecha'];
    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;

}

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';

    break;
    
}



$traerFacturasGlobales = ControladorReportesVentas::ctrReporteFacturasGlobales($fecha1, $fecha2, $id_sucursal);

//echo $traerFacturasGlobales;

echo '<table id="tablaReporteFacturasGlobales" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">IdFactura</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Fecha Inicial</th>
<th style="text-align: center;">Fecha Final</th>
<th style="text-align: right;">Total</th>
<th style="text-align: right;">UUID</th>
</tr>
</thead>
<tbody>';

$total_facturas_globales_acumulado = 0;
//$total_utilidad_acumulado = 0;

foreach ($traerFacturasGlobales as $key => $row) {


    $total_facturas_globales_acumulado = $total_facturas_globales_acumulado + $row['total'];


    echo '<tr>
    <td style="text-align: center;">'.$row["id_factura_global"].'</td>
    <td style="text-align: center;">'.$row["folio"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: center;">'.$row["fecha_inicial"].'</td>
    <td style="text-align: center;">'.$row["fecha_final"].'</td>
    <td style="text-align: right;">$'.number_format($row["total"], 2).'</td>
    <td style="text-align: center;">'.$row['uuid'].'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">IdFactura</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Fecha Inicial</th>
<th style="text-align: center;">Fecha Final</th>
<th style="text-align: right;">Total</th>
<th style="text-align: right;">UUID</th>
</tr>
</tfoot>
</table><br><br>
                <center><h3>Gran Total: $'.number_format($total_facturas_globales_acumulado, 2).'</h3></center>';



















    


?>
<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


$no_rango = $_GET['no_rango'];
$id_sucursal = $_GET['id_sucursal'];

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

    if(isset($_GET['rango_fecha'])){
    $rango_fecha = $_GET['rango_fecha'];
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






			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte de facturas globales.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode('<table border="0"> 
					<tr>
					<th>IdFactura</th>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Total</th>
                    <th>UUID</th>
					</tr>');



$total_facturas_globales_acumulado = 0;
//$total_utilidad_acumulado = 0;

foreach ($traerFacturasGlobales as $key => $row) {


    $total_facturas_globales_acumulado = $total_facturas_globales_acumulado + $row['total'];


    echo '<tr>
    <td>'.$row["id_factura_global"].'</td>
    <td>'.$row["folio"].'</td>
    <td>'.$row["fecha_creacion"].'</td>
    <td>'.$row["fecha_inicial"].'</td>
    <td>'.$row["fecha_final"].'</td>
    <td>$'.number_format($row["total"], 2).'</td>
    <td>'.$row['uuid'].'</td>
    </tr>';
}

			


			echo '<tr><td colspan="5" style="font-weight:bold;  text-align:right;">GRAN TOTAL</td>
			<td style="font-weight:bold;">$'.number_format($total_facturas_globales_acumulado, 2).'</td></tr>';

            echo '<tr></tr><tr></tr>';

            



?>
  
</table>

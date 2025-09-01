<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/reportes-compras.controlador.php";
require_once "../../../modelos/reportes-compras.modelo.php";


$no_rango = $_GET['no_rango'];
$id_marca = $_GET['id_marca'];
$id_sucursal = $_GET['id_sucursal'];
$id_proveedor = $_GET['id_proveedor'];

if($no_rango == "" || $id_marca == "" || $id_sucursal == "" || $id_proveedor == ""){
    return;
}


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


$traerProveedores = ControladorReportesCompras::ctrSelectProveedoresReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal);



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte compras por marca.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

foreach ($traerProveedores as $keyP => $rowP) {

    $traerPartidasCompra = ControladorReportesCompras::ctrReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal, $rowP['id_proveedor']);

echo utf8_decode("<table border='0'> 
                    <tr>
                    <th colspan='9' style='font-weight:bold; border:1px solid #000000; background-color: #1BA64B;'>".$rowP['nombre']."</th>
                    </tr></table>");


echo utf8_decode("<table border='0'> 


                    <tr>
                    <th style='font-weight:bold; border:1px solid #000000;'>No. Compra</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Fecha</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Factura</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Clave</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Producto</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Marca</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Cantidad</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Precio Unitario</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Importe</th>
                    </tr>");

$total_compras_acumulado = 0;

foreach ($traerPartidasCompra as $key => $row) {

    $total_compras_acumulado = $total_compras_acumulado + $row['total'];

    echo'<tr>
                <td style="border:1px solid #9B9B9B;">'.$row['id'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['fecha_creacion'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['no_factura'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['marca'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['cantidad'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['precio'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['total'].'</td>
            </tr>';
}

echo '<tr><td colspan="8" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTAL</td>
            <td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_compras_acumulado, 2).'</td></tr>

            <tr><td></td></tr>';

}


			


			



?>
  
</table>

<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";



$no_rango = $_GET['no_rango'];

if($no_rango == ""){
    return;
}

$vendedores = ControladorVendedores::ctrMostrarVendedores();

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



foreach ($vendedores as $key => $value) {

    $id_vendedor = $value['id_vendedor'];

    switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));


    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;


    
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
    $fecha2 = $dia2 . ' 23:59:59' ;


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
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    break;
    
}


$sql = "SELECT productos.id_producto, productos.clave_producto, productos.descripcion_corta, SUM(partvta.cantidad) AS cantidad_vendida, Sum(partvta.cantidad * partvta.precio_neto) AS total_ventas, Sum(partvta.cantidad*partvta.precio_compra) AS total_precio_compra, (Sum(partvta.cantidad * partvta.precio_neto)-Sum(partvta.cantidad*partvta.precio_compra)) AS total_utilidad FROM productos INNER JOIN partvta ON productos.id_producto = partvta.id_producto INNER JOIN ventas ON partvta.id_venta = ventas.id WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_vendedor = $id_vendedor GROUP BY productos.id_producto, productos.clave_producto, productos.descripcion_corta ORDER BY productos.descripcion_corta ASC";

//echo $sql;

$rs = $conexion->query($sql);



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte de ventas de productos vendedores generales.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 


                    <tr>
                    <th colspan='4' style='font-weight:bold; border:1px solid #000000; background-color: #1BA64B;'>".$value['nombres']."</th>
                    </tr>");

echo utf8_decode("<table border='0'> 


					<tr>
					<th style='font-weight:bold; border:1px solid #000000;'>Cantidad</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Clave</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Producto</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Total ventas</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total_ventas_acumulado_productos = 0;

while($row = $rs->fetch_array(MYSQLI_BOTH)){

    $total_ventas_acumulado_productos = $total_ventas_acumulado_productos + $row["total_ventas"];

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$row['cantidad_vendida'].'</td> 
                <td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">$'.number_format($row['total_ventas'], 2).'</td>
			</tr>';


			}

			


			echo '<tr><td colspan="3" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_ventas_acumulado_productos, 2).'</td></tr><tr></tr><tr></tr></table>';

}

?>
  


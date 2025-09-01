<?php

//error_reporting(0);
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";



$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];
$id_sucursal = $_GET['id_sucursal']; 


$fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';


$traerVentasProductos = ControladorReportesVentas::ctrReportesVentasProductos($fecha1, $fecha2, $id_sucursal);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'ventas_productos.xls';

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
					<th style='font-weight:bold; border:1px solid #000000;'>Clave Producto</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Producto</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Cantidad</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Ventas</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Utilidad</th>
					</tr>");



$total_ventas_acumulado = 0;
//$total_utilidad_acumulado = 0;

foreach ($traerVentasProductos as $key => $row) {

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total_ventas'];




			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row['cantidad_vendida'].'</td>
			 	<td style="border:1px solid #9B9B9B;">$'.number_format($row['total_ventas'], 2).'</td>
			 	<td style="border:1px solid #9B9B9B;">$'.number_format($row['total_utilidad'], 2).'</td>
			</tr>';


			}

			




?>
  
</table>

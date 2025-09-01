<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/reportes-productos.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";



$no_meses = $_GET['no_meses'];
$id_sucursal = $_GET['id_sucursal'];

if($no_meses == "" || $id_sucursal == ""){
    return;
}


$fecha = date("Y-m-d",strtotime("-$no_meses Month"));


$traerProductosSinMovimiento = ControladorReportesProductos::ctrReporteProductosSinMovimiento($fecha, $id_sucursal);



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte de ventas.xls';

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
					<th style='font-weight:bold; border:1px solid #000000;'>Id</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Clave</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Producto</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Existencias</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Ubicación</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Fecha Ult Venta</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Fecha Ult Compra</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



foreach ($traerProductosSinMovimiento as $key => $row) {

    $id_producto = $row['id_producto'];

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$id_producto.'</td> 
                <td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row['stock'].'</td>
                <td style="border:1px solid #9B9B9B;">'.$row['ubicacion'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["fecha_ult_venta"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["fecha_ult_compra"].'</td>
			</tr>';


			}

			



?>
  
</table>

<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/reportes-productos.controlador.php";
require_once "../../../modelos/reportes-productos.modelo.php";

$anaquel = $_GET['anaquel'];
$id_sucursal = $_GET['id_sucursal'];

if($id_sucursal == ""){
    return;
}


$traerProductos = ControladorReportesProductos::ctrReporteProductosAnaqueles($id_sucursal, $anaquel);


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'Productos por el anaquel '.$anaquel.'.xls';

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
					<th style='font-weight:bold; border:1px solid #000000;'>Clave</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Descripción</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Ubicación</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Existencias</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



foreach ($traerProductos as $key => $row) {

			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row['ubicacion'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["stock"].'</td>
			</tr>';


			}

			




?>
  
</table>

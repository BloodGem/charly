<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";




$sql = "SELECT productos.clave_producto, productos.descripcion_corta, SUM(existencias_sucursales.stock) AS existencias, existencias_sucursales.precio_compra, SUM(existencias_sucursales.stock * existencias_sucursales.precio_compra) AS SUMA FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto GROUP BY productos.clave_producto, productos.descripcion_corta, existencias_sucursales.precio_compra ORDER BY productos.descripcion_corta ASC";


$rs = $conexion->query($sql);



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'Valor de inventario general.xls';

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
				<td style='font-weight:bold; border:1px solid #eee;'>Clave Producto</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>Descripción</td>
				<td style='font-weight:bold; border:1px solid #eee;'>existencias</td>
				<td style='font-weight:bold; border:1px solid #eee;'>precio compra</td>
				<td style='font-weight:bold; border:1px solid #eee;'>Total sin Iva</td>	
				</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total_inventario = 0;

while ($row = $rs->fetch_array(MYSQLI_BOTH)) { 

			//foreach ($respuesta as $row => $item){

	echo"<tr>
	<td style='border:1px solid #eee;'>".$row['clave_producto']."</td> 
	<td style='border:1px solid #eee;'>".$row['descripcion_corta']."</td>
	<td style='border:1px solid #eee;'>".number_format($row['existencias'], 0)."</td>
	<td style='border:1px solid #eee;'>$ ".$row['precio_compra']."</td>
	<td style='border:1px solid #eee;'>$ ".number_format($row['SUMA'], 2)."</td></tr>";


			 			//AQUI EMPIEZA LA SUMATORIA DE LOS TOTALES
	$total_inventario = $total_inventario + $row['SUMA'];

}


echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #eee; text-align:right;">TOTAL</td>
<td style="font-weight:bold; border:1px solid #eee;">$'.number_format($total_inventario,2).'</td></tr>';
?>

</table>


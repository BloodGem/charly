<?php

error_reporting(0);

require_once "conexion.php";

if (isset($_GET['id_sucursal'])) {


    $id_sucursal = $_GET['id_sucursal'];

    

$consultaValorInventarioProductosSucursal = "SELECT ARTICULO.CLAVE_ART, ARTICULO.DESCRIP, EXISTENCIA.EXISTENCIA, ARTICULO.EN_VENTA, (EXISTENCIA.EXISTENCIA * ARTICULO.EN_VENTA) AS SUMA FROM EXISTENCIA INNER JOIN ARTICULO ON EXISTENCIA.CLAVE_ART = ARTICULO.CLAVE_ART WHERE EXISTENCIA.IDSUCURSAL = $id_sucursal ORDER BY ARTICULO.DESCRIP ASC";
        

        $stmt = odbc_exec( $con, $consultaValorInventarioProductosSucursal );


        $consultaSucursal = "SELECT * FROM SUCURSAL WHERE IDSUCURSAL = $id_sucursal";
        

        $stmt2 = odbc_exec( $con, $consultaSucursal );
        $row2 = odbc_fetch_array($stmt2);

        $nombre_sucursal = $row2['NOMBRE'];



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["id_sucursal"].'.'.$nombre_sucursal.'.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>CLAVE</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>DESCRIPCIÓN</td>
					<td style='font-weight:bold; border:1px solid #eee;'>EXISTENCIA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>COSTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALOR SIN IVA</td>	
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total_inventario = 0;

while ( $row = odbc_fetch_array($stmt) ) { 

	$en_venta = number_format($row['EN_VENTA'], 2);
    $suma = number_format($row['SUMA'], 2);
    $existencia = number_format($row['EXISTENCIA'], 0);

			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #eee;'>$row[CLAVE_ART]</td> 
			 			<td style='border:1px solid #eee;'>$row[DESCRIP]</td>
			 			<td style='border:1px solid #eee;'>$existencia</td>
			 			<td style='border:1px solid #eee;'>$ $en_venta</td>
			 			<td style='border:1px solid #eee;'>$ $suma</td></tr>";


			 			//AQUI EMPIEZA LA SUMATORIA DE LOS TOTALES
			 			$total_inventario = $total_inventario + $row[SUMA];

			}


			$total_inventario_formateado = number_format($total_inventario,2);


			echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #eee; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #eee;">$'.$total_inventario_formateado.'</td></tr>';
?>
  
</table>

<?php
}

?>
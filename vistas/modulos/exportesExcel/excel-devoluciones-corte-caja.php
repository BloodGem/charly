<?php

error_reporting(0);
//date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/devoluciones.controlador.php";
require_once "../../../modelos/devoluciones.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

$id_corte_caja = $_GET['id_corte_caja'];

if($id_corte_caja == ""){
    return;
}


$traerDevolucionesCorteCaja = ModeloDevoluciones::mdlMostrarDevolucionesCorteCaja($id_corte_caja);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'Devoluciones del corte de caja no.'.$id_corte_caja.'.xls';

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
					<th style='font-weight:bold; border:1px solid #000000;'>Id Devolución</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Fecha</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Total</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Cliente</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Id Venta</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Folio</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



$total_devoluciones_acumulado = 0;

foreach ($traerDevolucionesCorteCaja as $key2 => $row) {

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $total_devoluciones_acumulado = $total_devoluciones_acumulado + $row['total'];
    



			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$row["id_devolucion"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["fecha_creacion"].'</td>
			 	<td style="border:1px solid #9B9B9B;">$'.number_format($row["total"],2).'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerCliente["nombre"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["id_venta"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerVenta["folio"].'</td>
			</tr>';


			}

			
			echo '<tr><td colspan="2" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_devoluciones_acumulado, 2).'</td></tr>';


?>
  
</table>

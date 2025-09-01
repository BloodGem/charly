<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/existencias-sucursales.controlador.php";
require_once "../../../modelos/existencias-sucursales.modelo.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];

$traerProductosSucursal = ControladorExistenciasSucursales::ctrMostrarProductosSucursal($id_sucursal);
			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'Lista de precios.xls';

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
                    
					<th>Clave</th>
					<th>Descripción</th>
					<th>Precio venta</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



foreach ($traerProductosSucursal as $key => $value) {

	$id_producto = $value['id_producto'];

    $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);


			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td>'.$traerProducto['clave_producto'].'</td> 
			 	<td>'.$traerProducto['descripcion_corta'].'</td>
			 	<td>$'.number_format($traerProducto["precio1"], 2).'</td>
			</tr>';


			}

			




?>
  
</table>

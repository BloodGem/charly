<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";



$sql = "SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.id_marca, productos.id_proveedor1, productos.id_proveedor2, productos.id_proveedor3, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE existencias_sucursales.stock <= 0 AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = 1 ORDER BY productos.descripcion_larga ASC";

   

    //echo $sql;
    $rs = $conexion->query($sql); 

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte_productos_sin_existencias.xls';

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
                    <th style='font-weight:bold; border:1px solid #000000;'>Marca</th>
					<th style='font-weight:bold; border:1px solid #000000;'>A pedir</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Proveedor 1</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Proveedor 2</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Proveedor 3</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



while($row = $rs->fetch_array(MYSQLI_BOTH)){

    $traerMarca = ControladorMarcas::ctrMostrarMarca($row['id_marca']);

    $traerProveedor1 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor1']);

    $traerProveedor2 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor2']);

    $traerProveedor3 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor3']);
    



			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$row['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerMarca['marca'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row["a_pedir"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProveedor1["nombre"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProveedor2["nombre"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProveedor3["nombre"].'</td>
			</tr>';


			}

			




?>
  
</table>

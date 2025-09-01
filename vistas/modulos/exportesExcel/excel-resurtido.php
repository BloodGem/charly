<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/resurtido.controlador.php";
require_once "../../../modelos/resurtido.modelo.php";
require_once "../../../modelos/partres.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/existencias-sucursales.controlador.php";
require_once "../../../modelos/existencias-sucursales.modelo.php";
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

$id_resurtido = $_GET['id_resurtido'];

if($id_resurtido == ""){
    return;
}
$traerResurtido = ControladorResurtidos::ctrMostrarResurtido($id_resurtido);
$id_proveedor = $traerResurtido['id_proveedor'];
$traerProveedor = ControladorProveedores::ctrMostrarProveedor($id_proveedor);
//$traerPartidasResurtido = ModeloPartres::mdlMostrarPartidasResurtido($id_resurtido);
$traerPartidasResurtido = json_decode($traerResurtido['productos'], true);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'resurtido'.$id_resurtido.'.xls';

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
                    <th colspan='8'>PROVEEDOR: ".$traerProveedor['nombre']."</th>
                    </tr>

					<tr>
					<th style='font-weight:bold; border:1px solid #000000;'>Clave</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Descripción</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Marca</th>
					<th style='font-weight:bold; border:1px solid #000000;'>A pedir</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Mínimo</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Máximo</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Existencias</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Precio compra</th>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/



foreach ($traerPartidasResurtido as $key => $value) {

    $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($value['id_producto'], $traerResurtido['id_sucursal']);

    if($traerProducto['id_marca'] == 0){
        $marca = "N/A";
    }else{
        $traerMarca = ControladorMarcas::ctrMostrarMarca($traerProducto['id_marca']);
        $marca = $traerMarca["marca"];
    }
    



			//foreach ($respuesta as $value => $item){

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto['clave_producto'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto['descripcion_corta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$marca.'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$value["a_pedir"].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto['nivel_minimo'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto['nivel_maximo'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto['stock'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerProducto["precio_compra"].'</td>
			</tr>';


			}

			




?>
  
</table>

<?php

require_once "conexion.php";

class ModeloReportesProductos{



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlReporteProductosAnaqueles($id_sucursal, $anaquel){

		if($anaquel == ""){
			$stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.descripcion_corta FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE existencias_sucursales.id_sucursal = $id_sucursal AND existencias_sucursales.ubicacion = '' ORDER BY productos.descripcion_corta ASC");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.descripcion_corta FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE existencias_sucursales.id_sucursal = $id_sucursal AND existencias_sucursales.ubicacion LIKE '$anaquel%' ORDER BY productos.descripcion_corta ASC");
		}

			

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

}


?>
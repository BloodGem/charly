<?php

class ControladorReportesProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrReporteProductosAnaqueles($id_sucursal, $anaquel){


		$respuesta = ModeloReportesProductos::mdlReporteProductosAnaqueles($id_sucursal, $anaquel);

		return $respuesta;

	}










	static public function ctrReporteProductosSinMovimiento($fecha, $id_sucursal){

		$sql = "SELECT existencias_sucursales.id_producto, productos.descripcion_corta, productos.clave_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, existencias_sucursales.fecha_ult_venta, existencias_sucursales.fecha_ult_compra FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE existencias_sucursales.id_sucursal = $id_sucursal AND existencias_sucursales.fecha_ult_venta <= $fecha";

		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	static public function ctrCrearVistaReporteListaPrecios($producto_inicial, $producto_final, $id_marca, $id_sucursal){

		$id_usuario = $_SESSION['id'];

		if($id_marca !== "0"){
		    $sql_id_marca = " AND productos.id_marca = '".$id_marca."'";
		}else{
		    $sql_id_marca = "";
		}

		$sqlDrop = "DROP VIEW reporte_lista_precios_".$id_sucursal."_".$id_usuario;

		$sqlView = "CREATE VIEW reporte_lista_precios_".$id_sucursal."_".$id_usuario." AS SELECT existencias_sucursales.id_producto, existencias_sucursales.ubicacion, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3 FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE descripcion_corta >= '$producto_inicial' AND descripcion_corta <= '$producto_final' AND existencias_sucursales.id_sucursal = $id_sucursal".$sql_id_marca." ORDER BY descripcion_corta ASC";


		$respuesta = ModeloReportesGenerales::mdlEliminarCrearVista($sqlDrop, $sqlView);

		return $respuesta;
	}









}

?>
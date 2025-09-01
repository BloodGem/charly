<?php

class ControladorReportesCompras{

	/*=============================================
	MOSTRAR PROVEEDORES COMPRAS MARCA  FECHA
	=============================================*/

	static public function ctrSelectProveedoresReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal){

		if($id_sucursal !== "0"){
		    $sql_id_sucursal = " AND compras.id_sucursal = ".$id_sucursal;
		}else{
		    $sql_id_sucursal = "";
		}

		$sql = "SELECT compras.id_proveedor, proveedores.nombre FROM partcom INNER JOIN compras ON partcom.id_compra = compras.id INNER JOIN productos ON partcom.id_producto = productos.id_producto INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor INNER JOIN marcas ON productos.id_marca = marcas.id_marca WHERE compras.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND compras.estatus = 1 AND marcas.id_marca = $id_marca".$sql_id_sucursal." GROUP BY compras.id_proveedor, proveedores.nombre ORDER BY proveedores.nombre ASC";

		//return $sql;


		$respuesta = ModeloReportesCompras::mdlSelectProveedoresReporteComprasMarca($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR COMPRAS POR MARCA
	=============================================*/

	static public function ctrReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal, $id_proveedor){

		if($id_sucursal !== "0"){
		    $sql_id_sucursal = " AND compras.id_sucursal = ".$id_sucursal;
		}else{
		    $sql_id_sucursal = "";
		}


		if($id_proveedor !== "0"){
		    $sql_id_proveedor = " AND compras.id_proveedor = ".$id_proveedor;
		}else{
		    $sql_id_proveedor = "";
		}

		$sql = "SELECT compras.id, compras.id_proveedor, compras.fecha_creacion, compras.no_factura, partcom.*, productos.clave_producto, productos.descripcion_corta, marcas.marca FROM partcom INNER JOIN compras ON partcom.id_compra = compras.id INNER JOIN productos ON partcom.id_producto = productos.id_producto INNER JOIN marcas ON productos.id_marca = marcas.id_marca WHERE compras.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND compras.estatus = 1 AND marcas.id_marca = $id_marca".$sql_id_sucursal.$sql_id_proveedor." ORDER BY compras.id DESC";

		//return $sql;


		$respuesta = ModeloReportesCompras::mdlReporteComprasMarca($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR COMPRAS POR MARCA
	=============================================*/

	static public function ctrReporteComprasTipo($fecha1, $fecha2, $tipo, $id_sucursal){

		if($id_sucursal !== "0"){
		    $sql_id_sucursal = " AND compras.id_sucursal = ".$id_sucursal;
		}else{
		    $sql_id_sucursal = "";
		}

		$sql = "SELECT * FROM  compras WHERE compras.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND compras.estatus = 1 AND compras.tipo_compra = $tipo".$sql_id_sucursal." ORDER BY compras.id DESC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR COMPRAS POR MARCA
	=============================================*/

	static public function ctrMostrarRegistros($sql){

		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










}

?>
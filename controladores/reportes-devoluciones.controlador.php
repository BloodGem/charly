<?php

class ControladorReportesDevoluciones{
static public function ctrMostrarDevolucionesTipo($fecha1, $fecha2, $tipo, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND devoluciones.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}



		$sql = "SELECT devoluciones.*, ventas.folio, ventas.tipo_venta FROM devoluciones INNER JOIN ventas ON devoluciones.id_venta = ventas.id WHERE devoluciones.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY devoluciones.id_devolucion DESC";

		//return $sql;

		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}











	/*=============================================
	REPORTE DE DEVOLUCIONES DE PRODUCTOS POR VENDEDOR
	=============================================*/

	static public function ctrReporteDevolucionesProductosVendedor($fecha1, $fecha2, $id_vendedor){


		$sql = "SELECT partdev.id_producto, productos.clave_producto, productos.descripcion_corta, SUM(partdev.cantidad) AS cantidad_devuelta, Sum(partdev.cantidad * partdev.precio_unitario) AS total_devoluciones FROM partdev INNER JOIN productos ON partdev.id_producto = productos.id_producto INNER JOIN devoluciones ON partdev.id_devolucion = devoluciones.id_devolucion INNER JOIN ventas ON devoluciones.id_venta = ventas.id WHERE devoluciones.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.id_vendedor = $id_vendedor GROUP BY partdev.id_producto, productos.clave_producto, productos.descripcion_corta ORDER BY productos.descripcion_corta ASC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}











static public function ctrReporteDevolucionesVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT SUM(devoluciones.total) AS total_devoluciones FROM devoluciones INNER JOIN ventas ON devoluciones.id_venta = ventas.id WHERE devoluciones.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.id_vendedor = $id_vendedor".$sql_id_sucursal;

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}

}


?>
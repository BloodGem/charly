<?php

class ControladorReportesVentas{





	/*=============================================
	MOSTRAR CAJEROS REPORTE VENTAS POR CAJERO
	=============================================*/

	static public function ctrSelectCajerosReporteVentasCajero($fecha1, $fecha2, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT cortes_caja.id_usuario_creador, usuarios.nombre FROM ventas INNER JOIN cortes_caja ON ventas.id_corte_caja = cortes_caja.id_corte_caja  INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_sucursal." GROUP BY cortes_caja.id_usuario_creador, usuarios.nombre ORDER BY usuarios.nombre ASC";

		//return $sql;


		$respuesta = ModeloReportesVentas::mdlSelectCajerosReporteVentasCajero($sql);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrReporteVentasCajero($fecha1, $fecha2, $id_sucursal, $id_usuario){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}


		if($id_usuario !== "0"){
			$sql_id_usuario = " AND cortes_caja.id_usuario_creador = ".$id_usuario;
		}else{
			$sql_id_usuario = "";
		}

		$sql = "SELECT * FROM ventas INNER JOIN cortes_caja ON ventas.id_corte_caja = cortes_caja.id_corte_caja WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_sucursal.$sql_id_usuario." ORDER BY ventas.id DESC";

		//return $sql;

		$respuesta = ModeloReportesVentas::mdlReporteVentasCajero($sql);

		return $respuesta;

	}










	static public function ctrBorrarDatosTabla($tabla){

		$respuesta = ModeloReportesVentas::mdlBorrarDatosTabla($tabla);

		return $respuesta;
	}










	static public function ctrCargarHoraReporteVentasHora(){

		if(isset($_POST['fechaInicialRVH']) && isset($_POST['fechaFinalRVH'])){

			$fecha1 = $_POST['fechaInicialRVH'].' 00:00:00';

			$fecha2 = $_POST['fechaFinalRVH'].' 23:59:59';

			$id_sucursal = $_POST['idSucursalRVH'];

		$borrarDatos = ControladorReportesVentas::ctrBorrarDatosTabla("reporte_ventas_horas");

		if($borrarDatos == 1){

		$array1 = array();
		$array2 = array();
		$horas = 0;
		for ($i=1; $i <=48; $i+=2){

			array_push($array1, date("H:i", strtotime($horas.":00")));
			array_push($array2, date("H:i", strtotime($horas.":30")));

			$horas++;
		}


		$horas = 0;
		for ($i=2; $i <=48; $i+=2){
			array_push($array1, date("H:i", strtotime($horas.":30")));
			if($horas == 23){
				array_push($array2, date("H:i", strtotime($horas.":59")));
			}else{
				array_push($array2, date("H:i", strtotime(($horas+1).":00")));
			}
			$horas++;
		}




		$traerVentas = ControladorReportesVentas::ctrMostrarVentasTiempo($fecha1, $fecha2, $id_sucursal);

		foreach ($traerVentas as $key => $row) {

			$valor = date("H:i", strtotime($row['hora']));

			$respuesta = ControladorReportesVentas::Localiza($valor, $array1, $array2);

			$traerPartida = ControladorReportesVentas::Busca($row['id_vendedor'], $respuesta);

			if($traerPartida == false){
				$crearRegistro = ControladorReportesVentas::ctrCrearRegistroReporteVentasHora($row['id_vendedor'], $respuesta, $array1[$respuesta], $array2[$respuesta], $row['cantidad'], $row['total']);

			}else{
				$nueva_cantidad = $traerPartida['cantidad'] + $row['cantidad'];
				$nuevo_total = $traerPartida['total'] + $row['total'];
				$actualizar = ControladorReportesVentas::ctrActualizarRegistroReporteVentasHora($nueva_cantidad, $nuevo_total, $row['id_vendedor'], $respuesta);


			}


		}

		echo "<script>window.open('extensiones/tcpdf/examples/pdf-reporte-ventas-hora.php?fecha1=".$fecha1."&fecha2=".$fecha2."&id_sucursal=".$id_sucursal."', '_blank');</script>";
	}else{
		echo "<script>

					Swal.fire({
  icon: 'error',
  title: 'No se ha podido generar el reporte',
  showConfirmButton: true
});
				
				</script>";
	}
	}

	}





	static public function ctrMostrarVentasTiempo($fecha1, $fecha2, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT id_vendedor, time(fecha_creacion) AS hora, COUNT(*) AS cantidad, SUM(total) AS total FROM ventas WHERE fecha_creacion between '$fecha1' and '$fecha2'".$sql_id_sucursal." GROUP BY id_vendedor, time(fecha_creacion)";


		$respuesta = ModeloReportesVentas::mdlReporteVentasCajero($sql);

		return $respuesta;

	}



	static public function Localiza($valor, $array1, $array2){
		
		for ($i=0; $i <=47; $i++){
			if($valor >= $array1[$i] && $valor <= $array2[$i]){
				return $i;
			}

		}


	}





	static public function Busca($id_vendedor, $no_rango){
		
		$sql = "SELECT * FROM reporte_ventas_horas WHERE id_vendedor = $id_vendedor AND no_rango = $no_rango";



		$respuesta = ModeloReportesVentas::mdlMostrarUnRegistro($sql);

		return $respuesta;


	}






	static public function ctrCrearRegistroReporteVentasHora($id_vendedor, $no_rango, $inicio, $final, $cantidad, $total){
		$sql = "INSERT INTO reporte_ventas_horas (id_vendedor, no_rango, inicio, final, cantidad, total) VALUES ($id_vendedor, $no_rango, '$inicio', '$final', $cantidad, $total)";

//return $sql;
		$respuesta = ModeloReportesVentas::mdlCrearRegistro($sql);
		return $respuesta;
	}





	static public function ctrActualizarRegistroReporteVentasHora($cantidad, $total, $id_vendedor, $no_rango){
		

		$sql = "UPDATE reporte_ventas_horas SET cantidad = $cantidad, total = $total WHERE id_vendedor = $id_vendedor AND no_rango = $no_rango";


		$respuesta = ModeloReportesVentas::mdlActualizarRegistro($sql);

		return $respuesta;


	}










	static public function ctrMostrarDatosReporteVentasHoraVendedor($id_vendedor){

		$sql = "SELECT * FROM reporte_ventas_horas WHERE id_vendedor = $id_vendedor";

		$respuesta = ModeloReportesVentas::mdlMostrarRegistros($sql);

		return $respuesta;
	}





	static public function ctrMostrarVendedoresReportesVentas($fecha1, $fecha2, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT ventas.id_vendedor, vendedores.nombres FROM ventas INNER JOIN vendedores ON ventas.id_vendedor = vendedores.id_vendedor WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_sucursal." GROUP BY ventas.id_vendedor, vendedores.nombres ORDER BY vendedores.nombres ASC";

		//return $sql;


		$respuesta = ModeloReportesVentas::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	static public function ctrReportesVentasProductos($fecha1, $fecha2, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		

		$sql = "SELECT partvta.id_producto, productos.clave_producto, productos.descripcion_corta, SUM(partvta.cantidad) AS cantidad_vendida, SUM(partvta.cantidad * partvta.precio_neto) AS total_ventas, SUM(partvta.cantidad*partvta.precio_compra) AS total_precio_compra, (SUM(partvta.cantidad * partvta.precio_neto)-Sum(partvta.cantidad*partvta.precio_compra)) AS total_utilidad FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id INNER JOIN productos ON partvta.id_producto = productos.id_producto WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_sucursal." GROUP BY partvta.id_producto, productos.clave_producto, productos.descripcion_corta ORDER BY productos.descripcion_corta ASC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR VENDEDORES REPORTE VENTAS POR MARCA POR VENDEDOR
	=============================================*/

	static public function ctrSelectVendedoresReporteVentasMarcaVendedor($fecha1, $fecha2, $id_marca, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT ventas.id_vendedor, vendedores.nombres FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id INNER JOIN vendedores ON ventas.id_vendedor = vendedores.id_vendedor INNER JOIN productos ON partvta.id_producto = productos.id_producto WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND productos.id_marca = $id_marca".$sql_id_sucursal." GROUP BY ventas.id_vendedor, vendedores.nombres ORDER BY vendedores.nombres ASC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	static public function ctrMostrarVendedores($fecha1, $fecha2, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT ventas.id_vendedor, vendedores.nombres FROM ventas INNER JOIN vendedores ON ventas.id_vendedor = vendedores.id_vendedor WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_sucursal." GROUP BY ventas.id_vendedor, vendedores.nombres ORDER BY vendedores.nombres ASC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR VENDEDORES REPORTE VENTAS POR MARCA POR VENDEDOR
	=============================================*/

	static public function ctrReporteVentasMarcaVendedor($fecha1, $fecha2, $id_marca, $id_vendedor, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT ventas.id, ventas.folio, ventas.fecha_creacion, productos.clave_producto, productos.descripcion_corta, partvta.cantidad, partvta.precio_neto, (partvta.cantidad * partvta.precio_neto) AS total FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id INNER JOIN productos ON partvta.id_producto = productos.id_producto WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND productos.id_marca = $id_marca AND ventas.id_vendedor = $id_vendedor".$sql_id_sucursal." ORDER BY ventas.fecha_creacion DESC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR VENDEDORES REPORTE VENTAS POR PRODUCTO POR VENDEDOR
	=============================================*/

	static public function ctrReporteVentasProductoVendedor($fecha1, $fecha2, $id_producto, $id_vendedor, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT ventas.id, ventas.folio, ventas.fecha_creacion, productos.clave_producto, productos.descripcion_corta, partvta.cantidad, partvta.precio_neto, (partvta.cantidad * partvta.precio_neto) AS total FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id INNER JOIN productos ON partvta.id_producto = productos.id_producto WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_vendedor = $id_vendedor AND productos.id_producto = $id_producto".$sql_id_sucursal." ORDER BY ventas.fecha_creacion DESC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	static public function ctrReporteVentasVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal){

		if($id_sucursal !== "0"){
			$sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
		}else{
			$sql_id_sucursal = "";
		}

		$sql = "SELECT SUM(ventas.total) AS total_ventas FROM ventas  WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_vendedor = $id_vendedor".$sql_id_sucursal;

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










	static public function ctrReporteVentasTerminalBancaria($fecha1, $fecha2, $id_terminal_bancaria){

		if($id_terminal_bancaria !== "0"){
			$sql_id_terminal_bancaria = " AND ventas.id_terminal_bancaria = ".$id_terminal_bancaria;
		}else{
			$sql_id_terminal_bancaria = "";
		}

		$sql = "SELECT * FROM ventas WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0".$sql_id_terminal_bancaria." ORDER BY ventas.id DESC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}










static public function ctrResumenReporteVentasTerminalBancaria($fecha1, $fecha2){

		$sql = "SELECT ventas.id_terminal_bancaria, terminales_bancarias.terminal_bancaria, SUM(ventas.total) as total_ventas FROM ventas INNER JOIN terminales_bancarias ON ventas.id_terminal_bancaria = terminales_bancarias.id_terminal_bancaria WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 GROUP BY ventas.id_terminal_bancaria, terminales_bancarias.terminal_bancaria ORDER BY terminales_bancarias.terminal_bancaria ASC";

		//return $sql;


		$respuesta = ModeloReportesGenerales::mdlMostrarRegistros($sql);

		return $respuesta;

	}









}

?>
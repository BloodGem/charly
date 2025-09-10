<?php

require_once "conexion.php";

class ModeloDevoluciones{


	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarDevoluciones($tabla, $columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna ORDER BY id ASC");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}






	



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarDevolucion($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones WHERE id_devolucion = :id_devolucion");

			$stmt -> bindParam(":id_devolucion", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}









							   /*=============================================
	ACTUALIZAR DEVOLUCION
	=============================================*/

	static public function mdlActualizarDevolucion($columna, $valor, $id_devolucion, $id_sucursal, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_devolucion = :id_devolucion AND id_sucursal = :id_sucursal");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_devolucion", $id_devolucion, PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	







	/*=============================================
	TIMBRAR VENTA
	=============================================*/

	static public function mdlTimbrarDevolucion($id_devolucion){

		if($id_devolucion != null){

			

			// Se especifica la zona horaria
			date_default_timezone_set('America/Mexico_City');


			$traerDevolucion = ModeloDevoluciones::mdlMostrarDevolucion($id_devolucion);

			$id_cliente = $traerDevolucion['id_cliente'];

			$traerCliente = ModeloClientes::mdlMostrarCliente($id_cliente);
				
            $id_sucursal = $traerDevolucion['id_sucursal'];

			$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);
			// Se especifica la version de CFDi 4.0
			$datos['version_cfdi'] = '4.0';

			// Ruta del XML Timbrado
			$datos['cfdi']='SDK2/timbrados/devoluciones/'.$id_devolucion.$traerCliente['rfc'].'.xml';

			$ruta = $id_devolucion.$traerCliente['rfc'];

			// Ruta del XML de Debug
			//$datos['xml_debug']='SDK2/timbrados/x'.$respuesta[0].'.xml';

			// Credenciales de Timbrado
			$datos['PAC']['usuario'] = 'DEMO700101XXX';
			$datos['PAC']['pass'] = 'DEMO700101XXX';
			$datos['PAC']['produccion'] = 'NO';
			/*$datos['PAC']['usuario'] = 'BAU250609Q85';
			$datos['PAC']['pass'] = 'GU3RR3R0';
			$datos['PAC']['produccion'] = 'SI';*/

			// Rutas y clave de los CSD
			$datos['conf']['cer'] = $traerSucursal['ccer'];
			$datos['conf']['key'] = $traerSucursal['ckey'];
			$datos['conf']['pass'] = $traerSucursal['clave'];


			$listaProductos = json_decode($traerDevolucion['productos'], true);

			//PARA EL ENCABEZADO

			$total_importe_encabezado = 0;

			$total_iva_encabezado = 0;

			foreach ($listaProductos as $key2 => $value2) {

				$cantidad = $value2["cantidad"];
					
				if($cantidad !== "0"){

					//VALOR UNITARIO
					$valor_unitario_encabezado = $value2['precio_unitario'];

					//IMPORTE
					$importe_encabezado = $value2['cantidad'] * $valor_unitario_encabezado;

					//CALCULAR SOLO IVA
					$solo_iva_encabezado = round($importe_encabezado * 0.16, 2); 

					$total_importe_encabezado = $total_importe_encabezado + $importe_encabezado;

					$total_iva_encabezado = $total_iva_encabezado + $solo_iva_encabezado;
				}
			}

			$total_encabezado = $total_importe_encabezado + $total_iva_encabezado;
			$total_encabezado = round($total_encabezado,2);
				$total_importe_encabezado = round($total_importe_encabezado,2);






			// Datos de la Factura
			$datos['factura']['condicionesDePago'] = 'CONDICIONES';
			$datos['factura']['descuento'] = '0.00';
			$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 3610);
			$datos['factura']['folio'] = $id_devolucion;
			$datos['factura']['forma_pago'] = '01';//anuncia si va a ser pagado por efectivo, tarjeta, etc
			$datos['factura']['LugarExpedicion'] = $traerSucursal['codigo_postal'];
			$datos['factura']['metodo_pago'] = 'PUE';//anuncia si va a ser por PUE o PPD
			$datos['factura']['moneda'] = 'MXN';
			$datos['factura']['serie'] = 'A';
			$datos['factura']['subtotal'] = $total_importe_encabezado;
			$datos['factura']['tipocambio'] = 1;
			$datos['factura']['tipocomprobante'] = 'E';
			$datos['factura']['total'] = $total_encabezado;
			//$datos['factura']['RegimenFiscal'] = '601';
			$datos['factura']['Exportacion'] = '01';


			// Datos del Emisor
			$datos['emisor']['rfc'] = $traerSucursal['rfc'];
			$datos['emisor']['nombre'] = $traerSucursal['nombre'];
			$datos['emisor']['RegimenFiscal'] = $traerSucursal['id_regimen'];


			// Datos del Receptor
			$datos['receptor']['rfc'] = $traerCliente['rfc'];
			$datos['receptor']['nombre'] = $traerCliente['nombre'];
			$datos['receptor']['UsoCFDI'] = 'G02';

			//opcional
			$datos['receptor']['DomicilioFiscalReceptor'] = $traerCliente['codigo_postal'];
			//$datos['receptor']['ResidenciaFiscal']= 'MEX';
			//$datos['receptor']['NumRegIdTrib'] = 'B';
			$datos['receptor']['RegimenFiscalReceptor'] = $traerCliente['id_regimen'];

			// Se agregan los conceptos


			$total_iva = 0;
			$total_importe = 0;

			foreach ($listaProductos as $key => $value) {

				$cantidad = $value["cantidad"];

				if($cantidad !== "0"){

					$id_producto = $value['id_producto'];

					$traerProducto = ModeloProductos::mdlMostrarProducto($id_producto);


					$datos['conceptos'][$key]['cantidad'] = $value['cantidad'];
					$datos['conceptos'][$key]['unidad'] = $traerProducto['unidad']; 
					$datos['conceptos'][$key]['ID'] = $traerProducto['clave_producto']; 
					$datos['conceptos'][$key]['descripcion'] = $traerProducto['descripcion_corta'];


					//VALOR UNITARIO
					$valor_unitario = $value['precio_unitario'];

					//PRECIO NETO / 1.16 REDONDEADO CON DOS DECIMALES--- VALOR UNITARIO
					$datos['conceptos'][$key]['valorunitario'] = $valor_unitario;


					//IMPORTE
					$importe = $value['cantidad'] * $valor_unitario;


					//CANTIDAD POR EL VALOR UNITARIO
					$datos['conceptos'][$key]['importe'] = $importe;


					//CLAVE SAT
					$datos['conceptos'][$key]['ClaveProdServ'] = $traerProducto['clave_sat'];


					//CLAVE DEL SAT
					$datos['conceptos'][$key]['ClaveUnidad'] = $traerProducto['cve_unidad'];


					//OBJETO DE IMPUESTO
					$datos['conceptos'][$key]['ObjetoImp'] = '02';


					//IMPORTE
					$datos['conceptos'][$key]['Impuestos']['Traslados'][$key]['Base'] = $importe;


					//IVA
					$datos['conceptos'][$key]['Impuestos']['Traslados'][$key]['Impuesto'] = '002';

					//TASA
					$datos['conceptos'][$key]['Impuestos']['Traslados'][$key]['TipoFactor'] = 'Tasa';


					//
					$datos['conceptos'][$key]['Impuestos']['Traslados'][$key]['TasaOCuota'] = '0.160000';


					//CALCULAR SOLO IVA
					$solo_iva = round($importe * 0.16, 2); 


					//IMPORTE POR 0.16 REDONDEADO CON DOS DECIMALES
					$datos['conceptos'][$key]['Impuestos']['Traslados'][$key]['Importe'] = $solo_iva;

					$total_importe = $total_importe + $importe;
					$total_iva = $total_iva + $solo_iva;
				}//si la cantidad es 0
			}



// Se agregan los Impuestos
$datos['impuestos']['translados'][0]['Base'] = $total_importe;
$datos['impuestos']['translados'][0]['impuesto'] = '002';
$datos['impuestos']['translados'][0]['tasa'] = '0.160000';
$datos['impuestos']['translados'][0]['importe'] = $total_iva;
$datos['impuestos']['translados'][0]['TipoFactor'] = 'Tasa';


$datos['impuestos']['TotalImpuestosTrasladados'] = $total_iva;
/*echo "<pre>";
print_r($datos);
echo "</pre>";
*/
//echo "<pre>"; echo arr2cs($datos); echo "</pre>".die();
// Se ejecuta el SDK
//$res = mf_genera_cfdi($datos);
$res = mf_genera_cfdi4($datos);

//$respuestaTimbrado = $res['codigo_mf_texto'];



return array($res['codigo_mf_texto'],
	$res['codigo_mf_numero'],
	$res['uuid'],
	$res['representacion_impresa_certificado_no'],
	$res['representacion_impresa_sello'],
	$res['representacion_impresa_selloSAT'],
	$res['representacion_impresa_cadena'],
	$res['representacion_impresa_certificadoSAT'],
	$res['representacion_impresa_fecha_timbrado'],
	$ruta,
	$total_encabezado);

}

$stmt -> close();

$stmt = null;

}






	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlCrearDevolucion($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO devoluciones (id_venta, id_cliente, productos, total, tipo_devolucion, id_motivo_devolucion, id_sucursal, id_usuario_creador) VALUES (:id_venta, :id_cliente, :productos, :total, :tipo_devolucion, :id_motivo_devolucion, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_devolucion", $datos["tipo_devolucion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_motivo_devolucion", $datos["id_motivo_devolucion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM devoluciones LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	












	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlAplicarPago($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones SET id_corte_caja = :id_corte_caja, saldo_actual = :saldo_actual, efectivo = :efectivo, tarjeta_debito = :tarjeta_debido, tarjeta_credito = :tarjeta_credito, transferencia = :transferencia, cambio = :cambio, pagado = 1, id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
		$stmt->bindParam(":saldo_actual", $datos["saldo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_debido", $datos["tarjeta_debido"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_credito", $datos["tarjeta_credito"], PDO::PARAM_STR);
		$stmt->bindParam(":transferencia", $datos["transferencia"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_forma_pago", $datos["id_forma_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cfdi", $datos["id_cfdi"], PDO::PARAM_STR);
		$stmt->bindParam(":id_metodo_pago", $datos["id_metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarDevolucion($id_devolucion){

		$stmt = Conexion::conectar()->prepare("DELETE FROM devoluciones WHERE id_devolucion = :id_devolucion");

		$stmt -> bindParam(":id_devolucion", $id_devolucion, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlDevolucionTimbrada($datosTimbrada){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones SET facturado = 1,
					uuid = :uuid,
					certnumber = :certnumber,
					sello = :sello,
					sello_sat = :sello_sat,
					cadena_timbre = :cadena_timbre,
					no_certificado_sat = :no_certificado_sat,
					fecha_timbrado = :fecha_timbrado,
					ruta = :ruta, 
					id_usuario_ult_mod = :id_usuario_ult_mod
					WHERE id_devolucion = :id_devolucion");

		$stmt->bindParam(":id_devolucion", $datosTimbrada["id_devolucion"], PDO::PARAM_INT);
		$stmt->bindParam(":uuid", $datosTimbrada["uuid"], PDO::PARAM_STR);
		$stmt->bindParam(":certnumber", $datosTimbrada["certnumber"], PDO::PARAM_STR);
		$stmt->bindParam(":sello", $datosTimbrada["sello"], PDO::PARAM_STR);
		$stmt->bindParam(":sello_sat", $datosTimbrada["sello_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":cadena_timbre", $datosTimbrada["cadena_timbre"], PDO::PARAM_STR);
		$stmt->bindParam(":no_certificado_sat", $datosTimbrada["no_certificado_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datosTimbrada["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_timbrado", $datosTimbrada["fecha_timbrado"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function consultaReporteDevolucionesCajero($id_usuario, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT devoluciones.id_devolucion, devoluciones.fecha_creacion, devoluciones.total, devoluciones.id_venta, ventas.folio, devoluciones.id_corte_caja FROM devoluciones INNER JOIN cortes_caja ON devoluciones.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN ventas ON devoluciones.id_venta = ventas.id WHERE devoluciones.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND cortes_caja.id_usuario_creador = :id_usuario AND devoluciones.id_sucursal = :id_sucursal ORDER BY devoluciones.id_devolucion DESC");
	

	$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
    $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);

            if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

        $stmt -> close();

        $stmt = null;

}










static public function consultaReporteDevolucionesVendedor($id_vendedor, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT devoluciones.id_devolucion, devoluciones.fecha_creacion, devoluciones.total, devoluciones.id_venta, ventas.folio, devoluciones.id_corte_caja FROM devoluciones INNER JOIN cortes_caja ON devoluciones.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN ventas ON devoluciones.id_venta = ventas.id WHERE devoluciones.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND ventas.id_vendedor = :id_vendedor AND devoluciones.id_sucursal = :id_sucursal ORDER BY devoluciones.id_devolucion DESC");

	$stmt -> bindParam(":id_vendedor", $id_vendedor, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
    $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);

            if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

        $stmt -> close();

        $stmt = null;

}








		

static public function mdlMostrarDevolucionesCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones WHERE id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			if($stmt -> execute()){

			return $stmt -> fetchAll();
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	

	
}
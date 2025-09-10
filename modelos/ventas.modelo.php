 <?php

require_once "conexion.php";

class ModeloVentas{





	static public function mdlInsertarFacturaGlobalVentas($fecha1, $fecha2, $id_factura_global, $id_sucursal){

			$stmt = Conexion::conectar()->prepare("UPDATE ventas SET id_factura_global = :id_factura_global WHERE id_factura_global = 0 AND tipo_venta = 'NT' AND pagada = 1 AND cancelada = 0 AND id_sucursal = :id_sucursal AND fecha_creacion BETWEEN :fecha1 AND :fecha2");

			$stmt -> bindParam(":id_factura_global", $id_factura_global, PDO::PARAM_INT);

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





	static public function mdlMostrarVentasCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			if($stmt -> execute()){

			return $stmt -> fetchAll();
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}





		/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventas (folio, id_cliente, nombre, celular, productos, total, no_forma_pago, tipo_venta, id_sucursal, id_vendedor) VALUES (:folio, :id_cliente, :nombre, :celular, :productos, :total, :no_forma_pago, :tipo_venta, :id_sucursal, :id_vendedor)");

		$stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":no_forma_pago", $datos["no_forma_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_venta", $datos["tipo_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM ventas LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlEntregarVenta($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE ventas SET entregada = :entregada, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_venta");

    $stmt -> bindParam(":id_venta", $datos['id_venta'], PDO::PARAM_INT);
    $stmt -> bindParam(":entregada", $datos['entregada'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_usuario_ult_mod", $datos['id_usuario_ult_mod'], PDO::PARAM_INT);

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

  static public function mdlActualizarSaldoActual($nuevoSaldo, $id_venta){

    $stmt = Conexion::conectar()->prepare("UPDATE ventas SET saldo_actual = :saldo_actual WHERE id = :id_venta");

    $stmt -> bindParam(":saldo_actual", $nuevoSaldo, PDO::PARAM_STR);
    $stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentasEspera($id_sucursal){


			$stmt = Conexion::conectar()->prepare("SELECT id, tipo_venta, total, pagada, fecha_creacion, id_vendedor FROM ventas WHERE pagada = 0 AND cancelada = 0 AND id_sucursal = :id_sucursal AND fecha_creacion BETWEEN '0000-00-00 00:00:00' AND DATE_SUB(now(), INTERVAL 5 MINUTE)");
			
			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVenta($id_venta){

		if($id_venta != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id = :id_venta");

			$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR VENTAS CLIENTE
	=============================================*/

	static public function mdlMostrarVentaCliente($valor1){

		if($valor1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT ventas.id, ventas.id_cliente, ventas.id_vendedor, ventas.productos, ventas.total, ventas.saldo_actual, ventas.tipo_venta, ventas.productos, ventas.dinero, ventas.efectivo, ventas.tarjeta_debito, ventas.tarjeta_credito, ventas.transferencia, ventas.id_cfdi, ventas.id_metodo_pago, ventas.id_forma_pago, ventas.id_sucursal, clientes.nombre FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE id = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS CLIENTE
	=============================================*/

	static public function mdlMostrarVentaCobro($valor1, $id_sucursal){

		if($valor1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT ventas.id, ventas.id_cliente, ventas.total, ventas.saldo_actual, ventas.celular, ventas.no_forma_pago, ventas.pagada, ventas.cancelada, ventas.tipo_venta, ventas.id_sucursal, ventas.fecha_creacion, clientes.nombre, clientes.telefono1 FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE ventas.id = :id AND ventas.id_sucursal = :id_sucursal");

			$stmt -> bindParam(":id", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarVentaCobroFolio($folio, $id_sucursal){

		if($folio != null){

			$stmt = Conexion::conectar()->prepare("SELECT ventas.id, ventas.id_cliente, ventas.total, ventas.saldo_actual, ventas.no_forma_pago, ventas.pagada, ventas.cancelada, ventas.tipo_venta, ventas.id_sucursal, clientes.nombre, clientes.telefono1 FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE ventas.folio = :folio AND ventas.id_sucursal = :id_sucursal AND pagada = 0");

			$stmt -> bindParam(":folio", $folio, PDO::PARAM_STR);
			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}









		/*=============================================
	MOSTRAR VENTAS CLIENTE PARA FACTURAR
	=============================================*/

	static public function mdlMostrarVentaFactura($id_venta){

		if($id_venta != null){

			$stmt = Conexion::conectar()->prepare("SELECT ventas.id, ventas.id_cliente, ventas.total, ventas.saldo_actual, ventas.pagado, ventas.tipo_venta, clientes.nombre FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE id = :id");

			$stmt -> bindParam(":id", $id_venta, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}










	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarPartidasVenta($id_venta){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM partvta WHERE id_venta = :id_venta");

			$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	TIMBRAR VENTA
	=============================================*/

	static public function mdlTimbrarVenta($id_venta){

		if($id_venta != null){

			date_default_timezone_set('America/Mexico_City');


			$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

			$traerCliente = ControladorClientes::ctrMostrarCliente($traerVenta['id_cliente']);
			
			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerVenta['id_sucursal']);

			$traerPartidasVenta = ModeloPartvta::mdlMostrarPartidasVenta($id_venta);
// Se especifica la version de CFDi 4.0
			$datos['version_cfdi'] = '4.0';

			$nombre_archivo = $id_venta.$traerCliente['rfc'];
// Ruta del XML Timbrado
			$datos['cfdi']='SDK2/timbrados/FC-'.$id_venta.'.xml';

			$ruta = "FC-".$id_venta;

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



//PARA EL ENCABEZADO

			foreach ($traerPartidasVenta as $key2 => $value2) {

				if($value2['precio_neto'] != 0){

					$cantidad_encabezado = $value2['cantidad'] - $value2['cant_dev'];

					if($cantidad_encabezado != 0){

	//VALOR UNITARIO
				$valor_unitario_encabezado = round($value2['precio_neto'] / 1.16, 2);

//IMPORTE
				$importe_encabezado = $cantidad_encabezado * $valor_unitario_encabezado;

//CALCULAR SOLO IVA
				$solo_iva_encabezado = round($importe_encabezado * 0.16, 2); 

				$total_importe_encabezado = $total_importe_encabezado + $importe_encabezado;
				$total_iva_encabezado = $total_iva_encabezado + $solo_iva_encabezado;

			}

			}

			}

			$total_encabezado = $total_importe_encabezado + $total_iva_encabezado;





// Datos de la Factura
			$datos['factura']['condicionesDePago'] = 'CONDICIONES';
			$datos['factura']['descuento'] = '0.00';
			$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 3610);
			$datos['factura']['folio'] = $traerVenta['folio'];
$datos['factura']['forma_pago'] = $traerVenta['id_forma_pago'];
$datos['factura']['LugarExpedicion'] = $traerSucursal['codigo_postal'];
$datos['factura']['metodo_pago'] = $traerVenta['id_metodo_pago'];
$datos['factura']['moneda'] = 'MXN';
$datos['factura']['serie'] = 'A';
$datos['factura']['subtotal'] = $total_importe_encabezado;
$datos['factura']['tipocambio'] = 1;
$datos['factura']['tipocomprobante'] = 'I';
$datos['factura']['total'] = $total_encabezado;
$datos['factura']['Exportacion'] = '01';


// Datos del Emisor
$datos['emisor']['rfc'] = $traerSucursal['rfc'];
$datos['emisor']['nombre'] = $traerSucursal['nombre'];
$datos['emisor']['RegimenFiscal'] = $traerSucursal['id_regimen'];






// Datos del Receptor
$datos['receptor']['rfc'] = $traerCliente['rfc'];
$datos['receptor']['nombre'] = $traerCliente['nombre'];
$datos['receptor']['UsoCFDI'] = $traerVenta['id_cfdi'];

//opcional
$datos['receptor']['DomicilioFiscalReceptor'] = $traerCliente['codigo_postal'];
//$datos['receptor']['ResidenciaFiscal']= 'MEX';
//$datos['receptor']['NumRegIdTrib'] = 'B';
$datos['receptor']['RegimenFiscalReceptor'] = $traerCliente['id_regimen'];

// Se agregan los conceptos



foreach ($traerPartidasVenta as $key => $value) {

	$id_producto = $value['id_producto'];

	$traerProducto = ModeloProductos::mdlMostrarProducto($id_producto);

	if($value['precio_neto'] != 0){

		$cantidad = $value['cantidad'] - $value['cant_dev'];

		if($cantidad != 0){

	$datos['conceptos'][$key]['cantidad'] = $cantidad;
	$datos['conceptos'][$key]['unidad'] = $traerProducto['unidad']; 
	$datos['conceptos'][$key]['ID'] = $traerProducto['clave_producto']; 
	$datos['conceptos'][$key]['descripcion'] = $traerProducto['descripcion_corta'];


//VALOR UNITARIO
	//$valor_unitario = round($value['precio_neto'] / 1.16, 2);
	$valor_unitario = round($value['precio_neto'] / 1.16, 2);

//PRECIO NETO / 1.16 REDONDEADO CON DOS DECIMALES--- VALOR UNITARIO
	$datos['conceptos'][$key]['valorunitario'] = $valor_unitario;


//IMPORTE
	$importe = $cantidad * $valor_unitario;


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

}

}

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
	$nombre_archivo,
	$total_encabezado);

}

$stmt -> close();

$stmt = null;

}










	static public function mdlGuardarDatosCobro($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET id_corte_caja = :id_corte_caja, saldo_actual = :saldo_actual, dinero = :dinero, efectivo = :efectivo, tarjeta_debito = :tarjeta_debido, tarjeta_credito = :tarjeta_credito, transferencia = :transferencia, cambio = :cambio, id_terminal_bancaria = :id_terminal_bancaria, pagada = 1, fecha_pago = NOW(), id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
		$stmt->bindParam(":saldo_actual", $datos["saldo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":dinero", $datos["dinero"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_debido", $datos["tarjeta_debido"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_credito", $datos["tarjeta_credito"], PDO::PARAM_STR);
		$stmt->bindParam(":transferencia", $datos["transferencia"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_terminal_bancaria", $datos["id_terminal_bancaria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlGuardarDatosFactura($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET folio = :folio, tipo_venta = 'FC', id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id_venta");

		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
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
	EDITAR VENTA
	=============================================*/

	static public function mdlAplicarPago($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET id_corte_caja = :id_corte_caja, saldo_actual = :saldo_actual, efectivo = :efectivo, tarjeta_debito = :tarjeta_debido, tarjeta_credito = :tarjeta_credito, transferencia = :transferencia, cambio = :cambio, pagada = 1, id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago, fecha_pago = NOW() WHERE id = :id");

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

	static public function mdlEliminarVenta($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM ventas WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM ventas");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlVentaTimbrada($datosTimbrada){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET facturado = 1,
					uuid = :uuid,
					certnumber = :certnumber,
					sello = :sello,
					sello_sat = :sello_sat,
					cadena_timbre = :cadena_timbre,
					no_certificado_sat = :no_certificado_sat,
					fecha_timbrado = :fecha_timbrado,
					ruta = :ruta,
					id_usuario_ult_mod = :id_usuario_ult_mod
					WHERE id = :id");

		$stmt->bindParam(":id", $datosTimbrada["id"], PDO::PARAM_INT);
		$stmt->bindParam(":uuid", $datosTimbrada["uuid"], PDO::PARAM_STR);
		$stmt->bindParam(":certnumber", $datosTimbrada["certnumber"], PDO::PARAM_STR);
		$stmt->bindParam(":sello", $datosTimbrada["sello"], PDO::PARAM_STR);
		$stmt->bindParam(":sello_sat", $datosTimbrada["sello_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":cadena_timbre", $datosTimbrada["cadena_timbre"], PDO::PARAM_STR);
		$stmt->bindParam(":no_certificado_sat", $datosTimbrada["no_certificado_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datosTimbrada["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_timbrado", $datosTimbrada["fecha_timbrado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_ult_mod", $datosTimbrada["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}







/*=============================================
	REPORTES VENTAS HOY
	=============================================*/
/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function mdlMostrarNoVentasHoy(){

		

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as no_ventas FROM ventas WHERE pagada = 1 AND cancelada = 0 AND DATE(fecha_creacion) = DATE(NOW())");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function mdlMostrarSumaVentasHoy(){

		

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total_ventas FROM ventas WHERE pagada = 1 AND cancelada = 0 AND DATE(fecha_creacion) = DATE(NOW())");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}










	static public function mdlVerificarNoVentasRangoFechasFacturaGlobal($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as no_ventas FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND tipo_venta = 'NT' AND pagada = 1 AND cancelada = 0 AND id_factura_global != 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










static public function mdlMostrarSumaVentasRangoFechasFacturaGlobal($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND tipo_venta = 'NT' AND pagada = 1 AND cancelada = 0 AND id_factura_global = 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}









	static public function mdlMostrarSumaVentasRangoFechas($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND pagada = 1 AND cancelada = 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarNoVentasRangoFechas($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as no_ventas FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND pagada = 1 AND cancelada = 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarSumaUtilidadVentasRangoFechas($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT (SUM(partvta.cantidad * partvta.precio_neto)-Sum(partvta.cantidad*(partvta.precio_compra * 1.16))) AS total_utilidad FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	






/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlConvertirNotaFactura($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET tipo_venta = 'FC', id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
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
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlActualizarVenta($columna, $valor, $id_venta, $id_sucursal, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_venta AND id_sucursal = :id_sucursal");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	





	static public function mdlActualizarVenta2($columna, $valor, $id_venta, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_venta");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlMostrarSumaVentasProductoRangoFechas($fecha1, $fecha2, $id_producto, $id_sucursal){
	    
            $stmt = Conexion::conectar()->prepare("SELECT SUM(partvta.cantidad) AS cantidad_vendida, SUM(partvta.cantidad * partvta.precio_neto) AS total_ventas FROM partvta INNER JOIN ventas ON partvta.id_venta = ventas.id WHERE ventas.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_sucursal = $id_sucursal AND partvta.id_producto = $id_producto");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}
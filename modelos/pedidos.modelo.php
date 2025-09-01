<?php

require_once "conexion.php";

class ModeloPedidos{



	 /*=============================================
  ACTUALIZAR VENTA
  =============================================*/

  static public function mdlActualizarSaldoActual($nuevoSaldo, $id_pedido){

    $stmt = Conexion::conectar()->prepare("UPDATE pedidos SET saldo_actual = :saldo_actual WHERE id = :id_pedido");

    $stmt -> bindParam(":saldo_actual", $nuevoSaldo, PDO::PARAM_STR);
    $stmt -> bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);

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

	static public function mdlMostrarPedidos($tabla, $columna, $valor){

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
	MOSTRAR VENTAS CLIENTE
	=============================================*/

	static public function mdlMostrarPedidoCliente($valor1){

		if($valor1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT pedidos.id, pedidos.id_cliente, pedidos.total, pedidos.saldo_actual, pedidos.tipo_pedido, pedidos.productos, pedidos.efectivo, pedidos.tarjeta_debito, pedidos.tarjeta_credito, pedidos.transferencia, pedidos.id_cfdi, pedidos.id_metodo_pago, pedidos.id_forma_pago, clientes.nombre FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente WHERE id = :valor1");

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

	static public function mdlMostrarPedidoCobro($valor1){

		if($valor1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT pedidos.id, pedidos.id_cliente, pedidos.total, pedidos.saldo_actual, pedidos.pagado, pedidos.tipo_pedido, clientes.nombre FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente WHERE id = :id AND pagado = 0");

			$stmt -> bindParam(":id", $valor1, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	TIMBRAR VENTA
	=============================================*/

	static public function mdlTimbrarPedido($valor1, $productos){

		if($valor1 != null){

			

				// Se especifica la zona horaria
			date_default_timezone_set('America/Mexico_City');


//Traemos los datos de la pedido y del cliente
			$id_pedido = $valor1;

			$respuestaPedidoCliente = ModeloPedidos::mdlMostrarPedidoCliente($id_pedido);

			$id_cliente = $respuestaPedidoCliente['id_cliente'];

			$tablaClientes = 'clientes';

			$columna = 'id_cliente';

			$respuestaCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $columna, $id_cliente);


// Se especifica la version de CFDi 4.0
			$datos['version_cfdi'] = '4.0';

// Ruta del XML Timbrado
			$datos['cfdi']='SDK2/timbrados/'.$valor1.'.xml';

// Ruta del XML de Debug
//$datos['xml_debug']='SDK2/timbrados/x'.$respuesta[0].'.xml';

// Credenciales de Timbrado
			$datos['PAC']['usuario'] = 'DEMO700101XXX';
			$datos['PAC']['pass'] = 'DEMO700101XXX';
			$datos['PAC']['produccion'] = 'NO';

// Rutas y clave de los CSD
			$datos['conf']['cer'] = 'SDK2/certificados/EKU9003173C9.cer.pem';
			$datos['conf']['key'] = 'SDK2/certificados/EKU9003173C9.key.pem';
			$datos['conf']['pass'] = '12345678a';


			$listaProductos = json_decode($productos, true);

//PARA EL ENCABEZADO

			foreach ($listaProductos as $key2 => $value2) {

	//VALOR UNITARIO
				$valor_unitario_encabezado = round($value2['precio'] / 1.16, 2);

//IMPORTE
				$importe_encabezado = $value2['cantidad'] * $valor_unitario_encabezado;

//CALCULAR SOLO IVA
				$solo_iva_encabezado = round($importe_encabezado * 0.16, 2); 

				$total_importe_encabezado = $total_importe_encabezado + $importe_encabezado;
				$total_iva_encabezado = $total_iva_encabezado + $solo_iva_encabezado;

			}

			$total_encabezado = $total_importe_encabezado + $total_iva_encabezado;





// Datos de la Factura
			$datos['factura']['condicionesDePago'] = 'CONDICIONEES';
			$datos['factura']['descuento'] = '0.00';
			$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 120);
			$datos['factura']['folio'] = $id_pedido;
$datos['factura']['forma_pago'] = $respuestaPedidoCliente['id_metodo_pago'];//anuncia si va a ser pagado por efectivo, tarjeta, etc
$datos['factura']['LugarExpedicion'] = '45079';
$datos['factura']['metodo_pago'] = $respuestaPedidoCliente['id_forma_pago'];//anuncia si va a ser por PUE o PPD
$datos['factura']['moneda'] = 'MXN';
$datos['factura']['serie'] = 'A';
$datos['factura']['subtotal'] = $total_importe_encabezado;
$datos['factura']['tipocambio'] = 1;
$datos['factura']['tipocomprobante'] = 'I';
$datos['factura']['total'] = $total_encabezado;
//$datos['factura']['RegimenFiscal'] = '601';
$datos['factura']['Exportacion'] = '01';


// Datos del Emisor
$datos['emisor']['rfc'] = 'EKU9003173C9'; //RFC DE PRUEBA
$datos['emisor']['nombre'] = 'ESCUELA KEMPER URGATE';  // EMPRESA DE PRUEBA
$datos['emisor']['RegimenFiscal'] = '601';
//$datos['emisor']['FacAtrAdquirente'] = 'ACCEM SERVICIOS EMPRESARIALES SC';






// Datos del Receptor
$datos['receptor']['rfc'] = $respuestaCliente['rfc'];
$datos['receptor']['nombre'] = $respuestaCliente['nombre'];
$datos['receptor']['UsoCFDI'] = $respuestaPedidoCliente['id_cfdi'];

//opcional
$datos['receptor']['DomicilioFiscalReceptor'] = $respuestaCliente['codigo_postal'];
//$datos['receptor']['ResidenciaFiscal']= 'MEX';
//$datos['receptor']['NumRegIdTrib'] = 'B';
$datos['receptor']['RegimenFiscalReceptor'] = $respuestaCliente['id_regimen'];

// Se agregan los conceptos



foreach ($listaProductos as $key => $value) {

	$tablaProductos = 'productos';
	$columna = 'id_producto';
	$id_producto = $value['id'];

	$respuesta = ModeloProductos::mdlMostrarProductos($tablaProductos, $columna, $id_producto);




	$datos['conceptos'][$key]['cantidad'] = $value['cantidad'];
	$datos['conceptos'][$key]['unidad'] = $respuesta['unidad']; 
	$datos['conceptos'][$key]['ID'] = $respuesta['clave_producto']; 
	$datos['conceptos'][$key]['descripcion'] = $value['descripcion'];


//VALOR UNITARIO
	$valor_unitario = round($value['precio'] / 1.16, 2);

//PRECIO NETO / 1.16 REDONDEADO CON DOS DECIMALES--- VALOR UNITARIO
	$datos['conceptos'][$key]['valorunitario'] = $valor_unitario;


//IMPORTE
	$importe = $value['cantidad'] * $valor_unitario;


//CANTIDAD POR EL VALOR UNITARIO
	$datos['conceptos'][$key]['importe'] = $importe;


//CLAVE SAT
	$datos['conceptos'][$key]['ClaveProdServ'] = $respuesta['clave_sat'];


//CLAVE DEL SAT
	$datos['conceptos'][$key]['ClaveUnidad'] = $respuesta['cve_unidad'];


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

$respuestaTimbrado = $res['codigo_mf_texto'];



return $respuestaTimbrado;

}

$stmt -> close();

$stmt = null;

}






	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (folio, id_cliente, id_vendedor, productos, total, tipo_pedido) VALUES (:folio, :id_cliente, :id_vendedor, :productos, :total, :tipo_pedido)");

		$stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_pedido", $datos["tipo_pedido"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM pedidos LIMIT 1;");

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

		$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET saldo_actual = :saldo_actual, efectivo = :efectivo, tarjeta_debito = :tarjeta_debido, tarjeta_credito = :tarjeta_credito, transferencia = :transferencia, cambio = :cambio, pagado = 1, id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
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

	static public function mdlEliminarPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

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

	static public function mdlRangoFechasPedidos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalPedidos($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlPedidoTimbrada($valor1){

		$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET facturado = 1 WHERE id = :id");

		$stmt -> bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor2, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}








/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function mdlMostrarNoPedidos(){

		

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as no_pedidos FROM pedidos");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function mdlMostrarSumaPedidos(){

		

		$stmt = Conexion::conectar()->prepare("SELECT total - saldo_actual as total_pedidos FROM pedidos");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}






/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlConvertirNotaFactura($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET tipo_pedido = 'FC', id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

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

	
}
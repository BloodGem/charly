<?php

require_once "conexion.php";

class ModeloCsxc{






	static public function mdlCrearAbono($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cxc (id_venta, id_cliente, id_metodo, importe, documento, observacion) VALUES (:id_venta, :id_cliente, :id_metodo, :importe, :documento, :observacion)");

		$stmt -> bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_metodo", $datos["id_metodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		}else{
			return "error";
		}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}



















	static public function mdlMostrarAdeudoTotalClienteC($id_cliente){

		if($id_cliente != null){
			$stmt = Conexion::conectar()->prepare("SELECT clientes.id_cliente, clientes.nombre, SUM(ventas.saldo_actual) as adeudo_total FROM `ventas` INNER JOIN clientes on ventas.id_cliente = clientes.id_cliente WHERE clientes.id_cliente = :id_cliente");

		$stmt -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);//Aquí enlazamos un el parametro que se manda por PDO por ejemplo la sentencia de arriba manda por PDO el :$valor por lo que lo tenemos que enlazar el parametro, entonces se le dice que vamos a comparar la columna con el valor y le vamos a decir que solo va a recibir string

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

	}


		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}



	static public function mdlCrearCxc($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cxc (id_venta, id_cliente, importe) VALUES (:id_venta, :id_cliente, :importe)");

		$stmt -> bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		//$stmt -> bindParam(":id_metodo", $datos["id_metodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		//$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		//$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		}else{
			return "error";
		}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}














	/*=============================================
	TIMBRAR VENTA
	=============================================*/

	static public function mdlTimbrarCxc($id_cliente, $lista){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
            $id_sucursal = $traerUsuario['id_sucursal'];

			$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

		$traerCliente = ModeloClientes::mdlMostrarCliente($id_cliente);

		


		// Se especifica la zona horaria
		date_default_timezone_set('America/Mexico_City');



		// Se especifica la version de CFDi 4.0
		$datos['version_cfdi'] = '4.0';

		// SE ESPECIFICA EL COMPLEMENTO
		$datos['complemento'] = 'pagos20';
		$datos['validacion_local'] = 'NO';

		// Ruta del XML Timbrado
		// 
		$listaCsxc = json_decode($lista, true);

		
		$nombre_documento = $traerCliente['rfc'];

		foreach ($listaCsxc as $key3 => $value3) {

			$nombre_documento = $nombre_documento . '-' . $value3['id_venta'];

		}

		$datos['cfdi']='SDK2/timbrados/pagos/'.$nombre_documento.'.xml';

		// Ruta del XML de Debug
		$datos['xml_debug']='SDK2/timbrados/pagos/debug_'.$nombre_documento.'.xml';

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

		// Datos de la Factura
		$datos['factura']['serie'] = 'Z';
		$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 3610);
		$datos['factura']['folio'] = '100';
		$datos['factura']['subtotal'] = '0';
		$datos['factura']['total'] = '0';
		$datos['factura']['moneda'] = 'XXX';
		$datos['factura']['tipocomprobante'] = 'P';
		$datos['factura']['LugarExpedicion'] = $traerSucursal['codigo_postal'];
		$datos['factura']['Exportacion'] = '01';

		// Datos del Emisor
		$datos['emisor']['rfc'] = $traerSucursal['rfc']; //RFC DE PRUEBA
		$datos['emisor']['nombre'] = $traerSucursal['nombre'];  // EMPRESA DE PRUEBA
		$datos['emisor']['RegimenFiscal'] = $traerSucursal['id_regimen'];


		// Datos del Receptor
		$datos['receptor']['rfc'] = $traerCliente['rfc'];
		$datos['receptor']['nombre'] = $traerCliente['nombre'];
		$datos['receptor']['UsoCFDI'] = 'CP01';
		$datos['receptor']['DomicilioFiscalReceptor'] = $traerCliente['codigo_postal'];
		$datos['receptor']['RegimenFiscalReceptor'] = $traerCliente['id_regimen'];


					

		// Se agregan los conceptos
		$datos['conceptos'][0]['ClaveProdServ'] = '84111506';
		$datos['conceptos'][0]['cantidad'] = '1';
		$datos['conceptos'][0]['ClaveUnidad'] = 'ACT';
		$datos['conceptos'][0]['descripcion'] = "Pago";
		$datos['conceptos'][0]['valorunitario'] = '0';
		$datos['conceptos'][0]['importe'] = '0';
		$datos['conceptos'][0]['ObjetoImp'] = '01';//no es objeto de impuesto


		$totalImporte = 0;


		foreach ($listaCsxc as $key2 => $value2) {

			$importe = $value2['importe'];



			$totalImporte = $totalImporte + $importe;

		}







		$datos['pagos20']['Pagos'][0]['FechaPago']= date('Y-m-d\TH:i:s', time() - 3610);
		$datos['pagos20']['Pagos'][0]['FormaDePagoP']= '06';// SI FUE POR TRANFERENCIA ETC
		$datos['pagos20']['Pagos'][0]['MonedaP']= 'MXN';
		$datos['pagos20']['Pagos'][0]['TipoCambioP']= '1';
		$datos['pagos20']['Pagos'][0]['Monto']= $totalImporte;
		$datos['pagos20']['Pagos'][0]['NomBancoOrdExt']= '0.0';



//LA PARCIALIDAD LLEVA UN FOLIO EN SU VENTA

		foreach ($listaCsxc as $key => $value) {




			$traerVenta = ModeloVentas::mdlMostrarVenta($value['id_venta']);


			$saldo_insoluto = $value['adeudo'] - $value['importe'];

			$saldo_insoluto = round($saldo_insoluto, 2);


			// Complemento de Pagos 1.0
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['IdDocumento'] = $traerVenta['uuid'];
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['Serie'] = 'A';
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['Folio'] = '85';
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['MonedaDR'] = 'MXN';
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['NumParcialidad'] = '1';
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['ImpSaldoAnt']= $value['adeudo'];
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['ImpPagado'] = $value['importe'];
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['ImpSaldoInsoluto'] = $saldo_insoluto;
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['EquivalenciaDR'] = '1';
			$datos['pagos20']['Pagos'][0]['DoctoRelacionado'][$key]['ObjetoImpDR'] = '01';


		
		}


			

			$datos['pagos20']['Totales']['MontoTotalPagos']= $totalImporte;

		// Se ejecuta el SDK
		$res= mf_genera_cfdi4($datos);

		return array($res['codigo_mf_texto']);
		
	}
}
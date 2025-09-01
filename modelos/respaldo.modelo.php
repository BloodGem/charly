/*=============================================
	TIMBRAR VENTA
	=============================================*/

	static public function mdlTimbrarVenta($id_venta){

		if($id_venta != null){

			

				// Se especifica la zona horaria
			date_default_timezone_set('America/Mexico_City');


//Traemos los datos de la venta y del cliente

			$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

			$respuestaCliente = ModeloClientes::mdlMostrarClientes($traerVenta['id_cliente']);
			
			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			$traerSucursal = ModeloSucursales::mdlMostrarSucursal($traerUsuario['id_sucursal']);

			$id_sucursal = $traerSucursal['id_sucursal'];
// Se especifica la version de CFDi 4.0
			$datos['version_cfdi'] = '4.0';

// Ruta del XML Timbrado
			$datos['cfdi']='SDK2/timbrados/'.$id_venta.$respuestaCliente['rfc'].'.xml';

			$ruta = $id_venta.$respuestaCliente['rfc'];

// Ruta del XML de Debug
//$datos['xml_debug']='SDK2/timbrados/x'.$respuesta[0].'.xml';

// Credenciales de Timbrado
			$datos['PAC']['usuario'] = 'DEMO700101XXX';
			$datos['PAC']['pass'] = 'DEMO700101XXX';
			$datos['PAC']['produccion'] = 'NO';

// Rutas y clave de los CSD
			$datos['conf']['cer'] = $respuestaSucursal['ccer'];
			$datos['conf']['key'] = $respuestaSucursal['ckey'];
			$datos['conf']['pass'] = $respuestaSucursal['clave'];


			$listaProductos = json_decode($traerVenta['productos'], true);

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
			$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 3610);
			$datos['factura']['folio'] = $id_venta;
$datos['factura']['forma_pago'] = $traerVenta['id_forma_pago'];//anuncia si va a ser pagado por efectivo, tarjeta, etc
$datos['factura']['LugarExpedicion'] = '45079';
$datos['factura']['metodo_pago'] = $respuestaVenta['id_metodo_pago'];//anuncia si va a ser por PUE o PPD
$datos['factura']['moneda'] = 'MXN';
$datos['factura']['serie'] = 'A';
$datos['factura']['subtotal'] = $total_importe_encabezado;
$datos['factura']['tipocambio'] = 1;
$datos['factura']['tipocomprobante'] = 'I';
$datos['factura']['total'] = $total_encabezado;
//$datos['factura']['RegimenFiscal'] = '601';
$datos['factura']['Exportacion'] = '01';


// Datos del Emisor
$datos['emisor']['rfc'] = $traerSucursal['rfc']; //RFC DE PRUEBA
$datos['emisor']['nombre'] = $traerSucursal['nombre'];  // EMPRESA DE PRUEBA
$datos['emisor']['RegimenFiscal'] = $traerSucursal['id_regimen'];
//$datos['emisor']['FacAtrAdquirente'] = 'ACCEM SERVICIOS EMPRESARIALES SC';






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



foreach ($listaProductos as $key => $value) {

	$id_producto = $value['id'];

	$respuesta = ModeloProductos::mdlMostrarProducto($id_producto);




	$datos['conceptos'][$key]['cantidad'] = $value['cantidad'];
	$datos['conceptos'][$key]['unidad'] = $respuesta['unidad']; 
	$datos['conceptos'][$key]['ID'] = $respuesta['clave_producto']; 
	$datos['conceptos'][$key]['descripcion'] = $respuesta['descripcion_corta'];


//VALOR UNITARIO
	$valor_unitario = round($value['precio'] / 1.16, 2);

//PRECIO NETO / 1.16 REDONDEADO CON DOS DECIMALES--- VALOR UNITARIO
	$datos['conceptos'][$key]['valorunitario'] = $valor_unitario;


//IMPORTE
	$importe = $value['cantidad'] * $valor_unitario;


//CANTIDAD POR EL VALOR UNITARIO
	$datos['conceptos'][$key]['importe'] = $importe;


//CLAVE SAT
	$datos['conceptos'][$key]['ClaveProdServ'] = $respuesta['id_clave_sat'];


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

//$respuestaTimbrado = $res['codigo_mf_texto'];



return array($res['codigo_mf_texto'],
	$res['uuid'],
	$res['representacion_impresa_certificado_no'],
	$res['representacion_impresa_sello'],
	$res['representacion_impresa_selloSAT'],
	$res['representacion_impresa_cadena'],
	$res['representacion_impresa_certificadoSAT'],
	$res['representacion_impresa_fecha_timbrado'],
	$ruta);

}

$stmt -> close();

$stmt = null;

}
	
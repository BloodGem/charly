<?php

require_once "conexion.php";

class ModeloFacturasGlobales{


	/*=============================================
	MOSTRARFACTURA GLOBAL
	=============================================*/

	static public function mdlMostrarFacturaGlobal($id_factura_global){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM facturas_globales WHERE id_factura_global = :id_factura_global");

			$stmt -> bindParam(":id_factura_global", $id_factura_global, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	CREAR FACTURA GLOBAL
	=============================================*/

	static public function mdlCrearFacturaGlobal($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO facturas_globales (folio, bruto, impuesto, total, fecha_inicial, fecha_final, id_periodo, id_rango_mes, year, id_forma_pago, id_cfdi, id_metodo_pago, id_sucursal, id_usuario_creador) VALUES (:folio, :bruto, :impuesto, :total, :fecha_inicial, :fecha_final, :id_periodo, :id_rango_mes, :year, :id_forma_pago, :id_cfdi, :id_metodo_pago, :id_sucursal, :id_usuario_creador)");

			$stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
			$stmt->bindParam(":bruto", $datos["bruto"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha_inicial", $datos["fecha_inicial"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_periodo", $datos["id_periodo"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_rango_mes", $datos["id_rango_mes"], PDO::PARAM_STR);
			$stmt -> bindParam(":year", $datos["year"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_forma_pago", $datos["id_forma_pago"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_cfdi", $datos["id_cfdi"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_metodo_pago", $datos["id_metodo_pago"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

			$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM facturas_globales LIMIT 1;");

			if($stmt->execute() && $stmt2->execute()){

				return $stmt2 -> fetch();

			}else{

				return "error";

			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}









	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarPartidasFacturaGlobal($id_venta){


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

	static public function mdlTimbrarFacturaGlobal($id_factura_global){

        if($id_factura_global != null){

            

                // Se especifica la zona horaria
            date_default_timezone_set('America/Mexico_City');

            //traemos la factura global
            $traerFacturaGlobal = ModeloFacturasGlobales::mdlMostrarFacturaGlobal($id_factura_global);

            $id_sucursal = $traerFacturaGlobal['id_sucursal'];

            $fecha_inicial = $traerFacturaGlobal["fecha_inicial"];
            $fecha_final = $traerFacturaGlobal["fecha_final"];

            //traemos al cliente
            $traerCliente = ModeloClientes::mdlMostrarCliente(1);

            $id_cliente = $traerCliente['id_cliente'];

            //traemos el usuario

            $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
            

            //traemos la sucursal

            $traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);


// Se especifica la version de CFDi 4.0
$datos['version_cfdi'] = '4.0';
$datos['validacion_local']='NO';
// Ruta del XML Timbrado
$datos['cfdi']='SDK2/timbrados/globales/FG-'.$id_factura_global.'.xml';

$ruta = "FG-".$id_factura_global;

// Credenciales de Timbrado
/*$datos['PAC']['usuario'] = 'DEMO700101XXX';
$datos['PAC']['pass'] = 'DEMO700101XXX';
$datos['PAC']['produccion'] = 'NO';*/
$datos['PAC']['usuario'] = 'BAU250609Q85';
$datos['PAC']['pass'] = 'GU3RR3R0';
$datos['PAC']['produccion'] = 'SI';
// Rutas y clave de los CSD
$datos['conf']['cer'] = $traerSucursal['ccer'];
$datos['conf']['key'] = $traerSucursal['ckey'];
$datos['conf']['pass'] = $traerSucursal['clave'];

//$traerVentasFG = ModeloVentas::mdlMostrarVentasFechasFG($fecha_inicial, $fecha_final);

        /*$total = 0;
        foreach ($traerVentasFG as $key => $value) {
            $total = $total + $value['total'];
        }*/

//PARA EL ENCABEZADO

            /*$total_encabezado = 0;

            $total_importe_encabezado = 0;

            $total_iva_encabezado = 0;

            foreach ($traerVentasFG as $key2 => $value2) {

    //VALOR UNITARIO
                $valor_unitario_encabezado = round($value2['total'] / 1.16, 2);

//IMPORTE
                $importe_encabezado = 1 * $valor_unitario_encabezado;

//CALCULAR SOLO IVA
                $solo_iva_encabezado = round($importe_encabezado * 0.16, 2); 

                $total_importe_encabezado = $total_importe_encabezado + $importe_encabezado;
                $total_iva_encabezado = $total_iva_encabezado + $solo_iva_encabezado;

            }

            $total_encabezado = $total_importe_encabezado + $total_iva_encabezado;*/


            $total_encabezado = $traerFacturaGlobal['total'];

            $total_importe_encabezado = $traerFacturaGlobal['bruto'];


// Datos de la Factura
$datos['factura']['condicionesDePago'] = 'CONDICIONEES';
$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 3610);
$datos['factura']['folio'] = $traerFacturaGlobal['folio'];
$datos['factura']['forma_pago'] = $traerFacturaGlobal['id_forma_pago'];
$datos['factura']['LugarExpedicion'] = $traerSucursal['codigo_postal'];
$datos['factura']['metodo_pago'] = $traerFacturaGlobal['id_metodo_pago'];
$datos['factura']['moneda'] = 'MXN';
$datos['factura']['serie'] = 'A';
$datos['factura']['subtotal'] = $total_importe_encabezado;
$datos['factura']['tipocambio'] = 1;
$datos['factura']['tipocomprobante'] = 'I';
$datos['factura']['total'] = $total_encabezado;
$datos['factura']['Exportacion'] = '01';
// Datos del Emisor
$datos['emisor']['rfc'] = $traerSucursal['rfc']; //RFC DE PRUEBA
$datos['emisor']['nombre'] = $traerSucursal['nombre'];  // EMPRESA DE PRUEBA
$datos['emisor']['RegimenFiscal'] = $traerSucursal['id_regimen'];
// Datos del receptor
$datos['receptor']['rfc'] = $traerCliente['rfc'];
$datos['receptor']['nombre'] = $traerCliente['nombre'];
$datos['receptor']['UsoCFDI'] = $traerFacturaGlobal['id_cfdi'];
$datos['receptor']['DomicilioFiscalReceptor'] = $traerCliente['codigo_postal'];
$datos['receptor']['RegimenFiscalReceptor '] = $traerCliente['id_regimen'];
//Informacion Global
$datos['InformacionGlobal']['Periodicidad'] = $traerFacturaGlobal['id_periodo'];
$datos['InformacionGlobal']['Meses'] = $traerFacturaGlobal['id_rango_mes'];
$datos['InformacionGlobal']['Año'] = $traerFacturaGlobal['year'];
// Se agregan los conceptos


/*yy$total_importe = 0;
$total_iva = 0;
foreach ($traerVentasFG as $key => $value) {*/

    $datos['conceptos'][$key]['cantidad'] = '1';
    $datos['conceptos'][$key]['unidad'] = 'VTA'; 
    $datos['conceptos'][$key]['ID'] = 'VTAVTA'; 
    $datos['conceptos'][$key]['descripcion'] = 'VENTA';


//VALOR UNITARIO
    $valor_unitario = $traerFacturaGlobal['bruto'];

//PRECIO NETO / 1.16 REDONDEADO CON DOS DECIMALES--- VALOR UNITARIO
    $datos['conceptos'][$key]['valorunitario'] = $valor_unitario;


//IMPORTE
    $importe = 1 * $valor_unitario;


//CANTIDAD POR EL VALOR UNITARIO
    $datos['conceptos'][$key]['importe'] = $importe;


//CLAVE SAT
    $datos['conceptos'][$key]['ClaveProdServ'] = '01010101';


//CLAVE DEL SAT
    $datos['conceptos'][$key]['ClaveUnidad'] = 'H87';


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

//}

$datos['impuestos']['TotalImpuestosTrasladados'] = $total_iva;

// Se agregan los Impuestos
$datos['impuestos']['translados'][0]['Base'] = $total_importe;
$datos['impuestos']['translados'][0]['impuesto'] = '002';
$datos['impuestos']['translados'][0]['tasa'] = '0.160000';
$datos['impuestos']['translados'][0]['importe'] = $total_iva;
$datos['impuestos']['translados'][0]['TipoFactor'] = 'Tasa';




$res = mf_genera_cfdi4($datos);



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



}






	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarFacturaGlobal($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventas (folio, id_cliente, id_vendedor, productos, total, tipo_venta, id_sucursal, fecha) VALUES (:folio, :id_cliente, :id_vendedor, :productos, :total, :tipo_venta, :id_sucursal, NOW())");

		$stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_venta", $datos["tipo_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM ventas LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
	
	
	
	
	
	
	
	

	/*=============================================
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlFacturaGlobalTimbrada($datosTimbrada){

		$stmt = Conexion::conectar()->prepare("UPDATE facturas_globales SET facturado = 1,
					uuid = :uuid,
					certnumber = :certnumber,
					sello = :sello,
					sello_sat = :sello_sat,
					cadena_timbre = :cadena_timbre,
					no_certificado_sat = :no_certificado_sat,
					fecha_timbrado = :fecha_timbrado,
					ruta = :ruta,
					id_usuario_ult_mod = :id_usuario_ult_mod
					WHERE id_factura_global = :id_factura_global");

		$stmt->bindParam(":id_factura_global", $datosTimbrada["id_factura_global"], PDO::PARAM_INT);
		
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
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlActualizarFacturaGlobal($columna, $valor, $id_venta, $id_sucursal){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET $columna = :valor WHERE id = :id_venta AND id_sucursal = :id_sucursal");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	










	static public function mdlMostrarVentasFacturaGlobal($id_factura_global){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id_factura_global = :id_factura_global");

			$stmt -> bindParam(":id_factura_global", $id_factura_global, PDO::PARAM_INT);

			if($stmt -> execute()){

			return $stmt -> fetchAll();
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	
}
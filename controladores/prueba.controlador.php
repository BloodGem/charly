<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorVentas{


	static public function ctrObtenerDia($day){

		switch ($day) {
			case "Sunday":
			$dia_texto = "Domingo";
			break;
			case "Monday":
			$dia_texto = "Lunes";
			break;
			case "Tuesday":
			$dia_texto = "Martes";
			break;
			case "Wednesday":
			$dia_texto = "Miércoles";
			break;
			case "Thursday":
			$dia_texto = "Jueves";
			break;
			case "Friday":
			$dia_texto = "Viernes";
			break;
			case "Saturday":
			$dia_texto = "Sábado";
			break;
		}

		return $dia_texto;

	}


	static public function ctrObtenerRangoFechas($no_rango){

		switch ($no_rango) {

			case 1:

			$dia = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia . ' 00:00:00';
			$fecha2 = $dia . ' 23:59:59' ;


			break;

			case 2:

			$dia = date("Y-m-d", strtotime("yesterday"));
			$fecha1 = $dia . ' 00:00:00';
			$fecha2 = $dia . ' 23:59:59' ;


			break;
			case 3:

			if(date("D")=="Mon"){
				$lunes = date("Y-m-d");
			}else{
				$lunes = date("Y-m-d", strtotime('last Monday', time()));
			}


			$dia1 = $lunes;
			$dia2 = date('Y-m-d', strtotime('this Sunday', time()));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;



			break;

			case 4:

			if(date("D")=="Mon"){
				$lunes = date("Y-m-d", strtotime('last Monday', time()));
			}else{
				$lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
			}


			$dia1 = $lunes;
			$dia2 = date('Y-m-d', strtotime('last Sunday', time()));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 5:
			$dia1 = date("Y-m-d", strtotime("today - 6 days"));
			$dia2 = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 6:
			$dia1 = date("Y-m-d", strtotime("today - 29 days"));
			$dia2 = date("Y-m-d", strtotime("today"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

			case 7:

			$dia1 = date("Y-m-d", strtotime("first day of this month"));
			$dia2 = date("Y-m-d", strtotime("last day of this month"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;



			break;

			case 8:

			$dia1 = date("Y-m-d", strtotime("first day of last month"));
			$dia2 = date("Y-m-d", strtotime("last day of last month"));
			$fecha1 = $dia1 . ' 00:00:00';
			$fecha2 = $dia2 . ' 23:59:59' ;


			break;

		}

		return array($fecha1, $fecha2);

	}


	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($columna, $valor){

		

		$respuesta = ModeloVentas::mdlMostrarVentas($columna, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVenta($id_venta){

		

		$respuesta = ModeloVentas::mdlMostrarVenta($id_venta);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR VENTAS EN ESPERA
	=============================================*/

	static public function ctrMostrarVentasEspera(){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$respuesta = ModeloVentas::mdlMostrarVentasEspera($id_sucursal);

		return $respuesta;

	}










	static public function ctrMostrarSumaVentasProductoRangoFechas($no_rango, $id_producto, $id_sucursal){

		list($fecha1, $fecha2) = ControladorVentas::ctrObtenerRangoFechas($no_rango);

		$respuesta = ModeloVentas::mdlMostrarSumaVentasProductoRangoFechas($fecha1, $fecha2, $id_producto, $id_sucursal);

		return $respuesta;
	}










	static public function ctrReimprimirTicketVenta(){

		if(isset($_POST['reimprimir_ticket_venta'])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_venta = $_POST['reimprimir_ticket_venta'];

			$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

			$total = $traerVenta['total'];

			$id_sucursal = $traerVenta['id_sucursal'];

			$dateFecha = date_create($traerVenta['fecha_pago']);
			$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
			$day=date_format($dateFecha, 'l');
			$dia_texto = ControladorVentas::ctrObtenerDia($day);

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			$nombre_usuario = $traerUsuario['nombre'];

			$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

			$nombre_sucursal = $traerSucursal['nombre'];

			$traerPartidasVenta	= ModeloPartvta::mdlMostrarPartidasVenta($id_venta);

			$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVenta['id_vendedor']);


			if($traerVenta['tipo_venta'] == "NT"){
				$impresora = $traerComputadora['imp_almacen'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

				//$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> text($traerSucursal['nombre']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['colonia']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['rfc']);

				$printer -> feed(1);

				$printer -> text("Nota de Venta");

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text($dia_texto.", ".$fecha_hora);

				$printer -> feed(2);

				$printer -> text("Atendido por: ".$traerVendedor['nombres']);

				$printer -> feed(1);

				$printer -> text("Cliente: ".$traerVenta['nombre']);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);
				
				$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> text("=============================================");

				$printer -> feed(1);

				foreach ($traerPartidasVenta as $key => $value) {

					$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto'], $id_sucursal);

					$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

					$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

					$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);


					$total_producto = $value["cantidad"] * $value["precio_neto"];

					$printer -> setTextSize(2, 2);

					$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']."  ".$traerProducto['ubicacion']);

					$printer -> feed(1);

					$printer -> setTextSize(1, 1);

					$printer -> text($producto."  $".number_format($value["precio_neto"],2)."   $".number_format($total_producto,2));

					$printer -> feed(2);
				}

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Total: $".number_format($traerVenta["total"],2));

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("=============================================");

				$printer -> feed(2);

				$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

				$printer -> feed(1);

				$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

				$printer -> feed(2);

				$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

				$printer -> feed(1);

				$printer -> text("NI DEVOLUCIÓN.");

				$printer -> feed(2);

				$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

				$printer -> feed(1);

				$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

				$printer -> feed(2);

				$printer -> text("DEVOLUCIONES EN EFECTIVO");

				$printer -> feed(1);

				$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

				$printer -> feed(2);

				$printer -> text("*GRACIAS POR SU PREFERENCIA*");

				$printer -> feed(1);

				$printer -> cut();

				$printer -> pulse();

				$printer -> close();

			}elseif($traerVenta['tipo_venta'] == "FC"){

				$traerCliente = ControladorClientes::ctrMostrarCliente($traerVenta['id_cliente']);
				$traerUsoCFDI = ModeloOtros::mdlMostrarCFDI($traerVenta['id_cfdi']);
				$traerMetodoPago = ModeloOtros::mdlMostrarMetodoPago($traerVenta['id_forma_pago']);
				$traerFormaPago = ModeloOtros::mdlMostrarFormaPago($traerVenta['id_metodo_pago']);

				$total_encabezado = 0;
				foreach ($traerPartidasVenta as $key2 => $value2) {

				//VALOR UNITARIO
					$valor_unitario_encabezado = round($value2['precio_neto'] / 1.16, 2);

				//IMPORTE
					$importe_encabezado = $value2['cantidad'] * $valor_unitario_encabezado;

					$total_importe_encabezado = $total_importe_encabezado + $importe_encabezado;

				}

				$total_encabezado = $total_importe_encabezado + $total_iva_encabezado;


				$total_encabezado_formateado = number_format($total_encabezado, 6);
				$total_encabezado_formateado = str_pad($total_encabezado_formateado,25,"0",STR_PAD_LEFT);
				$sello_qr = substr($traerVenta['sello'], -8);

				$rutaQR = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?id=".$traerVenta['uuid']."&re=".$traerSucursal['rfc']."&rr=".$traerCliente['rfc']."&tt=".$total_encabezado_formateado."&fe=".$sello_qr;

				echo '<script>window.open("extensiones/tcpdf/examples/factura.php?id_venta='.$id_venta.'", "_blank");</script>';



				$impresora = $traerComputadora['imp_almacen'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

				//$printer -> bitImage($logo);

				$printer -> feed(1);


				$printer -> text($traerSucursal['nombre']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['colonia']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['rfc']);

				$printer -> feed(1);

				$printer -> text("Factura");

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text($dia_texto.", ".$fecha_hora);

				$printer -> feed(2);

				$printer -> text("Atendido por: ".$traerVendedor['nombres']);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("---------------------------------------------");

				$printer -> feed(1);

				$printer -> text("Fecha y hora de emisión: ".$traerVenta['fecha_pago']);

				$printer -> feed(1);

				$printer -> text("No. serie del CSD: ".$traerVenta['certnumber']);

				$printer -> feed(1);

				$printer -> text("Folio Físcal:");

				$printer -> feed(1);

				$printer -> text($traerVenta['uuid']);

				$printer -> feed(2);

				$printer -> text("Cliente: ".$traerCliente['nombre']);

				$printer -> feed(1);

				$printer -> text("RFC: ".$traerCliente['rfc']);

				$printer -> feed(1);

				$printer -> text("Uso del CFDI: ".$traerVenta['id_cfdi']." ".$traerUsoCFDI['descripcion']);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> qrCode($rutaQR);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("---------------------------------------------");

				$printer -> feed(1);

				$printer -> text("Cant/Ubica/Clave/Descripción   C.P   Importe");

				$printer -> feed(1);

				$printer -> text("---------------------------------------------");

				$printer -> feed(1);

				foreach ($traerPartidasVenta as $key => $value) {

					$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto'], $id_sucursal);

					$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

					$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

					$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

					$importe = $value['cantidad'] * $value['precio_unitario'];

					$impuesto_traslado = $value['cantidad'] * ($value['precio_neto'] - $value['precio_unitario']);

					$base_traslado = $value['cantidad'] * $value['precio_unitario'];

					$printer -> setTextSize(2, 2);

					$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']."  ".$traerProducto['ubicacion']);

					$printer -> feed(1);

					$printer -> setTextSize(1, 1);

					$printer -> text($producto."   $".number_format($value["precio_unitario"],2)."   $".number_format($importe, 2));

					$printer -> feed(1);

					$printer -> text("Clave Prod/Serv: ".$traerProducto['clave_sat']);

					$printer -> feed(1);

					$printer -> text("Traslados:");

					$printer -> feed(1);

					$printer -> text("Base: ".number_format($base_traslado,2)."  Impuesto: 002  Factor: Tasa");

					$printer -> feed(1);

					$printer -> text("Tasa/Cuota: 0.160000  Importe:".number_format($impuesto_traslado,2));

					$printer -> feed(2);
				}

				$subtotal = round(($traerVenta['total'] / 1.16), 2);

				$iva = round($subtotal * 0.16, 2);

				$printer -> feed(1);

				$printer -> text("---------------------------------------------");

				$printer -> feed(1);

				$printer -> text("Subtotal: $".number_format($subtotal, 2));

				$printer -> feed(1);

				$printer -> text("I.V.A (16%): $".number_format($iva, 2));

				$printer -> feed(1);

				$printer -> text("Total: $".number_format($traerVenta["total"],2));

				$printer -> feed(2);

				$printer -> text("Importe con letra: $");

				$printer -> feed(2);

				$printer -> text("Metodo Pago: ".$traerVenta['id_forma_pago']." ".$traerMetodoPago['descripcion']);

				$printer -> feed(1);

				$printer -> text("Forma Pago: ".$traerVenta['id_metodo_pago']." ".$traerFormaPago['descripcion']);

				$printer -> feed(2);

				$printer -> text("Confirmación SAT:");

				$printer -> feed(1);

				$printer -> text("Mensaje SAT:");

				$printer -> feed(2);

				$printer -> text("Sello Digital del CFDI : ".$traerVenta['sello']);

				$printer -> feed(2);

				$printer -> text("Sello del SAT : ".$traerVenta['sello_sat']);

				$printer -> feed(2);

				$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$traerVenta['cadena_timbre']);

				$printer -> feed(2);

				$printer -> text("Fecha y Hora de Certificación : ".$traerVenta['fecha_timbrado']);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Este Documento es una representación");

				$printer -> feed(1);

				$printer -> text("impresa de un CFDI");

				$printer -> feed(2);

				$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

				$printer -> feed(1);

				$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

				$printer -> feed(2);

				$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

				$printer -> feed(1);

				$printer -> text("NI DEVOLUCIÓN.");

				$printer -> feed(2);

				$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

				$printer -> feed(1);

				$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

				$printer -> feed(2);

				$printer -> text("DEVOLUCIONES EN EFECTIVO");

				$printer -> feed(1);

				$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

				$printer -> feed(2);

				$printer -> text("*GRACIAS POR SU PREFERENCIA*");


				$printer -> feed(1);

				$printer -> cut();

				$printer -> pulse();

				$printer -> close();




			}



			/*$columnaReimprimida = "reimprimida";
			$valorReimpresion = 1;


			$respuestaVentaReimprimida = ModeloVentas::mdlActualizarVenta($columnaReimprimida, $valorReimpresion, $id_venta, $id_sucursal);*/

			echo "<script>
			Swal.fire({
				icon: 'success',
				title: 'Imprimiendo...',
				showConfirmButton: false,
				timer: 2500
				}).then(function(result){
					window.location = 'lista-ventas';
					});
					</script>";


				}

			}



















	//REIMPRESION DE TICKET DE VENTA COMO CUANDO SALE DE VENTAS
			static public function ctrReimprimirTicketVentaMostrador(){

				if(isset($_POST['reimprimir_ticket_venta_mostrador'])){

					$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

					$id_venta = $_POST['reimprimir_ticket_venta_mostrador'];

					$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);


					$dateFecha = date_create($traerVenta['fecha_creacion']);
					$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
					$day=date_format($dateFecha, 'l');
					$dia_texto = ControladorVentas::ctrObtenerDia($day);



					$id_sucursal = $traerVenta['id_sucursal'];

					$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

					$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

					$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVenta['id_vendedor']);


					if ($traerVenta['tipo_venta'] == "FC") {

						$impresora = $traerComputadora['imp_ventas'];

						$conector = new WindowsPrintConnector($impresora);

						$printer = new Printer($conector);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

						//$printer -> bitImage($logo);

						$printer -> feed(1);

						$printer -> setTextSize(2, 2);

						$printer -> text("PASE A LA CAJA");

						$printer -> feed(2);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text($dia_texto.", ".$fecha_hora);

						$printer -> feed(2);

						$printer -> text("Atendido por: ".$traerVendedor['nombres']);

						$printer -> feed(2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(3);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer -> text("*****TTTTTTT FFFFFF*****");

						$printer -> feed(1);

						$printer -> text("**   TTT  FFFF    **");

						$printer -> feed(1);

						$printer -> text("***** TTT  FF  *****");

						$printer -> feed(2);

						$printer -> setTextSize(2, 2);

						$printer -> text("IMPORTE: $".number_format($traerVenta['total'], 2));

						$printer -> feed(3);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(1);

						$printer -> cut();

						$printer -> pulse();

						$printer -> close();


						echo "<script>
						Swal.fire({
							icon: 'success',
							title: 'Imprimiendo...',
							showConfirmButton: false,
							timer: 2500
							}).then(function(result){
								window.location = 'lista-ventas';
								});
								</script>";
							}else{
								
								$impresora = $traerComputadora['imp_ventas'];

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

								//$printer -> bitImage($logo);

								$printer -> feed(1);

								$printer -> setTextSize(2, 2);

								$printer -> text("PASE A LA CAJA");

								$printer -> feed(2);

								$printer -> setTextSize(1, 1);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text($dia_texto.", ".$fecha_hora);

								$printer -> feed(2);

								$printer -> text("Atendido por: ".$traerVendedor['nombres']);

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

								$printer -> feed(1);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("=============================================");

								$printer -> feed(3);

								$printer -> setTextSize(2, 2);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text("IMPORTE: $".number_format($traerVenta['total'], 2));

								$printer -> feed(3);

								$printer -> setTextSize(1, 1);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("=============================================");

								$printer -> feed(1);

								$printer -> cut();

								$printer -> pulse();

								$printer -> close();

								echo "<script>
								Swal.fire({
									icon: 'success',
									title: 'Imprimiendo...',
									showConfirmButton: false,
									timer: 2500
									}).then(function(result){
										window.location = 'lista-ventas';
										});
										</script>";

									}




								}

							}




















							static public function ctrReimprimirTicketVentaCaja(){

								if(isset($_POST['reimprimir_ticket_venta_caja'])){

									$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

									$id_venta = $_POST['reimprimir_ticket_venta_caja'];

									$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

									$dateFecha = date_create($traerVenta['fecha_pago']);
									$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
									$day=date_format($dateFecha, 'l');
									$dia_texto = ControladorVentas::ctrObtenerDia($day);

									$id_sucursal = $traerVenta['id_sucursal'];

									$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

									$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

									$nombre_sucursal = $traerSucursal['nombre'];

									$traerPartidasVenta	= ModeloPartvta::mdlMostrarPartidasVenta($id_venta);

									$traerCorteCaja = ControladorCajas::ctrMostrarCorteCaja($traerVenta['id_corte_caja']);

									$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerCorteCaja['id_usuario_creador']);

									$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVenta['id_vendedor']);


									if($traerVenta['tipo_venta'] == "NT"){
										$impresora = $traerComputadora['imp_caja'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

										//$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($traerSucursal['nombre']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> text("*************************");

										$printer -> feed(1);

										$printer -> text("*N O T A  D E  V E N T A*");

										$printer -> feed(1);

										$printer -> text("*************************");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text($dia_texto.", ".$fecha_hora);

										$printer -> feed(2);

										$printer -> text("Atendido por: ".$traerVendedor['nombres']);

										$printer -> feed(1);

										$printer -> text("Cliente: ".$traerVenta['nombre']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> setTextSize(1, 1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										foreach ($traerPartidasVenta as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto'], $id_sucursal);

											$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

											$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

											$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

											$total_producto = $value["cantidad"] * $value["precio_neto"];

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']."  ".$traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($producto."   $".number_format($value["precio_neto"],2)."   $".number_format($total_producto,2));

											$printer -> feed(2);

										}

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("Total: $".number_format($traerVenta["total"],2));

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("ESTE TICKET NO ES VALIDO PARA RECOGER SU");

										$printer -> feed(1);

										$printer -> text("MERCANCIA SI NO LLEVA EL SELLO DEL CAJERO");

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> pulse();

										$printer -> close();

									}elseif($traerVenta['tipo_venta'] == "FC"){

										$impresora = $traerComputadora['imp_caja'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

										//$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($traerSucursal['nombre']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("***************");

										$printer -> feed(1);

										$printer -> text("*F A C T U R A*");

										$printer -> feed(1);

										$printer -> text("***************");

										$printer -> feed(2);

										$printer -> text($dia_texto.", ".$fecha_hora);

										$printer -> feed(2);

										$printer -> text("Atendido por: ".$traerVendedor['nombres']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(1);

										foreach ($traerPartidasVenta as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto'], $id_sucursal);

											$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

											$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

											$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);


											$total_producto = $value["cantidad"] * $value["precio_neto"];

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']."  ".$traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($producto."   $".number_format($value["precio_neto"],2)."   $".number_format($total_producto,2));

											$printer -> feed(2);

										}

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("Total: $".number_format($traerVenta["total"],2));

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("ESTE TICKET NO ES VALIDO PARA RECOGER SU");

										$printer -> feed(1);

										$printer -> text("MERCANCIA SI NO LLEVA EL SELLO DEL CAJERO");

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> pulse();

										$printer -> close();




									}



			/*$columnaReimprimida = "reimprimida";
			$valorReimpresion = 1;


			$respuestaVentaReimprimida = ModeloVentas::mdlActualizarVenta($columnaReimprimida, $valorReimpresion, $id_venta, $id_sucursal);*/

			echo "<script>
			Swal.fire({
				icon: 'success',
				title: 'Imprimiendo...',
				showConfirmButton: false,
				timer: 2500
				}).then(function(result){
					window.location = 'lista-ventas';
					});
					</script>";


				}

			}

























	/*=============================================
	MOSTRAR VENTAS EN ESPERA
	=============================================*/

	static public function ctrCancelarVenta($id_venta){

		$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$id_sucursal = $traerUsuario['id_sucursal'];
		
		$columnaCancelada = "cancelada";
		
		$valorCancelarVenta = 1;

		$respuestaCancelarVenta = ModeloVentas::mdlActualizarVenta($columnaCancelada, $valorCancelarVenta, $id_venta, $id_sucursal, $_SESSION['id']);
		
		if($respuestaCancelarVenta == "ok"){

			$traerPartidasVenta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);

			foreach ($traerPartidasVenta as $key => $value) {

				$id_producto = $value['id_producto'];

				$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

				$cantidad = $value['cantidad'];

				$stockActual = $traerProductoES['stock'];

				$nuevoStock = $stockActual + $cantidad;

				$columnaStock = "stock";

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);

				$datosPartidaKardexProductos = array("mo_tipo"=>"CANCELACION DE VENTA",
					"mo_refer"=>$id_venta,
					"mo_entsal"=>"ENTRADA",
					"id_producto"=>$id_producto,
					"mo_cant"=>$value["cantidad"],
					"mo_pu"=>$value["precio_neto"],
					"mo_existencias"=>$nuevoStock,
					"id_sucursal"=>$id_sucursal);

				ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);

			}

		}

		return $respuestaCancelarVenta;

	}
	
	
	
	
	
	
	
	
	
	
	/*=============================================
	MOSTRAR VENTAS EN ESPERA
	=============================================*/

	static public function ctrCancelarVenta2(){

		if(isset($_POST['id_venta'])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_venta = $_POST['id_venta'];

			$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

			if($traerVenta['pagada'] == 1){

				echo "<script>Swal.fire({
					icon: 'error',
					title: 'La venta no.".$id_venta." ya ha sido pagada',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-ventas-espera';
						});
						</script>";

						return;

					}





					if($traerVenta['cancelada'] == 1){

						echo "<script>Swal.fire({
							icon: 'error',
							title: 'La venta no.".$id_venta." ya ha sido cancelada',
							showConfirmButton: true
							}).then(function(result){
								window.location = 'lista-ventas-espera';
								});
								</script>";

								return;

							}




							$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

							$id_sucursal = $traerVenta['id_sucursal'];

							$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

							$columnaCancelada = "cancelada";

							$valorCancelarVenta = 1;

							$respuestaCancelarVenta = ModeloVentas::mdlActualizarVenta($columnaCancelada, $valorCancelarVenta, $id_venta, $id_sucursal, $_SESSION['id']);

							if($respuestaCancelarVenta == "ok"){



								$traerPartidasVenta = ModeloPartvta::mdlMostrarPartidasVenta($id_venta);



								foreach ($traerPartidasVenta as $key => $value) {

									$id_producto = $value['id_producto'];

									$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

									$cantidad = $value['cantidad'];

									$stockActual = $traerProductoES['stock'];

									$nuevoStock = $traerProductoES['stock'] + $value['cantidad'];


									$columnaStock = "stock";

									ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);


									$datosPartidaKardexProductos = array("mo_tipo"=>"CANCELACION DE VENTA",
										"mo_refer"=>$id_venta,
										"mo_entsal"=>"ENTRADA",
										"id_producto"=>$id_producto,
										"mo_cant"=>$value["cantidad"],
										"mo_pu"=>$value["precio_neto"],
										"mo_existencias"=>$nuevoStock,
										"id_sucursal"=>$id_sucursal);

									ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);




								}
								$day = date("l");
								switch ($day) {
									case "Sunday":
									$dia_texto = "Domingo";
									break;
									case "Monday":
									$dia_texto = "Lunes";
									break;
									case "Tuesday":
									$dia_texto = "Martes";
									break;
									case "Wednesday":
									$dia_texto = "Miércoles";
									break;
									case "Thursday":
									$dia_texto = "Jueves";
									break;
									case "Friday":
									$dia_texto = "Viernes";
									break;
									case "Saturday":
									$dia_texto = "Sábado";
									break;
								}

								$fecha_hora_ticket = date('d-m-Y H:i:s a');

								$traerVenta = ModeloVentas::mdlMostrarVenta($id_venta);

								$subtotal = round(($traerVenta['total'] / 1.16), 2);

								$iva = round($subtotal * 0.16, 2);


								$impresora = $traerComputadora['imp_ventas'];

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text($traerSucursal['nombre']);

								$printer -> feed(2);

								$printer -> text("*DEVOLUCIÓN*");

								$printer -> feed(1);

								$printer -> text("I N T E R N A");

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text($dia_texto.", ".$fecha_hora_ticket);

								$printer -> feed(2);

								$printer -> text("Motivo de la devolución: NA");

								$printer -> feed(1);

								$printer -> text("===============================================");

								$printer -> feed(1);

								foreach ($traerPartidasVenta as $key => $value) {

									$total = $value['cantidad'] * $value['precio_neto'];

									$id_producto = $value['id_producto'];

									$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

									$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

									$producto= str_replace($order, $replace, $traerProductoES['descripcion_corta']);

									$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

									$printer -> text($value['cantidad']."   ");

									$printer -> text($producto);

									$printer -> feed(1);

									$printer -> text($traerProductoES['ubicacion']."      $".$value['precio_neto']."   $".$total);

									$printer -> feed(1);

								}

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_RIGHT);

								$printer -> text("Subtotal :    $".$subtotal);

								$printer -> feed(1);

								$printer -> text("I. V. A. :    $".$iva);

								$printer -> feed(1);

								$printer -> text("TOTAL :     $".$traerVenta['total']);

								$printer -> feed(2);

								$printer -> text("===============================================");

								$printer -> feed(1);

								$printer -> cut();

								$printer -> pulse();

								$printer -> close();


								echo "<script>Swal.fire({
									icon: 'success',
									title: 'La venta no.".$id_venta." ha sido cancelada con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
										window.location = 'lista-ventas-espera';
										});
										</script>";


									}

		//return $respuestaCancelarVenta;

								}

							}




							static public function ctrImprimirTicketCancelacion($cuerpo_ticket){

								$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

								$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

								$id_sucursal = $traerUsuario['id_sucursal'];

								$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

								$day = date("l");
								switch ($day) {
									case "Sunday":
									$dia_texto = "Domingo";
									break;
									case "Monday":
									$dia_texto = "Lunes";
									break;
									case "Tuesday":
									$dia_texto = "Martes";
									break;
									case "Wednesday":
									$dia_texto = "Miércoles";
									break;
									case "Thursday":
									$dia_texto = "Jueves";
									break;
									case "Friday":
									$dia_texto = "Viernes";
									break;
									case "Saturday":
									$dia_texto = "Sábado";
									break;
								}

								$fecha_hora_ticket = date('d-m-Y H:i:s a');

								$impresora = $traerComputadora['imp_ventas'];

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text($traerSucursal['nombre']);

								$printer -> feed(2);

								$printer -> text("*DEVOLUCIÓN*");

								$printer -> feed(1);

								$printer -> text("I N T E R N A");

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text($dia_texto.", ".$fecha_hora_ticket);

								$printer -> feed(2);

								$printer -> text("Motivo de la devolución: NA");

								$printer -> feed(1);

								$printer -> text("===============================================");

								$printer -> feed(1);

								$cuerpo_ticket;

								$printer -> feed(1);

								$printer -> cut();

								$printer -> pulse();

								$printer -> close();
							}



	/*=============================================
	MOSTRAR VENTAS EN ESPERA
	=============================================*/

	static public function ctrCancelarVentas(){

		if(isset($_POST['borrarVentas'])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			$id_sucursal = $traerUsuario['id_sucursal'];

			$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

			$traerVentasEspera = ModeloVentas::mdlMostrarVentasEspera($id_sucursal);

				var_dump($traerVentasEspera);

				echo $traerVentasEspera;

				$day = date("l");
				switch ($day) {
					case "Sunday":
					$dia_texto = "Domingo";
					break;
					case "Monday":
					$dia_texto = "Lunes";
					break;
					case "Tuesday":
					$dia_texto = "Martes";
					break;
					case "Wednesday":
					$dia_texto = "Miércoles";
					break;
					case "Thursday":
					$dia_texto = "Jueves";
					break;
					case "Friday":
					$dia_texto = "Viernes";
					break;
					case "Saturday":
					$dia_texto = "Sábado";
					break;
				}

				$fecha_hora_ticket = date('d-m-Y H:i:s a');

				$impresora = $traerComputadora['imp_ventas'];

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text($traerSucursal['nombre']);

								$printer -> feed(2);

								$printer -> text("*DEVOLUCIÓN*");

								$printer -> feed(1);

								$printer -> text("I N T E R N A");

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text($dia_texto.", ".$fecha_hora_ticket);

								$printer -> feed(2);

								$printer -> text("Motivo de la devolución: NA");

								$printer -> feed(1);

								$printer -> text("===============================================");

								$printer -> feed(1);

			foreach ($traerVentasEspera as $keyVentasEspera => $valueVentasEspera) {

				$id_venta = $valueVentasEspera['id'];

				$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

				if($traerVenta['pagada'] == 0 && $traerVenta['cancelada'] == 0){

					$columnaCancelada = "cancelada";

					$valorCancelarVenta = 1;

					$respuestaCancelarVenta = ModeloVentas::mdlActualizarVenta($columnaCancelada, $valorCancelarVenta, $id_venta, $id_sucursal, $_SESSION['id']);

					if($respuestaCancelarVenta == "ok"){

						$printer -> text("id_venta: ".$id_venta);
						$printer -> feed(1);
						





						$traerPartidasVenta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);

						foreach ($traerPartidasVenta as $key => $value) {

							$id_producto = $value['id_producto'];

							$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

							$cantidad = $value['cantidad'];

							$stockActual = $traerProductoES['stock'];

							$nuevoStock = $stockActual + $cantidad;

							$columnaStock = "stock";

							$total = $value['cantidad'] * $value['precio_neto'];



							$respuestaRegresarStock = ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);

							$datosPartidaKardexProductos = array("mo_tipo"=>"CANCELACION DE VENTA",
								"mo_refer"=>$id_venta,
								"mo_entsal"=>"ENTRADA",
								"id_producto"=>$id_producto,
								"mo_cant"=>$value["cantidad"],
								"mo_pu"=>$value["precio_neto"],
								"mo_existencias"=>$nuevoStock,
								"id_sucursal"=>$id_sucursal);

							ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);

							if($respuestaRegresarStock == "ok"){

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

								$producto= str_replace($order, $replace, $traerProductoES['descripcion_corta']);

								$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);


								$printer -> text($value['cantidad']."    ".$producto);

								$printer -> feed(1);

								$printer -> text($traerProductoES['ubicacion']."    $".$value['precio_neto']."  $".$total);

								$printer -> feed(1);


								echo "<script>
								$(document).Toasts('create', {
									class: 'bg-success',
									title: 'Regreso de stock exitoso',
									body: 'Al producto: ".$traerProductoES['descripcion_corta']." se le ha agregado la cantidad de: ".$cantidad.", su stock era de: ".$stockActual.", ahora es de: ".$nuevoStock."'
									})
									</script>";

								}else{
									echo "<script>
									$(document).Toasts('create', {
										class: 'bg-error',
										title: 'Regreso de stock fallido',
										body: 'Al producto: ".$traerProductoES['descripcion_corta']." no se le ha podido agregar la cantidad a devolver'
										})
										</script>";
									}
								}

								echo "<script>
								$(document).Toasts('create', {
									class: 'bg-success',
									title: 'Cancelación de venta exitoso',
									body: 'La venta no.".$id_venta." ha sido cambiada al estatus de cancelada, a continuación se muestra la devolución de sus productos al stock'
									})
									</script>";

									$printer -> feed(1);

									$printer -> text("___________________________________");
									$printer -> feed(2);

								}else{
									echo "<script>
									$(document).Toasts('create', {
										class: 'bg-error',
										title: 'Regreso de stock fallido',
										body: 'La venta no.".$id_venta." no ha podido ser cancelada'
										});
										</script>";
									}

								}else{
									echo "<script>
									$(document).Toasts('create', {
										class: 'bg-error',
										title: 'Regreso de stock fallido',
										body: 'La venta no.".$id_venta." no ha podido ser cancelada'
										});
										</script>";
									}
								}

								$printer -> feed(1);

								$printer -> cut();

								$printer -> pulse();

								$printer -> close();

								//ControladorVentas::ctrImprimirTicketCancelacion($cuerpo_ticket);
							}
						}













	/*=============================================
	MOSTRAR VENTA CLIENTE
	=============================================*/

	static public function ctrMostrarVentaCliente($valor1){

		$respuesta = ModeloVentas::mdlMostrarVentaCliente($valor1);

		return $respuesta;

	}

	static public function ctrMostrarVentaCobro($valor1){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$respuesta = ModeloVentas::mdlMostrarVentaCobro($valor1, $id_sucursal);

		return $respuesta;

	}



	static public function ctrMostrarVentaCobroFolio($folio){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$respuesta = ModeloVentas::mdlMostrarVentaCobroFolio($folio, $id_sucursal);

		return $respuesta;

	}



	static public function ctrMostrarVentaFactura($id_venta){

		$respuesta = ModeloVentas::mdlMostrarVentaFactura($id_venta);

		return $respuesta;

	}











	static public function ctrMostrarPartidasVenta($id_venta){

		$respuesta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);

		return $respuesta;

	}











	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		$mensajes = "";
		$mensajes_error = "";

		$day = date("l");
		switch ($day) {
			case "Sunday":
			$dia_texto = "Domingo";
			break;
			case "Monday":
			$dia_texto = "Lunes";
			break;
			case "Tuesday":
			$dia_texto = "Martes";
			break;
			case "Wednesday":
			$dia_texto = "Miércoles";
			break;
			case "Thursday":
			$dia_texto = "Jueves";
			break;
			case "Friday":
			$dia_texto = "Viernes";
			break;
			case "Saturday":
			$dia_texto = "Sábado";
			break;
		}



		if(isset($_POST["listaProductos"])){

			if($_POST["listaProductos"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'La venta no tiene productos a venderse',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
				}

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

				$id_usuario = $_SESSION['id'];

				$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
				
				$nombre_usuario = $traerUsuario['nombre'];
				
				$id_sucursal = $traerUsuario['id_sucursal'];

				$id_vendedor = $_POST["nuevoIdVendedor"];


				if($_POST['nuevoTipoVenta'] == "NT"){

					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoVenta']);

					$folio = $_POST['nuevoTipoVenta']."-".$respuestaFolio[0];

					$mo_tipo = "NOTA";

				}elseif ($_POST['nuevoTipoVenta'] == "RM") {

					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoVenta']);

					$folio = $_POST['nuevoTipoVenta']."-".$respuestaFolio[0];

					$mo_tipo = "REMISION";

				}
				elseif ($_POST['nuevoTipoVenta'] == "FC") {
					
					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoVenta']);

					$folio = $_POST['nuevoTipoVenta']."-".$respuestaFolio[0];

					$mo_tipo = "FACTURA";

				}



				if($_POST['nuevoNombreClienteTicket'] !== ""){

					$nombre_cliente = $_POST['nuevoNombreClienteTicket'];

				}else{
					$nombre_cliente = "";
				}



				$listaProductos = $_POST["listaProductos"];
				$totalVenta = $_POST["totalVenta"];

				$datos = array("folio"=>$folio,
					"id_cliente"=>$_POST["nuevoIdCliente2"],
					"nombre"=>$nombre_cliente,
					"productos"=>$listaProductos,
					"total"=>$totalVenta,
					"no_forma_pago"=>$_POST["nuevoNoFormaPago"],
					"tipo_venta"=>$_POST["nuevoTipoVenta"],
					"id_sucursal"=>$id_sucursal,
					"id_vendedor" => $id_vendedor);

				/*var_dump($datos);
				return;*/

				$respuesta = ModeloVentas::mdlIngresarVenta($datos);



				if($respuesta !== "error"){

					$id_venta = $respuesta[0];

					$listaProductos = json_decode($_POST["listaProductos"], true);

					$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($id_vendedor);


					foreach ($listaProductos as $key => $value) {

						$id_producto = $value["id"];

						$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);


						$columnaStock = "stock";
						$nuevoStock =  $traerProductoES["stock"] - $value["cantidad"];



						ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $id_usuario);



						$precio_unitario = number_format(($value["precio"] / 1.16),2, '.', '');



						$datos = array("id_venta"=>$id_venta,
							"id_producto"=>$id_producto,
							"cantidad"=>$value["cantidad"],
							"precio_unitario"=>$precio_unitario,
							"precio_neto"=>$value["precio"],
							"precio_compra"=>$traerProductoES['precio_compra'],
							"descuento"=>0);


						list($respuesta, $error) = ModeloPartvta::mdlIngresarPartidasVenta($datos);

						if($respuesta != false){

							$mensajes = $mensajes." Partida: ".$id_producto;

						}else{
							$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
							$replace = ' ';

							$texto_error_partida = str_replace($order, $replace, $error[2]);

							$texto_error_partida = preg_replace("/[\r\n|\n|\r]+/", " ", $texto_error_partida);

							$mensajes_error = $mensajes_error." Partida: ".$id_producto." ".$texto_error_partida;


						}




						$datosPartidaKardexProductos = array("mo_tipo"=>$mo_tipo,
							"mo_refer"=>$id_venta,
							"mo_entsal"=>"SALIDA",
							"id_producto"=>$id_producto,
							"mo_cant"=>$value["cantidad"],
							"mo_pu"=>$value["precio"],
							"mo_existencias"=>$nuevoStock,
							"id_sucursal"=>$id_sucursal);

						list($respuestaKP, $errorKP) = ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);


						if($respuestaKP != false){
							$mensajes = $mensajes." Kardex: ".$id_producto;


						}else{
							$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
							$replace = ' ';

							$texto_error_kardex = str_replace($order, $replace, $errorKP[2]);

							$texto_error_kardex = preg_replace("/[\r\n|\n|\r]+/", " ", $texto_error_kardex);

							$mensajes_error = $mensajes_error." Kardex: ".$id_producto." ".$texto_error_kardex;


						}
					}

					
					date_default_timezone_set('America/Mexico_City');
					$fecha_hora_ticket = date('d-m-Y h:i:s a');

					if ($_POST['nuevoTipoVenta'] == "FC") {

						$impresora = $traerComputadora['imp_ventas'];

						$conector = new WindowsPrintConnector($impresora);

						$printer = new Printer($conector);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

						//$printer -> bitImage($logo);

						$printer -> feed(1);

						$printer -> setTextSize(2, 2);

						$printer -> text("PASE A LA CAJA");

						$printer -> feed(2);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text($dia_texto.", ".$fecha_hora_ticket);

						$printer -> feed(2);

						$printer -> text("Atendido por: ".$traerVendedor['nombres']);

						$printer -> feed(2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(3);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer -> text("*****TTTTTTT FFFFFF*****");

						$printer -> feed(1);

						$printer -> text("**   TTT  FFFF    **");

						$printer -> feed(1);

						$printer -> text("***** TTT  FF  *****");

						$printer -> feed(2);

						$printer -> setTextSize(2, 2);

						$printer -> text("IMPORTE: $".$totalVenta);

						$printer -> feed(3);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(1);

						$printer -> cut();

						$printer -> pulse();

						$printer -> close();
					}else{
						

						$impresora = $traerComputadora['imp_ventas'];

						$conector = new WindowsPrintConnector($impresora);

						$printer = new Printer($conector);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

						//$printer -> bitImage($logo);

						$printer -> feed(1);

						$printer -> setTextSize(2, 2);

						$printer -> text("PASE A LA CAJA");

						$printer -> feed(2);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text($dia_texto.", ".$fecha_hora_ticket);

						$printer -> feed(2);

						$printer -> text("Atendido por: ".$traerVendedor['nombres']);

						$printer -> feed(2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(3);

						$printer -> setTextSize(2, 2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer -> text("IMPORTE: $".$totalVenta);

						$printer -> feed(3);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(1);

						$printer -> cut();

						$printer -> pulse();

						$printer -> close();
					}

					echo "<script>


					Swal.fire({
						icon: 'success',
						title: 'La venta no.".$id_venta." ha sido generada con exito',
						text: '".$mensajes."',
						footer: '".$mensajes_error."',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'crear-venta-filtros';
							});
							</script>";
						}else{
							echo"<script>
							Swal.fire({
								icon: 'error',
								title: 'Ooh Ooh, algo salio mal',
								showConfirmButton: false,
								timer: 2000
								});
								</script>";

							}
		}//ISSET LISTA PRODUCTOS

	}//CREAR VENTA












	static public function ctrEntregarVenta(){

		if(isset($_POST['id_venta'])){

			$id_venta = $_POST['id_venta'];

			$datos = array("id_venta"=>$id_venta,
				"entregada"=>1,
				"id_usuario_ult_mod"=>$_SESSION['id']);

			$respuesta = ModeloVentas::mdlEntregarVenta($datos);

			if($respuesta == "ok"){
				echo "<script>


				Swal.fire({
					icon: 'success',
					title: 'La venta no.".$id_venta." ha sido entregada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){

						window.location = 'lista-entrega-ventas';
						});
						</script>";
					}else{
						echo "<script>


						Swal.fire({
							icon: 'error',
							title: 'Ha habido un error',
							showConfirmButton: false,
							timer: 2000
							});
							</script>";
						}

					}


				}










				static public function ctrMostrarSumaVentasRangoFechas($no_rango){

					list($fecha1, $fecha2) = ControladorVentas::ctrObtenerRangoFechas($no_rango);

					$respuesta = ModeloVentas::mdlMostrarSumaVentasRangoFechas($fecha1, $fecha2);

					return $respuesta;
				}









				static public function ctrMostrarNoVentasRangoFechas($no_rango){

					list($fecha1, $fecha2) = ControladorVentas::ctrObtenerRangoFechas($no_rango);

					$respuesta = ModeloVentas::mdlMostrarNoVentasRangoFechas($fecha1, $fecha2);

					return $respuesta;
				}










				static public function ctrMostrarSumaUtilidadVentasRangoFechas($no_rango){

					list($fecha1, $fecha2) = ControladorVentas::ctrObtenerRangoFechas($no_rango);

					$respuesta = ModeloVentas::mdlMostrarSumaUtilidadVentasRangoFechas($fecha1, $fecha2);

					return $respuesta;
				}















				static public function ctrEnviarMensaje($mensaje, $celular){

					$params=array(
						'token' => '5t6eu06n1yooxtu4',
						'to' => '+52'.$_POST['envia_celular'],
						'body' => $mensaje
					);
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.ultramsg.com/instance68310/messages/chat",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_SSL_VERIFYHOST => 0,
						CURLOPT_SSL_VERIFYPEER => 0,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => http_build_query($params),
						CURLOPT_HTTPHEADER => array(
							"content-type: application/x-www-form-urlencoded"
						),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);
				}







				static public function ctrReenviarFacturaVenta2(){
					if(isset($_POST['reenviar_factura_venta'])){
						$id_venta = $_POST['reenviar_factura_venta'];
						$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);
						$traerCliente = ControladorClientes::ctrMostrarCliente($traerVenta['id_cliente']);

						$archivo = "SDK2/timbrados/FC-".$traerCliente['rfc']."-".$id_venta.".xml";
						$archivo2 = "SDK2/timbrados/FC-".$traerCliente['rfc']."-".$id_venta.".pdf";

						if(file_exists($archivo2)){
							$destino = $traerCliente['email'];
							$asunto = "Factura";
							$message = "Hola ".$traerCliente['nombre']." te hacemos entrega de tu factura";


		//Obtener datos del archivo subido 
							$file_tmp_name      = $archivo;
							$file_name          = "FC-".$traerCliente['rfc']."-".$id_venta;
							$file_size          = filesize($archivo);
							$file_type          = "text/xml";
	    //$file_type          = "application/pdf";



		//Leer el archivo y codificar el contenido para armar el cuerpo del email
							$handle              = fopen($file_tmp_name, "r");
							$content             = fread($handle, $file_size);
							fclose($handle);
							$encoded_content     = chunk_split(base64_encode($content));




	    //Obtener datos del archivo subido 
							$file_tmp_name2      = $archivo2;
							$file_name2          = "FC-".$traerCliente['rfc']."-".$id_venta;
							$file_size2          = filesize($archivo2);
	    //$file_type          = "text/xml";
							$file_type2          = "application/pdf";



		//Leer el archivo y codificar el contenido para armar el cuerpo del email
							$handle2              = fopen($file_tmp_name2, "r");
							$content2             = fread($handle2, $file_size2);
							fclose($handle2);
							$encoded_content2     = chunk_split(base64_encode($content2));

							$boundary            = md5("pera");

	    //Encabezados
							$headers             = "MIME-Version: 1.0\r\n"; 
							$headers            .= "From:bloodgem21@gmail.com\r\n"; 
							$headers            .= "Reply-To: ".$destino."" . "\r\n";
							$headers            .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 

	    //Texto plano
							$body               = "--$boundary\r\n";
							$body               .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
							$body               .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
							$body               .= chunk_split(base64_encode($message)); 

	    //Adjunto
							$body               .= "--$boundary\r\n";
							$body               .="Content-Type: $file_type; name=".$file_name.".xml\r\n";
							$body               .="Content-Disposition: attachment; filename=".$file_name.".xml\r\n";
							$body               .="Content-Transfer-Encoding: base64\r\n";
							$body               .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
							$body               .= $encoded_content; 



	    //Adjunto
							$body               .= "--$boundary\r\n";
							$body               .="Content-Type: $file_type2; name=".$file_name2.".pdf\r\n";
							$body               .="Content-Disposition: attachment; filename=".$file_name2.".pdf\r\n";
							$body               .="Content-Transfer-Encoding: base64\r\n";
							$body               .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
							$body               .= $encoded_content2; 


	    //Enviando el mail
							$sentMail = mail($destino, $asunto, $body, $headers);

							if($sentMail == true){

								$columnaEnviada = "enviada";
								$valorEnviada =  1;

								ModeloVentas::mdlActualizarVenta2($columnaEnviada, $valorEnviada, $id_venta, $_SESSION['id']);

								echo "<script>

								Swal.fire({
									icon: 'success',
									title: 'La factura se ha mandado con éxito',
									showConfirmButton: true
									}).then(function(result){

										window.location = 'lista-ventas';
										});
										</script>";

									}else{

										echo "<script>

										Swal.fire({
											icon: 'warning',
											title: 'La factura no se ha podido enviar',
											showConfirmButton: true
											}).then(function(result){

												window.location = 'lista-ventas';
												});
												</script>";

											}

										}else{
											echo '<script>window.open("extensiones/tcpdf/examples/factura.php?id_venta='.$id_venta.'", "_blank");
											window.location = "lista-ventas";
											</script>';

										}
									}

								}





	/*=============================================
	Aplicar pago
	=============================================*/

	static public function ctrAplicarPago(){

		if(isset($_SESSION['id_corte_caja'])){

			if(isset($_POST["mostrarIdVenta"])){

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

				$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

				$nombre_usuario = $traerUsuario['nombre'];

				$traerVenta = ModeloVentas::mdlMostrarVentaCliente($_POST['mostrarIdVenta']);

				$traerVentaC = ModeloVentas::mdlMostrarVenta($_POST['mostrarIdVenta']);
				
				$traerSucursal = ModeloSucursales::mdlMostrarSucursal($traerVenta['id_sucursal']);


				
				$nombre_sucursal = $traerSucursal['nombre'];

				$id_venta = $traerVenta['id'];

				$id_cliente = $traerVenta['id_cliente'];


				$traerCliente = ControladorClientes::ctrMostrarCliente($id_cliente);



				$listaProductos = json_decode($traerVenta["productos"], true);



				if($traerVentaC['pagada'] == 1){
					echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Esta venta ya ha sido pagada',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'lista-ventas';
							});
							</script>";

							return;
						}



						if($_POST["nuevoIdFormaPagoCobro"] == "PPD"){
							$saldo_actual = $traerVenta['total'];
						}else{
							$saldo_actual = 0;
						}

						$importe_efectivo_correcto = $_POST["nuevoImporteEfectivo"] - $_POST["nuevoCambioCobro"];

						$datos = array("id"=>$_POST["mostrarIdVenta"],
							"id_corte_caja"=>$_SESSION["id_corte_caja"],
							"saldo_actual"=>$saldo_actual,
							"dinero"=>$_POST["nuevoImporteEfectivo"],
							"efectivo"=>$importe_efectivo_correcto,
							"tarjeta_debido"=>$_POST["nuevoImporteTarjetaDebito"],
							"tarjeta_credito"=>$_POST["nuevoImporteTarjetaCredito"],
							"transferencia"=>$_POST["nuevoImporteTransferencia"],
							"cambio"=>$_POST["nuevoCambioCobro"],
							"id_terminal_bancaria"=>$_POST["nuevaTerminalBancaria"],
							"id_forma_pago"=>$_POST["nuevoIdFormaPagoCobro"],
							"id_cfdi"=>$_POST["nuevoIdCfdiCobro"],
							"id_metodo_pago"=>$_POST["nuevoIdMetodoPagoCobro"],
							"id_usuario_ult_mod" => $_SESSION['id']);


						$respuesta = ModeloVentas::mdlGuardarDatosCobro($datos);

						if($respuesta == 'ok'){

							if($id_cliente == 1){

								if($_POST['envia_celular'] !== ""){

									$celular = "+52".$_POST['envia_celular'];

									$mensaje = "Ticket de la venta no.".$id_venta." 
									";
									foreach ($listaProductos as $key3 => $value3) {

										$traerProducto3 = ControladorProductos::ctrMostrarProducto($value3['id']);

										$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

										$producto3= str_replace($order, $replace, $traerProducto3['descripcion_corta']);

										$producto3 = preg_replace("/[\r\n|\n|\r]+/", " ", $producto3);


										$mensaje = $mensaje .$producto3." $".number_format($value3["precio"],2)." Und x ".$value3["cantidad"]." = *$".number_format($value3["total"],2)."*";

									}

									$mensaje = $mensaje."
									Total=*$".number_format($traerVenta["total"],2)."*";

									ControladorVentas::ctrEnviarMensaje($mensaje, $celular);


								}
							}else{

								$celular = $traerCliente['telefono1'];

								$mensaje = "Ticket de la venta no.".$id_venta."
								";
								foreach ($listaProductos as $key3 => $value3) {

									$traerProducto3 = ControladorProductos::ctrMostrarProducto($value3['id']);
									$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

									$producto3= str_replace($order, $replace, $traerProducto3['descripcion_corta']);

									$producto3 = preg_replace("/[\r\n|\n|\r]+/", " ", $producto3);


									$mensaje = $mensaje .$producto3." $".number_format($value3["precio"],2)." Und x ".$value3["cantidad"]." = *$".number_format($value3["total"],2)."*";

								}
								$mensaje = $mensaje."
								Total=*$".number_format($traerVenta["total"],2)."*";

								ControladorVentas::ctrEnviarMensaje($mensaje, $celular);

							}







							if ($traerVenta["tipo_venta"] == "FC") {

								list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $nombre_archivo, $total_encabezado) = ModeloVentas::mdlTimbrarVenta($traerVenta['id']);

						//var_dump($codigo_mf_texto);

								if($codigo_mf_numero == 0){


									$datosTimbrada = array("id"=>$traerVenta['id'],
										"uuid"=>$uuid,
										"certnumber"=>$certnumber,
										"sello"=>$sello,
										"sello_sat"=>$sello_sat,
										"cadena_timbre"=>$cadena_timbre,
										"no_certificado_sat"=>$no_certificado_sat,
										"fecha_timbrado"=>$fecha_timbrado,
										"ruta"=>$ruta,
										"id_usuario_ult_mod"=>$_SESSION['id']
									);



									$respuesta_datos_timbrada = ModeloVentas::mdlVentaTimbrada($datosTimbrada);


									if($respuesta_datos_timbrada == 'ok'){

										$traerVentaFinal = ModeloVentas::mdlMostrarVenta($id_venta);

										$dateFecha = date_create($traerVentaFinal['fecha_pago']);
										$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
										$day=date_format($dateFecha, 'l');

										$dia_texto = ControladorVentas::ctrObtenerDia($day);

										$traerPartidasVenta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);
										$traerUsoCFDI = ModeloOtros::mdlMostrarCFDI($traerVentaFinal['id_cfdi']);
										$traerMetodoPago = ModeloOtros::mdlMostrarMetodoPago($traerVentaFinal['id_forma_pago']);
										$traerFormaPago = ModeloOtros::mdlMostrarFormaPago($traerVentaFinal['id_metodo_pago']);
										$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVentaFinal['id_vendedor']);
										$total_encabezado_formateado = number_format($total_encabezado, 6);
										$total_encabezado_formateado = str_pad($total_encabezado_formateado,25,"0",STR_PAD_LEFT);
										$sello_qr = substr($sello, -8);

										$rutaQR = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?id=".$uuid."&re=".$traerSucursal['rfc']."&rr=".$traerCliente['rfc']."&tt=".$total_encabezado_formateado."&fe=".$sello_qr;

										echo '<script>window.open("extensiones/tcpdf/examples/factura.php?id_venta='.$id_venta.'", "_blank");</script>';





										$impresora = $traerComputadora['imp_almacen'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

										//$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($nombre_sucursal);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> text("Factura");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text($dia_texto.", ".$fecha_hora);

										$printer -> feed(2);

										$printer -> text("Atendido por: ".$traerVendedor['nombres']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("---------------------------------------------");

										$printer -> feed(1);

										$printer -> text("Fecha y hora de emisión: ".$traerVentaFinal['fecha_pago']);

										$printer -> feed(1);

										$printer -> text("No. serie del CSD: ".$traerVentaFinal['certnumber']);

										$printer -> feed(1);

										$printer -> text("Folio Físcal:");

										$printer -> feed(1);

										$printer -> text($traerVentaFinal['uuid']);

										$printer -> feed(2);

										$printer -> text("Cliente: ".$traerCliente['nombre']);

										$printer -> feed(1);

										$printer -> text("RFC: ".$traerCliente['rfc']);

										$printer -> feed(1);

										$printer -> text("Uso del CFDI: ".$traerVentaFinal['id_cfdi']." ".$traerUsoCFDI['descripcion']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> qrCode($rutaQR);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("---------------------------------------------");

										$printer -> feed(1);

										$printer -> text("Cant/Ubica/Clave/Descripción   C.P   Importe");

										$printer -> feed(1);

										$printer -> text("---------------------------------------------");

										$printer -> feed(1);

										foreach ($traerPartidasVenta as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

											$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

											$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

											$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

											$importe = $value['cantidad'] * $value['precio_unitario'];
											$impuesto_traslado = $value['cantidad'] * ($value['precio_neto'] - $value['precio_unitario']);

											$base_traslado = $value['cantidad'] * $value['precio_unitario'];

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> text($producto);

											$printer -> feed(1);

											$printer -> text("$".number_format($value["precio_unitario"],2)."  x  ".$value['cantidad']."u  =  $".number_format($importe, 2));

											$printer -> feed(1);

											$printer -> text("Clave Prod/Serv: ".$traerProducto['clave_sat']);

											$printer -> feed(1);

											$printer -> text("Traslados:");

											$printer -> feed(1);

											$printer -> text("Base: ".number_format($base_traslado,2)."  Impuesto: 002  Factor: Tasa");

											$printer -> feed(1);

											$printer -> text("Tasa/Cuota: 0.160000  Importe:".number_format($impuesto_traslado,2));

											$printer -> feed(2);
										}

										$subtotal = round(($traerVenta['total'] / 1.16), 2);

										$iva = round($subtotal * 0.16, 2);

										$printer -> feed(1);

										$printer -> text("---------------------------------------------");

										$printer -> feed(1);

										$printer -> text("Subtotal: $".number_format($subtotal, 2));

										$printer -> feed(1);

										$printer -> text("I.V.A (16%): $".number_format($iva, 2));

										$printer -> feed(1);

										$printer -> text("Total: $".number_format($traerVentaFinal["total"],2));

										$printer -> feed(2);

										$printer -> text("Importe con letra: $");

										$printer -> feed(2);

										$printer -> text("Metodo Pago: ".$traerVentaFinal['id_forma_pago']." ".$traerMetodoPago['descripcion']);

										$printer -> feed(1);

										$printer -> text("Forma Pago: ".$traerVentaFinal['id_metodo_pago']." ".$traerFormaPago['descripcion']);

										$printer -> feed(2);

										$printer -> text("Confirmación SAT:");

										$printer -> feed(1);

										$printer -> text("Mensaje SAT:");

										$printer -> feed(2);

										$printer -> text("Sello Digital del CFDI : ".$traerVentaFinal['sello']);

										$printer -> feed(2);

										$printer -> text("Sello del SAT : ".$traerVentaFinal['sello_sat']);

										$printer -> feed(2);

										$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$traerVentaFinal['cadena_timbre']);

										$printer -> feed(2);

										$printer -> text("Fecha y Hora de Certificación : ".$traerVentaFinal['fecha_timbrado']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("Este Documento es una representación");

										$printer -> feed(1);

										$printer -> text("impresa de un CFDI");

										$printer -> feed(2);

										$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

										$printer -> feed(1);

										$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

										$printer -> feed(2);

										$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

										$printer -> feed(1);

										$printer -> text("NI DEVOLUCIÓN.");

										$printer -> feed(2);

										$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

										$printer -> feed(1);

										$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

										$printer -> feed(2);

										$printer -> text("DEVOLUCIONES EN EFECTIVO");

										$printer -> feed(1);

										$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

										$printer -> feed(2);

										$printer -> text("*GRACIAS POR SU PREFERENCIA*");


										$printer -> feed(1);

										$printer -> cut();

										$printer -> pulse();

										$printer -> close();










										$impresora = $traerComputadora['imp_caja'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

										//$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($nombre_sucursal);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("***************");

										$printer -> feed(1);

										$printer -> text("*F A C T U R A*");

										$printer -> feed(1);

										$printer -> text("***************");

										$printer -> feed(2);

										$printer -> text($dia_texto.", ".$fecha_hora);

										$printer -> feed(2);

										$printer -> text("Atendido por: ".$traerVendedor['nombres']);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(1);

										foreach ($listaProductos as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id']);


											$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

											$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

											$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> text($producto);

											$printer -> feed(1);

											$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

											$printer -> feed(2);

										}

										$printer -> feed(1);

										$printer -> setTextSize(2, 2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("Total: $".number_format($traerVentaFinal["total"],2));

										$printer -> feed(2);

										$printer -> setTextSize(1, 1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("ESTE TICKET NO ES VALIDO PARA RECOGER SU");

										$printer -> feed(1);

										$printer -> text("MERCANCIA SI NO LLEVA EL SELLO DEL CAJERO");

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> pulse();

										$printer -> close();

									}



									echo "<script>

									Swal.fire({
										icon: 'success',
										title: 'La venta ha sido pagada y timbrada con exito',
										showConfirmButton: true
										}).then(function(result){

											window.location = 'cobro';
											});
											</script>";

										}else{


											$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
											$replace = ' ';

											$texto = str_replace($order, $replace, $codigo_mf_texto);
								//$texto = substr($codigo_mf_texto, 0, 50);

											$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);


											$traerVentaFinal = ModeloVentas::mdlMostrarVenta($id_venta);
											$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVentaFinal['id_vendedor']);

											$dateFecha = date_create($traerVentaFinal['fecha_pago']);
											$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
											$day=date_format($dateFecha, 'l');

											$dia_texto = ControladorVentas::ctrObtenerDia($day);


											$impresora = $traerComputadora['imp_caja'];

											$conector = new WindowsPrintConnector($impresora);

											$printer = new Printer($conector);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

											//$printer -> bitImage($logo);

											$printer -> feed(1);

											$printer -> text($nombre_sucursal);

											$printer -> feed(1);

											$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['colonia']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['rfc']);

											$printer -> feed(1);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text("***************");

											$printer -> feed(1);

											$printer -> text("*F A C T U R A*");

											$printer -> feed(1);

											$printer -> text("***************");

											$printer -> feed(2);

											$printer -> text($dia_texto.", ".$fecha_hora);

											$printer -> feed(2);

											$printer -> text("Atendido por: ".$traerVendedor['nombres']);

											$printer -> feed(2);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											$printer->qrCode($traerVentaFinal['folio'], Printer::QR_ECLEVEL_L, 5);

											$printer -> feed(1);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text("=============================================");

											$printer -> feed(1);

											foreach ($listaProductos as $key => $value) {

												$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id']);


												$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

												$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

												$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

												$printer -> setTextSize(2, 2);

												$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

												$printer -> feed(1);

												$printer -> setTextSize(1, 1);

												$printer -> text($traerProducto['ubicacion']);

												$printer -> feed(1);

												$printer -> text($producto);

												$printer -> feed(1);

												$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

												$printer -> feed(2);

											}

											$printer -> feed(1);

											$printer -> setTextSize(2, 2);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											$printer -> text("Total: $".number_format($traerVenta["total"],2));

											$printer -> feed(2);

											$printer -> setTextSize(1, 1);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text("ESTE TICKET NO ES VALIDO PARA RECOGER SU");

											$printer -> feed(1);

											$printer -> text("MERCANCIA SI NO LLEVA EL SELLO DEL CAJERO");

											$printer -> feed(1);

											$printer -> text("=============================================");

											$printer -> feed(1);

											$printer -> cut();

											$printer -> pulse();

											$printer -> close();









											$impresora = $traerComputadora['imp_almacen'];

											$conector = new WindowsPrintConnector($impresora);

											$printer = new Printer($conector);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

											//$printer -> bitImage($logo);

											$printer -> feed(1);

											$printer -> text($nombre_sucursal);

											$printer -> feed(1);

											$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['colonia']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

											$printer -> feed(1);

											$printer -> text($traerSucursal['rfc']);

											$printer -> feed(1);

											$printer -> text("Para Factura");

											$printer -> feed(2);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text($dia_texto.", ".$fecha_hora);

											$printer -> feed(2);

											$printer -> text("Atendido por: ".$traerVendedor['nombres']);

											$printer -> feed(2);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

											$printer -> feed(1);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text("---------------------------------------------");

											$printer -> feed(1);

											foreach ($listaProductos as $key => $value) {

												$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id']);

												$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

												$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

												$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

												$printer -> setTextSize(2, 2);

												$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

												$printer -> feed(1);

												$printer -> setTextSize(1, 1);

												$printer -> text($traerProducto['ubicacion']);

												$printer -> feed(1);

												$printer -> text($producto);

												$printer -> feed(1);

												$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

												$printer -> feed(2);
											}

											$printer -> feed(2);

											$printer -> setTextSize(2, 2);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											$printer -> text("Total: $".number_format($traerVenta["total"],2));

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> setJustification(Printer::JUSTIFY_LEFT);

											$printer -> text("=============================================");

											$printer -> feed(2);

											$printer -> text("Este Documento NO es una representación");

											$printer -> feed(1);

											$printer -> text("impresa de un CFDI");

											$printer -> feed(2);

											$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

											$printer -> feed(1);

											$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

											$printer -> feed(2);

											$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

											$printer -> feed(1);

											$printer -> text("NI DEVOLUCIÓN.");

											$printer -> feed(2);

											$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

											$printer -> feed(1);

											$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

											$printer -> feed(2);

											$printer -> text("DEVOLUCIONES EN EFECTIVO");

											$printer -> feed(1);

											$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

											$printer -> feed(2);

											$printer -> setJustification(Printer::JUSTIFY_CENTER);

											$printer -> text("*GRACIAS POR SU PREFERENCIA*");

											$printer -> feed(1);

											$printer -> cut();

											$printer -> pulse();

											$printer -> close();


											echo "<script>

											Swal.fire({
												icon: 'error',
												title: 'Error no.".$codigo_mf_numero."',
												text: '".$texto."',
												footer: 'No se ha podido timbrar la factura',
												showConfirmButton: true
												}).then(function(result){
													Swal.fire({
														icon: 'info',
														title: 'La venta ha sido pagada con éxito',
														footer: 'No se ha podido timbrar la factura',
														showConfirmButton: true
														}).then(function(result){

															window.location = 'cobro';
															});
															});


															</script>";

														}
													}else{

														//NOTA

														/*echo "<script>window.open('extensiones/tcpdf/pdf/factura.php?id_venta_nota=".$traerVenta['id']."');</script>";*/

														/*echo '<script>window.open("extensiones/tcpdf/examples/pdf-ticket-venta.php?id_venta='.$id_venta.'", "_blank");</script>';*/



														$traerVentaFinal = ModeloVentas::mdlMostrarVenta($id_venta);
														$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVentaFinal['id_vendedor']);

														$dateFecha = date_create($traerVentaFinal['fecha_pago']);
														$fecha_hora=date_format($dateFecha, 'd-m-Y h:i:s a');
														$day=date_format($dateFecha, 'l');

														$dia_texto = ControladorVentas::ctrObtenerDia($day);

														$impresora = $traerComputadora['imp_caja'];

														$conector = new WindowsPrintConnector($impresora);

														$printer = new Printer($conector);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

														//$printer -> bitImage($logo);

														$printer -> feed(1);

														$printer -> text($nombre_sucursal);

														$printer -> feed(1);

														$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['colonia']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['rfc']);

														$printer -> feed(1);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text("*************************");

														$printer -> feed(1);

														$printer -> text("*N O T A  D E  V E N T A*");

														$printer -> feed(1);

														$printer -> text("*************************");

														$printer -> feed(2);

														$printer -> text($dia_texto.", ".$fecha_hora);

														$printer -> feed(2);

														$printer -> text("Atendido por: ".$traerVendedor['nombres']);

														$printer -> feed(1);

														$printer -> text("Cliente: ".$traerVentaFinal['nombre']);

														$printer -> feed(2);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

														$printer -> feed(1);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text("=============================================");

														$printer -> feed(1);

														foreach ($listaProductos as $key => $value) {

															$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id']);


															$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

															$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

															$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

															$printer -> setTextSize(2, 2);

															$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

															$printer -> feed(1);

															$printer -> setTextSize(1, 1);

															$printer -> text($traerProducto['ubicacion']);

															$printer -> feed(1);

															$printer -> text($producto);

															$printer -> feed(1);

															$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

															$printer -> feed(2);

														}

														$printer -> feed(1);

														$printer -> setTextSize(2, 2);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														$printer -> text("Total: $".number_format($traerVenta["total"],2));

														$printer -> feed(2);

														$printer -> setTextSize(1, 1);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text("ESTE TICKET NO ES VALIDO PARA RECOGER SU");

														$printer -> feed(1);

														$printer -> text("MERCANCIA SI NO LLEVA EL SELLO DEL CAJERO");

														$printer -> feed(1);

														$printer -> text("=============================================");

														$printer -> feed(1);

														$printer -> cut();

														$printer -> pulse();

														$printer -> close();









														$impresora = $traerComputadora['imp_almacen'];

														$conector = new WindowsPrintConnector($impresora);

														$printer = new Printer($conector);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														//$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.png", false);

														//$printer -> bitImage($logo);

														$printer -> feed(1);

														$printer -> text($nombre_sucursal);

														$printer -> feed(1);

														$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['colonia']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

														$printer -> feed(1);

														$printer -> text($traerSucursal['rfc']);

														$printer -> feed(1);

														$printer -> text("Nota de Venta");

														$printer -> feed(2);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text($dia_texto.", ".$fecha_hora);

														$printer -> feed(2);

														$printer -> text("Atendido por: ".$traerVendedor['nombres']);

														$printer -> feed(1);

														$printer -> text("Cliente: ".$traerVentaFinal['nombre']);

														$printer -> feed(2);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														$printer->qrCode($id_venta, Printer::QR_ECLEVEL_L, 5);

														$printer -> feed(1);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text("=============================================");

														$printer -> feed(1);

														foreach ($listaProductos as $key => $value) {

															$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id']);

															$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

															$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

															$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

															$printer -> setTextSize(2, 2);

															$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

															$printer -> feed(1);

															$printer -> setTextSize(1, 1);

															$printer -> text($traerProducto['ubicacion']);

															$printer -> feed(1);

															$printer -> text($producto);

															$printer -> feed(1);

															$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

															$printer -> feed(2);
														}

														$printer -> feed(1);

														$printer -> setTextSize(2, 2);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														$printer -> text("Total: $".number_format($traerVenta["total"],2));

														$printer -> feed(1);

														$printer -> setTextSize(1, 1);

														$printer -> setJustification(Printer::JUSTIFY_LEFT);

														$printer -> text("=============================================");

														$printer -> feed(2);

														$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

														$printer -> feed(1);

														$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

														$printer -> feed(2);

														$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

														$printer -> feed(1);

														$printer -> text("NI DEVOLUCIÓN.");

														$printer -> feed(2);

														$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

														$printer -> feed(1);

														$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

														$printer -> feed(2);

														$printer -> text("DEVOLUCIONES EN EFECTIVO");

														$printer -> feed(1);

														$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

														$printer -> feed(2);

														$printer -> setJustification(Printer::JUSTIFY_CENTER);

														$printer -> text("*GRACIAS POR SU PREFERENCIA*");

														$printer -> feed(1);

														$printer -> cut();

														$printer -> pulse();

														$printer -> close();



														echo "<script>

														Swal.fire({
															icon: 'success',
															title: 'La venta ha sido pagada con exito',
															showConfirmButton: false,
															timer: 2000
															}).then(function(result){
																window.location = 'cobro';
																});
																</script>";
															}
														}

													}
								}//ISSER SI EXISTE UN CORTE DE CAJA
								else{
									echo"<script>
									Swal.fire({
										icon: 'error',
										title: 'Aun no has abierto tu corte de caja',
										showConfirmButton: false,
										timer: 2000
										});
										</script>";
									}

								}




								static public function ctrGuardarDatosCobro(){

									if(isset($_POST["cambiarDatosPagoVenta"])){

										$id_venta = $_POST["cambiarDatosPagoVenta"];

										$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

										$importe_efectivo_correcto = $_POST["editarImporteEfectivoCDPV"] - $_POST["editarCambioCobroCDPV"];

										$datos = array("id"=>$id_venta,
											"id_corte_caja"=>$traerVenta['id_corte_caja'],
											"saldo_actual"=>$traerVenta['saldo_actual'],
											"dinero"=>$_POST["editarImporteEfectivoCDPV"],
											"efectivo"=>$importe_efectivo_correcto,
											"tarjeta_debido"=>$_POST["editarImporteTarjetaDebitoCDPV"],
											"tarjeta_credito"=>$_POST["editarImporteTarjetaCreditoCDPV"],
											"transferencia"=>$_POST["editarImporteTransferenciaCDPV"],
											"cambio"=>$_POST["editarCambioCobroCDPV"],
											"id_forma_pago"=>$traerVenta['id_forma_pago'],
											"id_cfdi"=>$traerVenta['id_cfdi'],
											"id_metodo_pago"=>$traerVenta['id_metodo_pago'],
											"id_usuario_ult_mod" => $_SESSION['id']);

				//var_dump($datos);

										$respuesta = ModeloVentas::mdlGuardarDatosCobro($datos);


										if($respuesta == 'ok'){
											echo "<script>

											Swal.fire({
												icon: 'success',
												title: 'Se han cambiado los datos de la venta con éxito',
												showConfirmButton: false,
												timer: 2000
												}).then(function(result){
													window.location = 'lista-ventas';
													});
													</script>";
												}else{
													echo "<script>

													Swal.fire({
														icon: 'error',
														title: 'No se han podido cambiar los datos de la venta',
														showConfirmButton: false,
														timer: 2000
														});
														</script>";
													}
												}
											}


	/*=============================================
	Aplicar pago
	=============================================*/

	static public function ctrFacturar(){

		if(isset($_SESSION['id_corte_caja'])){

			if(isset($_POST["mostrarIdVenta"])){

				$traerVenta = ModeloVentas::mdlMostrarVentaCliente($_POST['mostrarIdVenta']);



				if($_POST["nuevoIdFormaPagoCobro"] == "PPD"){
					$saldo_actual = $traerVenta['total'];
				}else{
					$saldo_actual = 0;
				}

				$datos = array("id"=>$_POST["mostrarIdVenta"],
					"id_corte_caja"=>$_SESSION["id_corte_caja"],
					"saldo_actual"=>$saldo_actual,
					"efectivo"=>$_POST["nuevoImporteEfectivo"],
					"tarjeta_debido"=>$_POST["nuevoImporteTarjetaDebito"],
					"tarjeta_credito"=>$_POST["nuevoImporteTarjetaCredito"],
					"transferencia"=>0,
					"cambio"=>$_POST["nuevoCambioCobro"],
					"id_forma_pago"=>$_POST["nuevoIdFormaPagoCobro"],
					"id_cfdi"=>$_POST["nuevoIdCfdiCobro"],
					"id_metodo_pago"=>$_POST["nuevoIdMetodoPagoCobro"]);

				$respuesta = ModeloVentas::mdlAplicarPago($datos);

				if($respuesta == 'ok'){

					if ($traerVenta["tipo_venta"] == "FC") {

						list($codigo_mf_texto, $uuid, $certnumber, $cadena, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado) = ModeloVentas::mdlTimbrarVenta($traerVenta['id'], $traerVenta['productos']);



						if($codigo_mf_texto == '[MODO PRUEBAS] OK'){

							$datosTimbrada = array("id"=>$traerVenta['id'],
								"uuid"=>$uuid,
								"certnumber"=>$certnumber,
								"cadena"=>$cadena,
								"sello"=>$sello,
								"sello_sat"=>$sello_sat,
								"cadena_timbre"=>$cadena_timbre,
								"no_certificado_sat"=>$no_certificado_sat,
								"fecha_timbrado"=>$fecha_timbrado);

							ModeloVentas::mdlVentaTimbrada($datosTimbrada);


							echo "<script>

							Swal.fire({
								icon: 'success',
								title: 'La venta ha sido pagada y timbrada con exito',
								showConfirmButton: false,
								timer: 2000
								}).then(function(result){
									window.location = 'lista-facturas';
									});
									</script>";

								}else{

									echo "<script>

									Swal.fire({
										icon: 'error',
										title: '".$timbrarVenta."',
										showConfirmButton: false,
										timer: 6000
										}).then(function(result){
											Swal.fire({
												icon: 'success',
												title: 'La venta ha sido pagada con exito',
												showConfirmButton: false,
												timer: 2000
												}).then(function(result){
													window.location = 'lista-facturas';
													});
													});
													</script>";	

												}
											}else{

												/*echo "<script>window.open('extensiones/tcpdf/pdf/factura.php?id_venta_nota=".$traerVenta['id']."');</script>";*/


												echo "<script>

												Swal.fire({
													icon: 'success',
													title: 'La venta ha sido pagada con exito',
													showConfirmButton: false,
													timer: 2000
													}).then(function(result){
														window.location = 'lista-facturas';
														});
														</script>";
													}
												}

											}
								}//ISSER SI EXISTE UN CORTE DE CAJA
								else{
									echo"<script>
									Swal.fire({
										icon: 'error',
										title: 'Aun no has abierto tu corte de caja',
										showConfirmButton: false,
										timer: 2000
										});
										</script>";
									}

								}













								static public function ctrTimbrarVenta(){

									if(isset($_POST["timbrarVenta"])){

										$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

										$id_venta = $_POST["timbrarVenta"];

										list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $nombre_archivo, $total_encabezado) = ModeloVentas::mdlTimbrarVenta($id_venta);

						//var_dump($codigo_mf_texto);

										if($codigo_mf_numero == 0){



											$datosTimbrada = array("id"=>$id_venta,
												"uuid"=>$uuid,
												"certnumber"=>$certnumber,
												"sello"=>$sello,
												"sello_sat"=>$sello_sat,
												"cadena_timbre"=>$cadena_timbre,
												"no_certificado_sat"=>$no_certificado_sat,
												"fecha_timbrado"=>$fecha_timbrado,
												"ruta"=>$ruta,
												"id_usuario_ult_mod"=>$_SESSION['id']
											);



											$respuesta_datos_timbrada = ModeloVentas::mdlVentaTimbrada($datosTimbrada);


											if($respuesta_datos_timbrada == 'ok'){

												$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
												$traerVenta = ModeloVentas::mdlMostrarVenta($id_venta);
												$traerCliente = Controladorclientes::ctrMostrarCliente($traerVenta['id_cliente']);
												$traerSucursal = ModeloSucursales::mdlMostrarSucursal($traerVenta['id_sucursal']);
												$traerPartidasVenta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);
												$traerUsoCFDI = ModeloOtros::mdlMostrarCFDI($traerVenta['id_cfdi']);
												$traerMetodoPago = ModeloOtros::mdlMostrarMetodoPago($traerVenta['id_forma_pago']);
												$traerFormaPago = ModeloOtros::mdlMostrarFormaPago($traerVenta['id_metodo_pago']);

												$total_encabezado_formateado = number_format($total_encabezado, 6);
												$total_encabezado_formateado = str_pad($total_encabezado_formateado,25,"0",STR_PAD_LEFT);
												$sello_qr = substr($sello, -8);

												$rutaQR = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?id=".$uuid."&re=".$traerSucursal['rfc']."&rr=".$traerCliente['rfc']."&tt=".$total_encabezado_formateado."&fe=".$sello_qr;

												echo '<script>window.open("extensiones/tcpdf/examples/factura.php?id_venta='.$id_venta.'", "_blank");</script>';





												/*echo '<script>window.open("extensiones/tcpdf/examples/pdf-ticket-venta.php?id_venta='.$id_venta.'", "_blank");</script>';*/



												$impresora = $traerComputadora['imp_almacen'];

												$conector = new WindowsPrintConnector($impresora);

												$printer = new Printer($conector);

												//$tux = EscposImage::load("vistas/img/perfil_empresa/logo.jpg", false);

												$printer -> setJustification(Printer::JUSTIFY_CENTER);

										//$printer -> bitImage($tux);

												$printer -> text($traerSucursal['nombre']);

												$printer -> feed(1);

												$printer -> text($traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']);

												$printer -> feed(1);

												$printer -> text($traerSucursal['colonia']);

												$printer -> feed(1);

												$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

												$printer -> feed(1);

												$printer -> text($traerSucursal['rfc']);

												$printer -> feed(1);

												$printer -> text("Factura");

												$printer -> feed(1);

												$printer -> setJustification(Printer::JUSTIFY_LEFT);

												$printer -> text("Venta: ".$id_venta);

												$printer -> feed(1);

												$printer -> text("---------------------------------------------");

												$printer -> feed(1);

												$printer -> text("Fecha y hora de emisión: ".$traerVenta['fecha_pago']);

												$printer -> feed(1);

												$printer -> text("No. serie del CSD: ".$traerVenta['certnumber']);

												$printer -> feed(1);

												$printer -> text("Folio Físcal:");

												$printer -> feed(1);

												$printer -> text($traerVenta['uuid']);

												$printer -> feed(2);

												$printer -> text("Cliente: ".$traerCliente['nombre']);

												$printer -> feed(1);

												$printer -> text("RFC: ".$traerCliente['rfc']);

												$printer -> feed(1);

												$printer -> text("Uso del CFDI: ".$traerVentaFinal['id_cfdi']." ".$traerUsoCFDI['descripcion']);

												$printer -> feed(2);

												$printer -> qrCode($rutaQR);

												$printer -> feed(2);

												$printer -> text("---------------------------------------------");

												$printer -> feed(1);

												$printer -> text("Cant/Ubica/Clave/Descripción   C.P   Importe");

												$printer -> feed(1);

												$printer -> text("---------------------------------------------");

												$printer -> feed(1);

												foreach ($traerPartidasVenta as $key => $value) {

													$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

													$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

													$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

													$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

													$importe = $value['cantidad'] * $value['precio_unitario'];
													$impuesto_traslado = $value['cantidad'] * ($value['precio_neto'] - $value['precio_unitario']);

													$base_traslado = $value['cantidad'] * $value['precio_unitario'];

													$printer -> text($value['cantidad']."  ".$traerProducto['ubicacion']."    $".number_format($value["precio_unitario"],2)."   $".number_format($importe, 2));

													$printer -> feed(1);

													$printer -> text($traerProducto['clave_producto']." ".$producto);

													$printer -> feed(1);

													$printer -> text("Clave Prod/Serv: ".$traerProducto['clave_sat']);

													$printer -> feed(1);

													$printer -> text("Traslados:");

													$printer -> feed(1);

													$printer -> text("Base: ".number_format($base_traslado,2)."  Impuesto: 002  Factor: Tasa");

													$printer -> feed(1);

													$printer -> text("Tasa/Cuota: 0.160000  Importe:".number_format($impuesto_traslado,2));

													$printer -> feed(2);
												}

												$subtotal = round(($traerVenta['total'] / 1.16), 2);

												$iva = round($subtotal * 0.16, 2);

												$printer -> feed(1);

												$printer -> text("---------------------------------------------");

												$printer -> feed(1);

												$printer -> text("Subtotal: $".number_format($subtotal, 2));

												$printer -> feed(1);

												$printer -> text("I.V.A (16%): $".number_format($iva, 2));

												$printer -> feed(1);

												$printer -> text("Total: $".number_format($traerVenta["total"],2));

												$printer -> feed(2);

												$printer -> text("Importe con letra: $");

												$printer -> feed(2);

												$printer -> text("Metodo Pago: ".$traerVenta['id_forma_pago']." ".$traerMetodoPago['descripcion']);

												$printer -> feed(1);

												$printer -> text("Forma Pago: ".$traerVenta['id_metodo_pago']." ".$traerFormaPago['descripcion']);

												$printer -> feed(2);

												$printer -> text("Confirmación SAT:");

												$printer -> feed(1);

												$printer -> text("Mensaje SAT:");

												$printer -> feed(2);

												$printer -> text("Sello Digital del CFDI : ".$traerVenta['sello']);

												$printer -> feed(2);

												$printer -> text("Sello del SAT : ".$traerVenta['sello_sat']);

												$printer -> feed(2);

												$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$traerVenta['cadena_timbre']);

												$printer -> feed(2);

												$printer -> text("Fecha y Hora de Certificación : ".$traerVenta['fecha_timbrado']);

												$printer -> feed(2);

												$printer -> setJustification(Printer::JUSTIFY_CENTER);

												$printer -> text("Este Documento es una representación");

												$printer -> feed(1);

												$printer -> text("impresa de un CFDI");

												$printer -> feed(2);

												$printer -> text("FAVOR DE CONSERVAR SU TICKET DE COMPRA");

												$printer -> feed(1);

												$printer -> text("PARA CUALQUIER ACLARACIÓN, GRACIAS.");

												$printer -> feed(2);

												$printer -> text("EN PARTES ELECTRICAS NO HAY CAMBIO");

												$printer -> feed(1);

												$printer -> text("NI DEVOLUCIÓN.");

												$printer -> feed(2);

												$printer -> text("EN PARTES ORIGINALES LA GARANTIA");

												$printer -> feed(1);

												$printer -> text("ES EN LA AGENCIA CORRESPONDIENTE.");

												$printer -> feed(2);

												$printer -> text("DEVOLUCIONES EN EFECTIVO");

												$printer -> feed(1);

												$printer -> text("ÚNICAMENTE EL MISMO DÍA DE SU COMPRA.");

												$printer -> feed(2);

												$printer -> text("*GRACIAS POR SU PREFERENCIA*");


												$printer -> feed(1);

												$printer -> cut();

												$printer -> pulse();

												$printer -> close();
											}



											echo "<script>

											Swal.fire({
												icon: 'success',
												title: 'La venta ha sido timbrada con exito',
												showConfirmButton: true
												}).then(function(result){

													window.location = 'lista-ventas';
													});
													</script>";


												}else{


													$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
													$replace = ' ';

													$texto = str_replace($order, $replace, $codigo_mf_texto);
								//$texto = substr($codigo_mf_texto, 0, 50);

													$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);


													echo "<script>

													Swal.fire({
														icon: 'error',
														title: 'Error no.".$codigo_mf_numero."',
														showConfirmButton: true
														}).then(function(result){
															Swal.fire({
																icon: 'error',
																title: '".$texto."',
																footer: 'No se ha podido timbrar la factura',
																showConfirmButton: true
																})
																});


																</script>";

															}						

														}
													}










}//CONTROLADOR VENTAS
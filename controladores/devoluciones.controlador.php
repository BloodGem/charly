<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorDevoluciones{




	/*=============================================
	MOSTRAR DEVOLUCIONES
	=============================================*/

	static public function ctrMostrarDevoluciones(){


		$respuesta = ModeloDevoluciones::mdlMostrarDevoluciones();

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DEVOLUCION
	=============================================*/

	static public function ctrMostrarDevolucion($id_devolucion){


		$respuesta = ModeloDevoluciones::mdlMostrarDevolucion($id_devolucion);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearDevolucion(){

		if(isset($_POST["idVentaDevolucionSeleccionada"])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_venta = $_POST["idVentaDevolucionSeleccionada"];

			$traerVenta = ModeloVentas::mdlMostrarVenta($id_venta);

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
			
			$id_sucursal = $traerUsuario['id_sucursal'];

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

			$datos = array(
				"id_venta"=>$_POST["idVentaDevolucionSeleccionada"],
				"id_cliente"=>$traerVenta["id_cliente"],
				"productos"=>$_POST["listaProductosDevolucion"],
				"total"=>$_POST["totalDevolucion"],
				"tipo_devolucion"=>$_POST['nuevoTipoDevolucion'],
				"id_motivo_devolucion"=>$_POST["nuevoIdMotivoDevolucion"],
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			$respuesta = ModeloDevoluciones::mdlCrearDevolucion($datos);


			if($respuesta !== "error"){

				$id_devolucion = $respuesta[0];

				$traerDevolucion = ControladorDevoluciones::ctrMostrarDevolucion($id_devolucion);

				$listaProductosDevolucion = json_decode($_POST["listaProductosDevolucion"], true);


				if ($traerVenta["tipo_venta"] == "FC") {

					list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $total_encabezado) = ModeloDevoluciones::mdlTimbrarDevolucion($id_devolucion);

					if($codigo_mf_numero == 0){

						$datosTimbrada = array("id_devolucion"=>$id_devolucion,
							"uuid"=>$uuid,
							"certnumber"=>$certnumber,
							"sello"=>$sello,
							"sello_sat"=>$sello_sat,
							"cadena_timbre"=>$cadena_timbre,
							"no_certificado_sat"=>$no_certificado_sat,
							"fecha_timbrado"=>$fecha_timbrado,
							"ruta"=>$ruta,
							"id_usuario_ult_mod" => $_SESSION['id']);

						ModeloDevoluciones::mdlDevolucionTimbrada($datosTimbrada);
						
						
						
						
						foreach ($listaProductosDevolucion as $key => $value) {

							$cantidad = $value["cantidad"];
							$id_partvta = $value["id_partvta"];
							$id_producto = $value["id_producto"];

							if($cantidad !== "0"){

								$datos = array("id_devolucion"=>$id_devolucion,
									"id_producto"=>$id_producto,
									"cantidad"=>$cantidad,
									"precio_unitario"=>$value["precio_unitario"],
									"descuento"=>$value["descuento"]);



								ModeloPartdev::mdlIngresarPartidasDevolucion($datos);

								$columnaCantDev = "cant_dev";

								$traerPartvta = ModeloPartvta::mdlMostrarPartvta($id_partvta);

								$nuevaCantDev = $traerPartvta["cant_dev"] + $cantidad;

								ModeloPartvta::mdlActualizarPartvta($columnaCantDev, $nuevaCantDev, $id_partvta);

								//AQUI VAMOS A REGRESAR LA CANTIDAD AL STOCK

								$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

								$columnaStock = "stock";

								$nuevoStock =  $cantidad + $traerProductoES["stock"];

								ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);

							//AQUI INGRESAMOS LOS REGISTROS AL KARDEX
								$datosPartidaKardexProductos = array("mo_tipo"=>"DEVOLUCION",
									"mo_refer"=>$id_devolucion,
									"mo_entsal"=>"ENTRADA",
									"id_producto"=>$id_producto,
									"mo_cant"=>$cantidad,
									"mo_pu"=>$value["precio_unitario"],
									"mo_existencias"=>$nuevoStock,
									"id_sucursal"=>$id_sucursal);

								ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);
							}//si la cantidad es diferente de 0
						}//foreach de lsita de productos

						$impresora = $traerComputadora['imp_devoluciones'];

						$conector = new WindowsPrintConnector($impresora);

						$printer = new Printer($conector);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/ticket.png", false);

						$printer -> bitImage($logo);

						$printer -> feed(1);

						$printer -> text($traerSucursal['nombre']);

						$printer -> feed(1);

						$printer -> text($traerSucursal['direccion']);

						$printer -> feed(1);

						$printer -> text($traerSucursal['colonia']);

						$printer -> feed(1);

						$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

						$printer -> feed(1);

						$printer -> text($traerSucursal['rfc']);

						$printer -> feed(1);

						$printer -> text("D E V O L U C I O N");

						$printer -> feed(2);

						$printer->qrCode($id_devolucion, Printer::QR_ECLEVEL_L, 5);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("Devolución: ".$id_devolucion);

						$printer -> feed(1);

						$printer -> text("Venta: ".$id_venta);

						$printer -> feed(1);

						$printer -> text("Folio Venta: ".$traerVenta['folio']);

						$printer -> feed(1);

						$printer -> text("=============================================");

						$printer -> feed(1);


						foreach ($listaProductosDevolucion as $key2 => $value2) {

								$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value2['id_producto']);

								$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $traerProducto['descripcion_corta']);

								$cantidad = $value2["cantidad"];

								if($cantidad !== "0"){

									$total_producto = $value2["cantidad"] * $value2["precio_neto"];

							$printer -> setTextSize(2, 2);

							$printer -> text($value2['cantidad']."  ".$traerProducto['clave_producto']);

							$printer -> feed(1);

							$printer -> setTextSize(1, 1);

							$printer -> text($traerProducto['ubicacion']);

							$printer -> feed(1);

							$printer -> text($producto);

							$printer -> feed(1);

							$printer -> text("$".number_format($value2["precio_neto"],2)."  x  ".$value2['cantidad']."u  =  $".number_format($total_producto,2));

							$printer -> feed(2);

						}

					}
						$printer -> feed(1);

						$printer -> setTextSize(2, 2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer -> text("Total: $".number_format($traerDevolucion["total"],2));

						$printer -> feed(1);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(2);

						$printer -> text("Sello Digital del CFDI : ".$sello);

						$printer -> feed(2);

						$printer -> text("Sello del SAT : ".$sello_sat);

						$printer -> feed(2);

						$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$cadena_timbre);

						$printer -> feed(2);

						$printer -> text("NO. Serie Certificado SAT : ".$no_certificado_sat);

						$printer -> feed(2);

						$printer -> text("Fecha y Hora de Certificación : ".$fecha_timbrado);

						$printer -> feed(2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer -> text("Regrese pronto");

						$printer -> feed(1);

						$printer -> cut();

						$printer -> pulse();

						$printer -> close();








						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La devolucion ha sido generada y timbrada con exito',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'lista-devoluciones';
								});
								</script>";
							}else{

								ModeloDevoluciones::mdlEliminarDevolucion($id_devolucion);

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
								$replace = ' ';

								$texto = str_replace($order, $replace, $codigo_mf_texto);
								//$texto = substr($codigo_mf_texto, 0, 50);

								$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);




								echo "<script>

								Swal.fire({
									icon: 'error',
									title: '".$texto."',
									text: 'Error no.".$codigo_mf_numero."',
									showConfirmButton: false,
									timer: 6000
									}).then(function(result){
										Swal.fire({
											icon: 'error',
											title: 'No se ha  podido generar la devolución',
											showConfirmButton: false,
											timer: 2000
											}).then(function(result){
												window.location = 'crear-devolucion';
												});
												});
												</script>";	
					}//si la devolucion fue generada correctamente
				}//si la devolucion tiene una venta con factura 
				else{



					foreach ($listaProductosDevolucion as $key => $value) {

						$cantidad = $value["cantidad"];
						$id_partvta = $value["id_partvta"];
						$id_producto = $value["id_producto"];

						if($cantidad !== "0"){

							$datos = array("id_devolucion"=>$id_devolucion,
								"id_producto"=>$id_producto,
								"cantidad"=>$cantidad,
								"precio_unitario"=>$value["precio_unitario"],
								"descuento"=>$value["descuento"]);



							ModeloPartdev::mdlIngresarPartidasDevolucion($datos);

							$columnaCantDev = "cant_dev";

							$traerPartvta = ModeloPartvta::mdlMostrarPartvta($id_partvta);

							$nuevaCantDev = $traerPartvta["cant_dev"] + $cantidad;

							ModeloPartvta::mdlActualizarPartvta($columnaCantDev, $nuevaCantDev, $id_partvta);

							//AQUI VAMOS A REGRESAR LA CANTIDAD AL STOCK

							$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

							$columnaStock = "stock";

							$nuevoStock =  $cantidad + $traerProductoES["stock"];

							$respuesta_actualiza_stock = ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);


							//AQUI INGRESAMOS LOS REGISTROS AL KARDEX
							$datosPartidaKardexProductos = array("mo_tipo"=>"DEVOLUCION",
								"mo_refer"=>$id_devolucion,
								"mo_entsal"=>"ENTRADA",
								"id_producto"=>$id_producto,
								"mo_cant"=>$cantidad,
								"mo_pu"=>$value["precio_unitario"],
								"mo_existencias"=>$nuevoStock,
								"id_sucursal"=>$id_sucursal);


							ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);
					}//si la cantidad es diferente de 0
				}//foreach de lsita de productos




				$impresora = $traerComputadora['imp_devoluciones'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/ticket.png", false);

				$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> text($traerSucursal['nombre']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['direccion']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['colonia']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['rfc']);

				$printer -> feed(1);

				$printer -> text("D E V O L U C I O N");

				$printer -> feed(2);

				$printer->qrCode($id_devolucion, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("Devolución: ".$id_devolucion);

				$printer -> feed(1);

				$printer -> text("Venta: ".$id_venta);

				$printer -> feed(1);

				$printer -> text("Folio Venta: ".$traerVenta['folio']);

				$printer -> feed(1);

				$printer -> text("=============================================");

				$printer -> feed(1);

				foreach ($listaProductosDevolucion as $key2 => $value2) {

					$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value2['id_producto']);

					$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $traerProducto['descripcion_corta']);

					$cantidad = $value2["cantidad"];

					if($cantidad !== "0"){

						$total_producto = $value2["cantidad"] * $value2["precio_neto"];

						$printer -> setTextSize(2, 2);

							$printer -> text($value2['cantidad']."  ".$traerProducto['clave_producto']);

							$printer -> feed(1);

							$printer -> setTextSize(1, 1);

							$printer -> text($traerProducto['ubicacion']);

							$printer -> feed(1);

							$printer -> text($producto);

							$printer -> feed(1);

							$printer -> text("$".number_format($value2["precio_neto"],2)."  x  ".$value2['cantidad']."u  =  $".number_format($total_producto,2));

							$printer -> feed(2);

					}
				}

				$printer -> feed(2);

				$printer -> setTextSize(2, 2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> feed(1);

				$printer -> text("Total: $".number_format($traerDevolucion["total"],2));

				$printer -> feed(1);

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
					title: 'La devolucion no.".$id_devolucion." ha sido generada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){

						window.location = 'lista-devoluciones';
						});
						</script>";
				}//si la devolucion no trae una venta con factura
			}//si la devolucion fue generada
		}//ISSET ID_VENTA
	}//CREAR DEVOLUCION
	






















	static public function ctrCrearDevolucionModulo($id_venta, $listaDevolucion, $id_motivo_devolucion){

		if($id_venta !== null && $listaDevolucion !== null && $id_motivo_devolucion !== null && $id_venta !== "" && $listaDevolucion !== "" && $id_motivo_devolucion !== ""){


			$traerVenta = ModeloVentas::mdlMostrarVenta($id_venta);

			$id_sucursal = $traerVenta['id_sucursal'];

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

			$listaProductosDevolucion = json_decode($listaDevolucion, true);

			foreach ($listaProductosDevolucion as $key => $value) {
				$total_devolucion = $value['total'];

						}//foreach de lsita de productos

						$datos = array(
							"id_venta"=>$id_venta,
							"id_cliente"=>$traerVenta["id_cliente"],
							"productos"=>$listaDevolucion,
							"total"=>$total_devolucion,
							"id_motivo_devolucion"=>$id_motivo_devolucion,
							"id_sucursal" => $id_sucursal,
							"id_usuario_creador" => $_SESSION['id']);


						$respuesta = ModeloDevoluciones::mdlCrearDevolucion($datos);



						if($respuesta !== "error"){

							$id_devolucion = $respuesta[0];


							$traerDevolucion = ModeloDevoluciones::mdlMostrarDevolucion($id_devolucion);

							foreach ($listaProductosDevolucion as $key => $value) {

								$cantidad = $value["cantidad"];
								
								$id_partvta = $value["id_partvta"];

								$id_producto = $value["id_producto"];

								if($cantidad !== "0"){

									$datos = array("id_devolucion"=>$id_devolucion,
										"id_producto"=>$id_producto,
										"cantidad"=>$cantidad,
										"precio_unitario"=>$value["precio_unitario"],
										"descuento"=>$value["descuento"]);



									ModeloPartdev::mdlIngresarPartidasDevolucion($datos);


									$traerPartvta = ModeloPartvta::mdlMostrarPartvta($id_partvta);

									$columnaCantDev = "cant_dev";

									$nuevaCantDev = $traerPartvta["cant_dev"] + $cantidad;

									ModeloPartvta::mdlActualizarPartvta($columnaCantDev, $nuevaCantDev, $id_partvta);




									$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

									$columnaStock = "stock";

									$nuevoStock =  $cantidad + $traerProductoES["stock"];

									$respuesta_actualiza_stock = ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);


									//AQUI INGRESAMOS LOS REGISTROS AL KARDEX
									$datosPartidaKardexProductos = array("mo_tipo"=>"DEVOLUCION",
										"mo_refer"=>$id_devolucion,
										"mo_entsal"=>"ENTRADA",
										"id_producto"=>$id_producto,
										"mo_cant"=>$cantidad,
										"mo_pu"=>$value["precio_unitario"],
										"mo_existencias"=>$nuevoStock,
										"id_sucursal"=>$id_sucursal);


									ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);





					}//si la cantidad es diferente de 0
				}//foreach de lsita de productos

				return array($traerVenta, $traerDevolucion, $traerSucursal, $traerProductoES);
			}//si la devolucion fue generada
			else{
				return 0;
			}

			
		}//ISSET ID_VENTA
		
	}//CREAR DEVOLUCION DESDE MODULO








	/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function ctrMostrarNoDevoluciones(){

		$respuesta = ModeloDevoluciones::mdlMostrarNoDevoluciones();

		return $respuesta;

	}







	/*=============================================
	MOSTRAR LA SUMA DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function ctrMostrarSumaDevoluciones(){

		$respuesta = ModeloDevoluciones::mdlMostrarSumaDevoluciones();

		return $respuesta;

	}








	static public function ctrTimbrarDevolucion(){

		if(isset($_POST["timbrarDevolucion"])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_devolucion = $_POST["timbrarDevolucion"];

			$traerDevolucion = ControladorDevoluciones::ctrMostrarDevolucion($id_devolucion);

			$listaProductosDevolucion = json_decode($traerDevolucion["productos"], true);

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerDevolucion['id_sucursal']);

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $total_encabezado) = ModeloDevoluciones::mdlTimbrarDevolucion($id_devolucion);

			if($codigo_mf_numero == 0){

				$datosTimbrada = array("id_devolucion"=>$id_devolucion,
					"uuid"=>$uuid,
					"certnumber"=>$certnumber,
					"sello"=>$sello,
					"sello_sat"=>$sello_sat,
					"cadena_timbre"=>$cadena_timbre,
					"no_certificado_sat"=>$no_certificado_sat,
					"fecha_timbrado"=>$fecha_timbrado,
					"ruta"=>$ruta,
					"id_usuario_ult_mod" => $_SESSION['id']);

				ModeloDevoluciones::mdlDevolucionTimbrada($datosTimbrada);




				$impresora = $traerComputadora['imp_devoluciones'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/ticket.png", false);

				$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> text($traerSucursal['nombre']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['direccion']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['colonia']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

				$printer -> feed(1);

				$printer -> text($traerSucursal['rfc']);

				$printer -> feed(1);

				$printer -> text("D E V O L U C I O N");

				$printer -> feed(2);

				$printer->qrCode($id_devolucion, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("=============================================");

				$printer -> feed(1);

				foreach ($listaProductosDevolucion as $key2 => $value2) {

					$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value2['id_producto']);

					$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $traerProducto['descripcion_corta']);

					$cantidad = $value2["cantidad"];

					if($cantidad !== "0"){

						$total_producto = $value2["cantidad"] * $value2["precio_neto"];

						$printer -> setTextSize(2, 2);

						$printer -> text($value2['cantidad']."  ".$traerProducto['clave_producto']);

						$printer -> feed(1);

						$printer -> setTextSize(1, 1);

						$printer -> text($traerProducto['ubicacion']);

						$printer -> feed(1);

						$printer -> text($producto);

						$printer -> feed(1);

						$printer -> text("$".number_format($value2["precio_neto"],2)."  x  ".$value2['cantidad']."u  =  $".number_format($total_producto,2));

						$printer -> feed(2);

					}
				}

				$printer -> feed(1);

				$printer -> setTextSize(2, 2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("TOTAL: $".number_format($traerDevolucion["total"],2));

				$printer -> feed(1);

				$printer -> setTextSize(1, 1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("=============================================");

				$printer -> feed(2);

				$printer -> text("Sello Digital del CFDI : ".$sello);

				$printer -> feed(2);

				$printer -> text("Sello del SAT : ".$sello_sat);

				$printer -> feed(2);

				$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$cadena_timbre);

				$printer -> feed(2);

				$printer -> text("NO. Serie Certificado SAT : ".$no_certificado_sat);

				$printer -> feed(2);

				$printer -> text("Fecha y Hora de Certificación : ".$fecha_timbrado);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Regrese pronto");

				$printer -> feed(1);

				$printer -> cut();

				$printer -> pulse();

				$printer -> close();








				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La devolucion ha sido generada y timbrada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-devoluciones';
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
							title: '".$texto."',
							text: 'Error no.".$codigo_mf_numero."',
							showConfirmButton: false,
							timer: 6000
							}).then(function(result){
								Swal.fire({
									icon: 'error',
									title: 'No se ha  podido timbrar la devolución',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
										window.location = 'lista-devoluciones';
										});
										});
										</script>";

									}

								}
							}









							static public function ctrActualizarDevolucion($columna, $valor, $id_devolucion, $id_sucursal, $id_usuario_ult_mod){

								$respuesta = ModeloDevoluciones::mdlActualizarDevolucion($columna, $valor, $id_devolucion, $id_sucursal, $id_usuario_ult_mod);

								return $respuesta;

							}




















							static public function ctrReimprimirTicketDevolucion(){

								if(isset($_POST['reimprimir_ticket_devolucion'])){

									$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

									$id_devolucion = $_POST['reimprimir_ticket_devolucion'];

									$traerDevolucion = ControladorDevoluciones::ctrMostrarDevolucion($id_devolucion);

									$total = $traerDevolucion['total'];

									$id_venta = $traerDevolucion['id_venta'];

									$traerVenta = ControladorVentas::ctrMostrarVenta($id_venta);

									$id_sucursal = $traerDevolucion['id_sucursal'];

									$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

									$nombre_usuario = $traerUsuario['nombre'];

									$traerSucursal = ModeloSucursales::mdlMostrarSucursal($id_sucursal);

									$nombre_sucursal = $traerSucursal['nombre'];

									$traerPartidasDevolucion = ModeloPartdev::mdlMostrarPartidasDevolucion($id_devolucion);

		//$traerVendedor = ControladorUsuarios::ctrMostrarUsuario($treaerDevolucion['id_usuario_creador']);


									if($traerDevolucion['uuid'] == ""){
										$impresora = $traerComputadora['imp_devoluciones'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/ticket.png", false);

										$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($traerSucursal['nombre']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> text("D E V O L U C I O N");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_devolucion, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("Devolución: ".$id_devolucion);

										$printer -> feed(1);

										$printer -> text("Venta: ".$id_venta);

										$printer -> feed(1);

										$printer -> text("Folio Venta: ".$traerVenta['folio']);

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										foreach ($traerPartidasDevolucion as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

											$producto = $traerProducto['descripcion_corta'];

											$precio_neto = $value["precio_unitario"]*1.16;
											$total_producto = $value["cantidad"] * $precio_neto;

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> text($producto);

											$printer -> feed(1);

											$printer -> text("$".number_format($precio_neto,2)."  x  ".$value['cantidad']."u  =  $".number_format($total_producto,2));

											$printer -> feed(2);


										}

										$printer -> feed(1);

										$printer -> setTextSize(2, 2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> feed(1);

										$printer -> text("Total: $".number_format($traerDevolucion["total"],2));

										$printer -> feed(1);

										$printer -> setTextSize(1, 1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> pulse();

										$printer -> close();

									}else{

										$impresora = $traerComputadora['imp_devoluciones'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/ticket.png", false);

										$printer -> bitImage($logo);

										$printer -> feed(1);

										$printer -> text($traerSucursal['nombre']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['direccion']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['colonia']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']);

										$printer -> feed(1);

										$printer -> text($traerSucursal['rfc']);

										$printer -> feed(1);

										$printer -> text("D E V O L U C I O N");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer->qrCode($id_devolucion, Printer::QR_ECLEVEL_L, 5);

										$printer -> feed(1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("Devolución: ".$id_devolucion);

										$printer -> feed(1);

										$printer -> text("Venta: ".$id_venta);

										$printer -> feed(1);

										$printer -> text("Folio Venta: ".$traerVenta['folio']);

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(1);

										foreach ($traerPartidasDevolucion as $key => $value) {

											$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

											$producto = $traerProducto['descripcion_corta'];

											$precio_neto = $value["precio_unitario"]*1.16;

											$total_producto = $value["cantidad"] * $precio_neto;

											$printer -> setTextSize(2, 2);

											$printer -> text($value['cantidad']."  ".$traerProducto['clave_producto']);

											$printer -> feed(1);

											$printer -> setTextSize(1, 1);

											$printer -> text($traerProducto['ubicacion']);

											$printer -> feed(1);

											$printer -> text($producto);

											$printer -> feed(1);

											$printer -> text("$".number_format($precio_neto,2)."  x  ".$value['cantidad']."u  =  $".number_format($total_producto,2));

											$printer -> feed(2);

										}

										$printer -> feed(1);

										$printer -> setTextSize(2, 2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("TOTAL: $".number_format($traerDevolucion["total"],2));

										$printer -> feed(1);

										$printer -> setTextSize(1, 1);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(2);

										$printer -> text("Sello Digital del CFDI : ".$traerDevolucion["sello"]);

										$printer -> feed(2);

										$printer -> text("Sello del SAT : ".$traerDevolucion["sello_sat"]);

										$printer -> feed(2);

										$printer -> text("Cadena Original del Complemento de Certficación Digital del SAT : ".$traerDevolucion["cadena_timbre"]);

										$printer -> feed(2);

										$printer -> text("NO. Serie Certificado SAT : ".$traerDevolucion["no_certificado_sat"]);

										$printer -> feed(2);

										$printer -> text("Fecha y Hora de Certificación : ".$traerDevolucion["fecha_timbrado"]);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("Regrese pronto");

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
					window.location = 'lista-devoluciones';
					});
					</script>";


				}

			}











		}




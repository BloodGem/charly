<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorCotizaciones{




	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function ctrMostrarCotizaciones(){

		

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones();

		return $respuesta;

	}


	/*=============================================
	MOSTRAR COTIZACIONES FILTRO
	=============================================*/

	static public function ctrMostrarCotizaciones2($columna, $valor){

		

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones2($columna, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function ctrMostrarCotizacion($id_cotizacion){

		$respuesta = ModeloCotizaciones::mdlMostrarCotizacion($id_cotizacion);

		return $respuesta;

	}
	










	/*=============================================
	CREAR VENTA
	=============================================*/

	/*static public function ctrCrearCotizacion(){

		$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

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



		if(isset($_POST["listaProductosCotizacion"])){

			if($_POST["listaProductosCotizacion"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'La cotizacion no tiene productos',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
				}


				$id_usuario = $_SESSION['id'];

				$id_cliente = $_POST["nuevoIdCliente2"];

				$traerCliente = ControladorClientes::ctrMostrarCliente($id_cliente);

				$id_sucursal_actual = $_SESSION['id_sucursal_actual'];

				$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
				
				$nombre_usuario = $traerUsuario['nombre'];
				
				




				$listaProductosCotizacion = $_POST["listaProductosCotizacion"];
				$totalCotizacion = $_POST["totalCotizacion"];

				$datos = array("id_cliente"=>$id_cliente,
					"productos"=>$listaProductosCotizacion,
					"total"=>$totalCotizacion,
					"id_sucursal"=>$id_sucursal_actual,
					"id_usuario_creador" => $id_usuario);


				$respuesta = ModeloCotizaciones::mdlIngresarCotizacion($datos);



				if($respuesta !== "error"){

					$id_cotizacion = $respuesta[0];

					$traerCotizacion = ControladorCotizaciones::ctrMostrarCotizacion($id_cotizacion);

					$traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerCotizacion['id_sucursal']);

					$listaProductosCotizacion = json_decode($traerCotizacion['productos'], true);




					if($id_cliente == 1){

						if($_POST['envia_celular'] !== ""){
							$celular = $_POST['envia_celular'];

							$mensaje = "Cotización no.*".$id_cotizacion."*
";
							foreach ($listaProductosCotizacion as $key3 => $value3) {

								$traerProducto3 = ControladorProductos::ctrMostrarProducto($value3['id']);

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

						$producto3= str_replace($order, $replace, $traerProducto3['descripcion_corta']);

						$producto3 = preg_replace("/[\r\n|\n|\r]+/", " ", $producto3);


$mensaje = $mensaje.$producto3." $".number_format($value3["precio"],2)." Und x ".$value3["cantidad"]." = *$".number_format($value3["total"],2)."*
";

							}

$mensaje = $mensaje."Total = *$".number_format($traerCotizacion["total"],2)."*";

							ControladorGlobal::ctrEnviarMensaje($mensaje, $celular);


						}
					}else{

						if($_POST['envia_celular'] !== ""){
							$celular = $_POST['envia_celular'];
							ModeloClientes::mdlActualizarCliente("telefono1", $celular, $id_cliente, $_SESSION['id']);
							
						}else{
							$celular = $traerCliente['telefono1'];
						}
						

						$mensaje = "Cotización no.*".$id_cotizacion."*
";
							foreach ($listaProductosCotizacion as $key3 => $value3) {

								$traerProducto3 = ControladorProductos::ctrMostrarProducto($value3['id']);

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

						$producto3= str_replace($order, $replace, $traerProducto3['descripcion_corta']);

						$producto3 = preg_replace("/[\r\n|\n|\r]+/", " ", $producto3);


$mensaje = $mensaje.$producto3." $".number_format($value3["precio"],2)." Und x ".$value3["cantidad"]." = *$".number_format($value3["total"],2)."*
";

							}

$mensaje = $mensaje."Total = *$".number_format($traerCotizacion["total"],2)."*";

							ControladorGlobal::ctrEnviarMensaje($mensaje, $celular);

					}





					$fecha_hora_ticket = date('d-m-Y H:i:s a');

									
					$impresora = $traerComputadora['imp_cotizaciones'];

						$conector = new WindowsPrintConnector($impresora);

						$printer = new Printer($conector);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/ticket.png", false);

						$printer -> bitImage($logo);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("*********************");

						$printer -> feed(1);

						$printer -> text("*C O T I Z A C I O N*");

						$printer -> feed(1);

						$printer -> text("*********************");

						$printer -> feed(1);

						$printer -> text($dia_texto.", ".$fecha_hora_ticket);

						$printer -> feed(2);

						$printer -> text("Atendido por: ".$nombre_usuario);

						$printer -> feed(2);

						$printer -> setJustification(Printer::JUSTIFY_CENTER);

						$printer->qrCode($id_cotizacion, Printer::QR_ECLEVEL_L, 5);

						$printer -> feed(1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(1);

						foreach ($listaProductosCotizacion as $key => $value) {

							$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

							$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $traerProducto['descripcion_corta']);

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

						$printer -> text("Total: $".number_format($traerCotizacion["total"],2));

						$printer -> feed(2);

						$printer -> setTextSize(1, 1);

						$printer -> setJustification(Printer::JUSTIFY_LEFT);

						$printer -> text("=============================================");

						$printer -> feed(1);

						$printer -> text("Este NO es un ticket de venta, precios sujetos a cambio sin previo aviso");

						$printer -> feed(1);

						$printer -> cut();

						$printer -> pulse();

						$printer -> close();

					

					echo "<script>


					Swal.fire({
						icon: 'success',
						title: 'La cotizacion no.".$id_cotizacion." ha sido generada con exito',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'crear-cotizacion';
							});
							</script>";
						}else{
							echo"<script>
							Swal.fire({
								icon: 'error',
								title: 'Ooh Ooh, algo salio mal ',
								showConfirmButton: false,
								timer: 2000
								});
								</script>";

							}
		}//ISSET LISTA PRODUCTOS

	}//CREAR VENTA*/




















	static public function ctrCrearCotizacion(){

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



		if(isset($_POST["listaProductosCotizacion"])){

			if($_POST["listaProductosCotizacion"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'Esta cotización no tiene productos',
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

				$id_cliente = $_POST["nuevoIdCliente2"];





				if($_POST['nuevoNombreClienteTicket'] !== ""){

					$nombre_cliente = $_POST['nuevoNombreClienteTicket'];

				}else{
					$traerCliente = ControladorClientes::ctrMostrarCliente($_POST["nuevoIdCliente2"]);
					$nombre_cliente = $traerCliente['nombre'];
				}

				

				if($_POST["enviaCelular"] != "" && $id_cliente != 1){
					ControladorClientes::ctrActualizarCliente("telefono1", $_POST["enviaCelular"], $id_cliente, $_SESSION['id']);
				}

				



				$listaProductosCotizacion = $_POST["listaProductosCotizacion"];
				$totalCotizacion = $_POST["totalCotizacion"];

				$datos = array(
					"id_cliente"=>$id_cliente,
					"nombre"=>$nombre_cliente,
					"celular"=>$_POST["enviaCelular"],
					"productos"=>$listaProductosCotizacion,
					"total"=>$totalCotizacion,
					"id_sucursal"=>$id_sucursal,
					"id_vendedor" => $id_vendedor);

				/*var_dump($datos);
				return;*/

				$respuesta = ModeloCotizaciones::mdlIngresarCotizacion($datos);



				if($respuesta !== "error"){

					$id_cotizacion = $respuesta[0];




					if($id_cliente == 1){

								if($_POST["enviaCelular"] != ""){

									$celular = $_POST["enviaCelular"];

									echo '<script>window.open("extensiones/tcpdf/examples/pdf-ticket-cotizacion.php?id_venta='.$id_venta.'&celular='.$celular.'", "_blank");</script>';


								}
							}else{

								$celular = $traerCliente['telefono1'];
								
								
								echo '<script>window.open("extensiones/tcpdf/examples/pdf-ticket-cotizacion.php?id_venta='.$id_venta.'&celular='.$celular.'", "_blank");</script>';

							}






					$listaProductos = json_decode($_POST["listaProductosCotizacion"], true);

					$traerVendedor = ControladorVendedores::ctrMostrarVendedor2($id_vendedor);

					$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

					$traerEstado = ControladorOtros::ctrMostrarEstados("id_estado", $traerSucursal['id_estado']);

					date_default_timezone_set('America/Mazatlan');
					$fecha_hora = date('d-m-Y h:i:s a');

					$impresora = $traerComputadora['imp_cotizaciones'];

					$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

							$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/ticket.png", false);

							$printer -> bitImage($logo);

								$printer -> feed(1);

								$printer -> text($traerSucursal['nombre']);

								$printer -> feed(1);

								$printer -> text($traerSucursal['direccion']);

								$printer -> feed(1);

								$printer -> text($traerSucursal['colonia']);

								$printer -> feed(1);

								$printer -> text($traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerEstado['nomenclatura']);

								$printer -> feed(1);

								$printer -> text($traerSucursal['rfc']);

								$printer -> feed(2);

								$printer -> text("COTIZACIÓN");

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text($dia_texto.", ".$fecha_hora);

								$printer -> feed(2);

								$printer -> text("Atendido por: ".$traerVendedor['nombres']);

								$printer -> feed(1);

								$printer -> text("Cliente: ".$nombre_cliente);

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer->qrCode($id_cotizacion, Printer::QR_ECLEVEL_L, 5);

								$printer -> feed(1);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("=============================================");

								$printer -> feed(1);

								foreach ($listaProductos as $key => $value) {

									$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($value['id'], $id_sucursal);

									$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

									$producto= str_replace($order, $replace, $traerProductoES['descripcion_corta']);

									$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

									$printer -> setTextSize(2, 2);

									$printer -> text($value['cantidad']."  ".$traerProductoES['clave_producto']);

									$printer -> feed(1);

									$printer -> setTextSize(1, 1);

									$printer -> text($traerProductoES['ubicacion']);

									$printer -> feed(1);

									$printer -> text($producto);

									$printer -> feed(1);

									$printer -> text("$".number_format($value["precio"],2)."  x  ".$value['cantidad']."u  =  $".number_format($value["total"],2));

									$printer -> feed(2);
								}

								$printer -> feed(1);

								$printer -> setTextSize(2, 2);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text("Total: $".number_format($totalCotizacion,2));

								$printer -> feed(1);

								$printer -> setTextSize(1, 1);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("=============================================");

								$printer -> feed(2);

								$printer -> text("Este NO es un ticket de venta, precios sujetos a cambio sin previo aviso");

								$printer -> feed(1);

								$printer -> cut();

								$printer -> pulse();

								$printer -> close();
					
					

					echo "<script>


					Swal.fire({
						icon: 'success',
						title: 'La cotización no.".$id_cotizacion." ha sido generada con éxito',
						showConfirmButton: false,
						timer: 1000
						}).then(function(result){
							window.location = 'crear-cotizacion';
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



}
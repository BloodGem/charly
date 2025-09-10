<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorGarantias{




	/*=============================================
	MOSTRAR DEVOLUCIONES
	=============================================*/

	static public function ctrMostrarGarantias(){


		$respuesta = ModeloGarantias::mdlMostrarGarantias();

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DEVOLUCION
	=============================================*/

	static public function ctrMostrarGarantia($id_garantia){


		$respuesta = ModeloGarantias::mdlMostrarGarantia($id_garantia);

		return $respuesta;

	}





	static public function ctrActualizarGarantia($columna, $valor, $id_garantia, $id_sucursal, $id_usuario_ult_mod){

		$respuesta = ModeloGarantias::mdlActualizarGarantia($columna, $valor, $id_garantia, $id_sucursal, $id_usuario_ult_mod);

		return $respuesta;

	}





	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearGarantiaVenta(){

		if(isset($_POST["nuevoIdVentaGarantia"])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_venta = $_POST["nuevoIdVentaGarantia"];

			$id_producto = $_POST["nuevoIdProductoVentaSeleccionado"];

			$cantidad = $_POST["nuevaCantidadProductoVentaSeleccionado"];

			$total = $_POST["nuevaCantidadProductoVentaSeleccionado"] * $_POST["nuevoPrecioNetoProductoVentaSeleccionado"];

			$nombre_cliente = $_POST["nuevoNombreCliente"];

			$precio = $_POST["nuevoPrecioNetoProductoVentaSeleccionado"];

			$fecha_probable = $_POST["nuevaFechaProbable1"];

			$traerVenta = ModeloVentas::mdlMostrarVenta($id_venta);

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$id_sucursal = $traerVenta['id_sucursal'];

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

			

			$datos = array(
				"id_venta"=>$id_venta,
				"id_cliente"=>$traerVenta["id_cliente"],
				"nombre_cliente"=>$nombre_cliente,
				"id_producto"=>$id_producto,
				"cantidad"=>$cantidad,
				"precio"=>$precio,
				"total"=>$total,
				"descripcion_falla"=>$_POST["nuevaDescripcionFalla1"],
				"fecha_probable"=>$fecha_probable,
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $id_usuario);

			//var_dump($datos);

			$respuesta = ModeloGarantias::mdlCrearGarantiaVenta($datos);


			if($respuesta !== "error"){

				$id_garantia = $respuesta[0];

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

				$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

				$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

				$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

				for ($i = 1; $i < 3; $i++) {

				$impresora = $traerComputadora['imp_garantias'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				//$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/logo.png", false);

				//$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> text("** G A R A N T I A **");

				$printer -> feed(2);

				$printer -> text("* ".$nombre_cliente." *");

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text($dia_texto.", ".$fecha_hora_ticket);

				$printer -> feed(2);

				$printer -> text("Atendido por: ".$traerUsuario['nombre']);

				$printer -> feed(1);

				$printer -> text("Venta: ".$id_venta);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer->qrCode($id_garantia, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("Fecha Aprox. de Entrega: ".$fecha_probable);

				$printer -> feed(1);

				$printer -> text("=============================================");

				$printer -> feed(1);

				$printer -> setTextSize(2, 2);

				$printer -> text($cantidad."  ".$traerProducto['clave_producto']);

				$printer -> feed(1);

				$printer -> setTextSize(1, 1);

				$printer -> text($traerProducto['ubicacion']);

				$printer -> feed(1);

				$printer -> text($producto);

				$printer -> feed(1);

				$printer -> text("$".$precio."  x  ".$value['cantidad']."u  =  $".$total);

				$printer -> feed(2);

				$printer -> setTextSize(2, 2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Total: $".$total);

				$printer -> feed(4);

				$printer -> setTextSize(1, 1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("______________________________________________");

				$printer -> feed(1);

				$printer -> text("       Nombre y Firma de quien Recibe");

				$printer -> feed(2);

				$printer -> text("FAVOR DE CONSERVAR ESTE TICKET PARA");

				$printer -> feed(1);

				$printer -> text("CUALQUIER ACLARACION, GRACIAS.");

				$printer -> feed(1);

				$printer -> text("=============================================");

				$printer -> feed(1);

				$printer -> cut();

				$printer -> close();

			}

				$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$columnaEnGarantia = "en_garantia";
				$nuevoEnGarantia =  $traerProductoES["en_garantia"] + $cantidad;

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaEnGarantia, $nuevoEnGarantia, $id_producto, $id_sucursal, $id_usuario);

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La garantia ha sido generada',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-garantias';
						});
						</script>";

			}///si la garantia fue generada
		}//ISSET ID_VENTA
	}//CREAR DEVOLUCION










	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearGarantiaCompra(){

		if(isset($_POST["nuevoIdCompraGarantia"])){

			$id_compra = $_POST["nuevoIdCompraGarantia"];

			$total = $_POST["nuevaCantidadProductoCompraSeleccionado"] * $_POST["nuevoPrecioNetoProductoCompraSeleccionado"];

			$id_producto = $_POST["nuevoIdProductoCompraSeleccionado"];

			$cantidad = $_POST["nuevaCantidadProductoCompraSeleccionado"];

			$traerCompra = ModeloCompras::mdlMostrarCompra($id_compra);

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$id_sucursal = $traerCompra['id_sucursal'];

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

			

			$datos = array(
				"id_compra"=>$id_compra,
				"id_proveedor"=>$traerCompra["id_proveedor"],
				"id_producto"=>$id_producto,
				"cantidad"=>$cantidad,
				"precio"=>$_POST["nuevoPrecioNetoProductoCompraSeleccionado"],
				"total"=>$total,
				"descripcion_falla"=>$_POST["nuevaDescripcionFalla1"],
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $id_usuario);

			//var_dump($datos);

			$respuesta = ModeloGarantias::mdlCrearGarantiaCompra($datos);


			if($respuesta !== "error"){

				$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$columnaEnGarantia = "en_garantia";
				$nuevoEnGarantia =  $traerProductoES["en_garantia"] + $cantidad;

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaEnGarantia, $nuevoEnGarantia, $id_producto, $id_sucursal, $id_usuario);

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La garantia ha sido generada',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-garantias';
						});
						</script>";

			}///si la garantia fue generada
		}//ISSET ID_VENTA
	}//CREAR DEVOLUCION
	
	
	
	
	
	
	
	
	
	static public function ctrAutorizarGarantia(){

		if(isset($_POST["autorizarGarantia"])){

			$id_garantia = $_POST["autorizarGarantia"];

			$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$datos = array(
				"id_garantia"=>$id_garantia,
				"quien_autoriza"=>$_POST["quienAutoriza"],
				"id_usuario_autoriza" => $id_usuario);

			$respuesta = ModeloGarantias::mdlAutorizarGarantia($datos);


			if($respuesta !== "error"){




				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La garantia no.".$id_garantia." ha sido autorizada',
					showConfirmButton: true
					}).then(function(result){

						window.location = 'lista-garantias';
						});
						</script>";
			}//si la garantia fue generada
			else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'No se ha podido autorizar la garantia',
					showConfirmButton: true
					});
					</script>";
				}
		}//ISSET ID_GARANTIA
	}//AUTORIZAR GARANTIA









	static public function ctrConfirmarGarantia(){

		if(isset($_POST["confirmarGarantia"])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_garantia = $_POST["confirmarGarantia"];

			$tipo_cambio = $_POST["tipoCambio"];

			$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

			$id_sucursal = $traerGarantia['id_sucursal'];

			$id_producto = $traerGarantia['id_producto'];

			$cantidad = $traerGarantia['cantidad'];

			$precio = $traerGarantia['precio'];

			$nombre_cliente = $traerGarantia['nombre_cliente'];

			$total = $traerGarantia['total'];

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$datos = array(
				"id_garantia"=>$id_garantia,
				"tipo_cambio"=>$tipo_cambio,
				"id_usuario_confirma" => $id_usuario);

			//var_dump($datos);

			$respuesta = ModeloGarantias::mdlConfirmarGarantia($datos);

			//var_dump($respuesta);

			if($respuesta !== "error"){

				if($tipo_cambio == 1){

					$texto_tipo_cambio = "CON CAMBIO FISICO";

					$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

					$columnaStock = "stock";
					$nuevoStock =  $traerProductoES["stock"] - $cantidad;

					ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $id_usuario);


					$datosPartidaKardexProductos = array("mo_tipo"=>"GARANTIA",
						"mo_refer"=>$id_garantia,
						"mo_entsal"=>"SALIDA",
						"id_producto"=>$id_producto,
						"mo_cant"=>$cantidad,
						"mo_pu"=>$precio,
						"mo_existencias"=>$nuevoStock,
						"id_sucursal"=>$id_sucursal);

					list($respuestaKP, $errorKP) = ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);
				}else{
					$texto_tipo_cambio = "CON CAMBIO EN EFECTIVO";
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

				$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");

				$producto= str_replace($order, $replace, $traerProducto['descripcion_corta']);

				$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $producto);

				$impresora = $traerComputadora['imp_garantias'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				//$logo = EscposImage::load("C:/xampp/htdocs/charly/vistas/img/perfil_empresa/logo.png", false);

				//$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> text("VALIDACION DE GARANTIA'");

				$printer -> feed(1);

				$printer -> text("** ".$texto_tipo_cambio." **");

				$printer -> feed(1);

				$printer -> text("* ".$nombre_cliente." *");

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text($dia_texto.", ".$fecha_hora_ticket);

				$printer -> feed(2);

				$printer -> text("Atendido por: ".$traerUsuario['nombre']);

				$printer -> feed(1);

				$printer -> text("Venta: ".$id_venta);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer->qrCode($id_garantia, Printer::QR_ECLEVEL_L, 5);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("=============================================");

				$printer -> feed(1);

				$printer -> setTextSize(2, 2);

				$printer -> text($cantidad."  ".$traerProducto['clave_producto']);

				$printer -> feed(1);

				$printer -> setTextSize(1, 1);

				$printer -> text($traerProducto['ubicacion']);

				$printer -> feed(1);

				$printer -> text($producto);

				$printer -> feed(1);

				$printer -> text("$".$precio."  x  ".$cantidad."u  =  $".$total);

				$printer -> feed(2);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Total: $".$total);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("=============================================");

				$printer -> feed(1);

				$printer -> cut();

				$printer -> close();


				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La garantia no.".$id_garantia." ha sido confirmada',
					showConfirmButton: true
					}).then(function(result){

						window.location = 'lista-garantias';
						});
						</script>";
			}//si la garantia fue generada
			else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'No se ha podido confirmar la garantia',
					showConfirmButton: true
					});
					</script>";
				}
		}//ISSET ID_GARANTIA
	}//AUTORIZAR GARANTIA










	static public function  ctrEditarGarantiaProveedor(){

		if(isset($_POST["editarGarantiaProveedor"])){

			$id_garantia = $_POST["editarGarantiaProveedor"];

			$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$datos = array(
				"id_garantia"=>$id_garantia,
				"fecha_envio"=>$_POST["editarFechaEnvio"],
				"fecha_regreso"=>$_POST["editarFechaRegreso"],
				"valida_garantia"=>$_POST["editarValidaGarantia"],
				"observaciones"=>$_POST["editarObservaciones"],
				"id_usuario_ult_mod" => $id_usuario);

			$respuesta = ModeloGarantias::mdlEditarEnvioProductosProveedor($datos);


			if($respuesta !== "error"){




				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'Los datos se han guardado',
					showConfirmButton: true
					}).then(function(result){

						window.location = 'lista-garantias';
						});
						</script>";
			}//si la garantia fue generada
			else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'No se ha podido guardar la información',
					showConfirmButton: true
					});
					</script>";
				}
		}//ISSET ID_GARANTIA
	}//AUTORIZAR GARANTIA










	static public function ctrConfirmar2Garantia(){

		if(isset($_POST["confirmar2Garantia"])){

			$id_garantia = $_POST["confirmar2Garantia"];

			$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

			$valida_garantia = $traerGarantia['valida_garantia'];

			$id_sucursal = $traerGarantia['id_sucursal'];

			$id_producto = $traerGarantia['id_producto'];

			$cantidad = $traerGarantia['cantidad'];

			$precio = $traerGarantia['precio'];

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
			
			$datos = array(
				"id_garantia"=>$id_garantia,
				"id_usuario_confirma2" => $id_usuario);

			$respuesta = ModeloGarantias::mdlConfirmar2Garantia($datos);


			if($respuesta !== "error"){


				if($valida_garantia == 1){

					
					$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);


					$columnaStock = "stock";
					$nuevoStock =  $traerProductoES["stock"] + $cantidad;

					$r1 = ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $id_usuario);





					$datosPartidaKardexProductos = array("mo_tipo"=>"GARANTIA",
						"mo_refer"=>$id_garantia,
						"mo_entsal"=>"ENTRADA",
						"id_producto"=>$id_producto,
						"mo_cant"=>$cantidad,
						"mo_pu"=>$precio,
						"mo_existencias"=>$nuevoStock,
						"id_sucursal"=>$id_sucursal);


					list($respuestaKP, $errorKP) = ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);


				}


				$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$columnaEnGarantia = "en_garantia";

				$nuevoEnGarantia =  $traerProductoES["en_garantia"] - $cantidad;


				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaEnGarantia, $nuevoEnGarantia, $id_producto, $id_sucursal, $id_usuario);


				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La garantia no.".$id_garantia." ha sido confirmada',
					showConfirmButton: true
					}).then(function(result){

						window.location = 'lista-garantias';
						});
						</script>";
			}//si la garantia fue generada
			else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'No se ha podido confirmar la garantia',
					showConfirmButton: true
					});
					</script>";
				}
		}//ISSET ID_GARANTIA
	}//AUTORIZAR GARANTIA






}




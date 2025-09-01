<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPedidos{


	 

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarPedidos($columna, $valor){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlMostrarPedidos($tabla, $columna, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR VENTA CLIENTE
	=============================================*/

	static public function ctrMostrarPedidoCliente($valor1){

		$respuesta = ModeloPedidos::mdlMostrarPedidoCliente($valor1);

		return $respuesta;

	}

	static public function ctrMostrarPedidoCobro($valor1){

		$respuesta = ModeloPedidos::mdlMostrarPedidoCobro($valor1);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearPedido(){

		if(isset($_POST["listaProductos"])){

			if($_POST["listaProductos"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'El pedido no tiene productos a venderse',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
				}


				if($_POST['nuevoTipoPedido'] == "NT"){

					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoPedido']);

					$folio = $_POST['nuevoTipoPedido']."-".$respuestaFolio[0];

				}elseif ($_POST['nuevoTipoPedido'] == "RM") {

					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoPedido']);

					$folio = $_POST['nuevoTipoPedido']."-".$respuestaFolio[0];

				}
				elseif ($_POST['nuevoTipoPedido'] == "FC") {
					
					$respuestaFolio = ModeloOtros::mdlIncrementarFolio($_POST['nuevoTipoPedido']);

					$folio = $_POST['nuevoTipoPedido']."-".$respuestaFolio[0];

				}
			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "pedidos";

			$datos = array("folio"=>$folio,
				"id_vendedor"=>$_POST["nuevoIdVendedor"],
				"id_cliente"=>$_POST["nuevoIdCliente2"],
				"productos"=>$_POST["listaProductos"],
				"total"=>$_POST["totalPedido"],
				"tipo_pedido"=>$_POST["nuevoTipoPedido"]);

			$respuesta = ModeloPedidos::mdlIngresarPedido($tabla, $datos);


			if($respuesta !== "error"){

				$id_pedido = $respuesta[0];

				$listaProductos = json_decode($_POST["listaProductos"], true);

				$totalProductosComprados = array();

				foreach ($listaProductos as $key => $value) {

					






					array_push($totalProductosComprados, $value["cantidad"]);

					$tablaProductos = "productos";

					$columna = "id_producto";
					$valor = $value["id"];


					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $columna, $valor);

					$columna1a = "no_pedidos";
					$valor1a = $value["cantidad"] + $traerProducto["no_pedidos"];

					$nuevasPedidos = ModeloProductos::mdlActualizarProducto($tablaProductos, $columna1a, $valor1a, $valor);

					$columna1b = "stock";
					$valor1b =  $traerProducto["stock"] - $value["cantidad"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $columna1b, $valor1b, $valor);


					$traerProductoSucursal = ModeloExistenciasSucursales::mdlMostrarProductoSucursal($valor);

					$nuevoStockSucursal =  $traerProductoSucursal["stock"] - $value["cantidad"];

					ModeloExistenciasSucursales::mdlActualizarExistencias($nuevoStockSucursal, $valor);

				}

				$tablaClientes = "clientes";

				$columna = "id_cliente";
				$valor = $_POST["nuevoIdCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $columna, $valor);

				$columna1a = "no_compras";
				
				$valor1a = 1 + $traerCliente["no_compras"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $columna1a, $valor1a, $valor);

				$columna1b = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha.' '.$hora;

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $columna1b, $valor1b, $valor);



				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El pedido no.".$id_pedido." ha sido generado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-pedidos';
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








	/*=============================================
	MOSTRAR EL NUMERO DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function ctrMostrarNoPedidos(){

		$respuesta = ModeloPedidos::mdlMostrarNoPedidos();

		return $respuesta;

	}







	/*=============================================
	MOSTRAR LA SUMA DE VENTAS, ES PARA EL DASHBOARD
	=============================================*/

	static public function ctrMostrarSumaPedidos(){

		$respuesta = ModeloPedidos::mdlMostrarSumaPedidos();

		return $respuesta;

	}






	/*=============================================
	Aplicar pago
	=============================================*/

	static public function ctrAplicarPago(){

		if(isset($_POST["mostrarIdPedido"])){

			$traerPedido = ModeloPedidos::mdlMostrarPedidoCliente($_POST['mostrarIdPedido']);

			

				if($_POST["nuevoIdFormaPagoCobro"] == "PPD"){
					$saldo_actual = $traerPedido['total'];
				}

				$datos = array("id"=>$_POST["mostrarIdPedido"],
					"saldo_actual"=>$saldo_actual,
					"efectivo"=>$_POST["nuevoImporteEfectivo"],
					"tarjeta_debido"=>$_POST["nuevoImporteTarjetaDebito"],
					"tarjeta_credito"=>$_POST["nuevoImporteTarjetaCredito"],
					"transferencia"=>0,
					"cambio"=>$_POST["nuevoCambioCobro"],
					"id_forma_pago"=>$_POST["nuevoIdFormaPagoCobro"],
					"id_cfdi"=>$_POST["nuevoIdCfdiCobro"],
					"id_metodo_pago"=>$_POST["nuevoIdMetodoPagoCobro"]);

				$respuesta = ModeloPedidos::mdlAplicarPago($datos);

				if($respuesta == 'ok'){

					if ($traerPedido["tipo_pedido"] == "FC") {

					$timbrarPedido = ModeloPedidos::mdlTimbrarPedido($traerPedido['id'], $traerPedido['productos']);

					if($timbrarPedido == '[MODO PRUEBAS] OK'){
					ModeloPedidos::mdlPedidoTimbrada($traerPedido['id']);


						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La pedido ha sido pagada y timbrada con exito',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'cobro';
								});
								</script>";

							}else{

								echo "<script>

								Swal.fire({
									icon: 'error',
									title: '".$timbrarPedido."',
									showConfirmButton: false,
									timer: 6000
									}).then(function(result){
										Swal.fire({
									icon: 'success',
									title: 'La pedido ha sido pagada con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
								window.location = 'cobro';
								});
										});
										</script>";	

									}
								}else{
									echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La pedido ha sido pagada con exito',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'cobro';
								});
								</script>";
								}
								}
			
								}

							}



static public function ctrTimbrarPedido($valor1){

	$timbrarPedido = ModeloPedidos::mdlTimbrarPedido($valor1);

					if($timbrarPedido == '[MODO PRUEBAS] OK'){

						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La pedido ha sido pagada y timbrada con exito',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'cobro';
								});
								</script>";

							}else{

								echo "<script>

								Swal.fire({
									icon: 'error',
									title: '".$timbrarPedido."',
									showConfirmButton: false,
									timer: 6000
									}).then(function(result){
										Swal.fire({
									icon: 'success',
									title: 'La pedido ha sido pagada con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
								window.location = 'cobro';
								});
										});
										</script>";	

									}

}

}




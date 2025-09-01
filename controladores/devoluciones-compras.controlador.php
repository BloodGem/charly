<?php



class ControladorDevolucionesCompras{




	/*=============================================
	MOSTRAR DEVOLUCIONES
	=============================================*/

	static public function ctrMostrarDevolucionesCompras(){


		$respuesta = ModeloDevoluciones::mdlMostrarDevoluciones();

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DEVOLUCION
	=============================================*/

	static public function ctrMostrarDevolucionCompra($id_devolucion_compra){


		$respuesta = ModeloDevolucionesCompras::mdlMostrarDevolucionCompra($id_devolucion_compra);

		return $respuesta;

	}










	static public function ctrActualizarDevolucion($columna, $valor, $id_devolucion, $id_sucursal, $id_usuario_ult_mod){

		$respuesta = ModeloDevoluciones::mdlActualizarDevolucion($columna, $valor, $id_devolucion, $id_sucursal, $id_usuario_ult_mod);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearDevolucionCompra(){

		if(isset($_POST["idCompraDevolucionSeleccionada"])){

			$id_compra = $_POST["idCompraDevolucionSeleccionada"];
			$total_devolucion = $_POST["totalDevolucion"];


			$traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);

			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);
			
			$id_sucursal = $traerCompra['id_sucursal'];

			$traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);



			$datos = array(
				"id_compra"=>$id_compra,
				"id_proveedor"=>$traerCompra["id_proveedor"],
				"productos"=>$_POST["listaProductosDevolucion"],
				"total"=>$total_devolucion,
				"id_motivo_devolucion_compra"=>$_POST["nuevoIdMotivoDevolucion"],
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datos);

			$respuesta = ModeloDevolucionesCompras::mdlCrearDevolucionCompra($datos);


			if($respuesta !== "error"){

				$id_devolucion_compra = $respuesta[0];

				//var_dump($id_devolucion_compra);

				$traerDevolucion = ControladorDevolucionesCompras::ctrMostrarDevolucionCompra($id_devolucion_compra);

				//var_dump($traerDevolucion);


				//SE APLICA PAGO EN CXP SI LA COMPRA FUE A CREDITO
				if($traerCompra['estatus'] == 2){

				$datos = array("id_compra" => $id_compra,
					"id_proveedor" => $traerCompra["id_proveedor"],
					"importe" => $total_devolucion,
					"id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloCsxp::mdlCrearCxp($datos);


				if ($respuesta == "ok") {

					$columnaSaldoActual = "saldo_actual";

					$nuevoSaldo = $traerCompra["saldo_actual"] - $total_devolucion;

					$cambiarSaldoActual = ModeloCompras::mdlActualizarCompra($columnaSaldoActual, $nuevoSaldo, $id_compra, $_SESSION['id']);
				}
			}

				$listaProductosDevolucionCompra = json_decode($_POST["listaProductosDevolucion"], true);

				foreach ($listaProductosDevolucionCompra as $key => $value) {

					$cantidad = $value["cantidad"];
					$id_partcom = $value["id_partcom"];
					$id_producto = $value["id_producto"];

					if($cantidad !== "0"){


						$datos = array("id_devolucion_compra"=>$id_devolucion_compra,
							"id_producto"=>$id_producto,
							"cantidad"=>$cantidad,
							"precio_unitario"=>$value["precio_unitario"],
							"precio_neto"=>$value["precio_neto"],
							"descuento"=>$value["descuento"],
							"total"=>$value["total"]);


						$respuestaPartDevCom = ControladorPartDevCom::ctrIngresarPartidasDevolucionCompra($datos);


						$columnaCantDev = "cant_dev";

						$traerPartCom = ControladorPartCom::ctrMostrarPartCom($id_partcom);


						$nuevaCantDev = $traerPartCom["cant_dev"] + $cantidad;

						ControladorPartCom::ctrActualizarPartCom($columnaCantDev, $nuevaCantDev, $id_partcom);

						$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

						$columnaStock = "stock";

						$nuevoStock =  $traerProductoES["stock"] - $cantidad;

						$respuesta_actualiza_stock = ControladorExistenciasSucursales::ctrActualizarProductoES2($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);


							//AQUI INGRESAMOS LOS REGISTROS AL KARDEX
						$datosPartidaKardexProductos = array("mo_tipo"=>"DEVOLUCION_COMPRA",
							"mo_refer"=>$id_devolucion_compra,
							"mo_entsal"=>"SALIDA",
							"id_producto"=>$id_producto,
							"mo_cant"=>$cantidad,
							"mo_pu"=>$value["precio_unitario"],
							"mo_existencias"=>$nuevoStock,
							"id_sucursal"=>$id_sucursal);


						ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);
					}//si la cantidad es diferente de 0
				}//foreach de lsita de productos




				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La devolucion no.".$id_devolucion." ha sido generada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){

						window.location = 'lista-devoluciones-compras';
						});
						</script>";
			}//si la devolucion fue generada
		}//ISSET ID_VENTA
	}//CREAR DEVOLUCION
	
	
	
	
	
	
	










	























		}




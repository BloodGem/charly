<?php



class ControladorCompras{






	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function ctrMostrarCompras($columna, $valor){

		$respuesta = ModeloCompras::mdlMostrarCompras($columna, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR COMPRA CLIENTE
	=============================================*/

	static public function ctrMostrarCompra($valor1){

		$respuesta = ModeloCompras::mdlMostrarCompra($valor1);

		return $respuesta;

	}



	static public function ctrInsertarProductoCompra($id_compra, $id_producto, $descuento){

		$traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);

		$id_sucursal = $traerCompra['id_sucursal'];

		$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

		$precio_mas_iva = $traerProductoES["precio_compra"] * 1.16;

		$precio_final = $precio_mas_iva -($precio_mas_iva * ($descuento / 100));


		$datosPartida = array(
			"id_compra"=>$id_compra,
			"id_producto"=>$id_producto,
			"clave_xml"=>"",
			"cantidad"=>1,
			"stock_actual"=>$traerProductoES["stock"],
			"precio_unitario"=>$traerProductoES["precio_compra"],
			"precio"=>$precio_final,
			"descuento"=>$descuento,
			"total"=>number_format($precio_final, 2));

		$respuesta = ModeloPartCom::mdlIngresarPartidasCompra($datosPartida);

		$id_partcom = [];

		if($respuesta !== "error"){

			//$id_partcom = $respuesta[0];
			array_push($id_partcom, $respuesta[0]);

			$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

			//return $traerProductoES;

			return array($traerProductoES, $id_partcom);

		}else{
			return 0;
		}

	}










	static public function ctrGuardaDatosPartidaCompra($id_partcom, $cantidad, $descuento, $precio_unitario, $precio, $total){

		//$total = number_format(($cantidad * $precio), 2, '.', '');

		$datos = array(
			"id_partcom"=>$id_partcom,
			"cantidad"=>$cantidad,
			"precio_unitario"=>$precio_unitario,
			"precio"=>$precio,
			"descuento"=>$descuento,
			"total"=>$total);

		$respuesta = ModeloPartCom::mdlGuardaDatosPartidaCompra($datos);

		return $respuesta;

	}






	static public function ctrEliminarPartidaCompra($id_partcom){

		if($id_partcom !== "" && $id_partcom !== null){

			$respuesta = ModeloPartCom::mdlEliminarPartidaCompra($id_partcom);

			return $respuesta;

		}
	}




	/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrCrearCompra(){

		if(isset($_POST['crearCompra'])){

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			$id_sucursal = $traerUsuario['id_sucursal'];


			$datos = array(
				"id_sucursal"=>$id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datos);

			$respuestaCompra = ModeloCompras::mdlIngresarCompra($datos);

			if($respuestaCompra !== "error"){

				$id_compra = $respuestaCompra[0];

				

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido generada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'index.php?ruta=editar-compra&id_compra=".$id_compra."';
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
					}

	}//CREAR COMPRA





/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrEditarCompra(){


		if(isset($_POST["id_compra"])){

			$id_compra = $_POST["id_compra"];


			if($_POST["cambiarPrecios"] == 1){

				$cambiarPrecios = 1;

			}else{
				$cambiarPrecios = 0;
			}
			/*=============================================
			EDITAR LA COMPRA
			=============================================*/	

			$datos = array(
				"id_proveedor"=>$_POST["nuevoIdProveedor2"],
				"total"=>$_POST["totalCompra"],
				"descuento1"=>$_POST["nuevoDescuento1Compra"],
				"descuento2"=>$_POST["nuevoDescuento2Compra"],
				"descuento3"=>$_POST["nuevoDescuento3Compra"],
				"descuento4"=>$_POST["nuevoDescuento4Compra"],
				"descuento5"=>$_POST["nuevoDescuento5Compra"],
				"descuento_general"=>$_POST["nuevoDescuentoGeneralCompra"],
				"observaciones"=>$_POST["editarObservacionesCompra"],
				"no_factura"=>$_POST["editarNoFacturaCompra"],
				"tipo_compra"=>$_POST["editarTipoCompra"],
				"cambiar_precios"=>1,
				"id_compra"=>$id_compra,
				"id_usuario_ult_mod" => $_SESSION['id']);


			/*var_dump($datos);
			return;*/


			$respuesta = ModeloCompras::mdlEditarCompra($datos);



			if($respuesta !== "error"){

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido modificado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'index.php?ruta=editar-compra&id_compra=".$id_compra."';
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

					}
	}//CREAR COMPRA









	static public function ctrConfirmarCompra(){

		if(isset($_POST['confirmarCompra']) && $_POST['confirmarCompra']  !== ""){

			date_default_timezone_set('America/Mexico_City');

			$id_compra = $_POST['confirmarCompra'];

			$es_credito = $_POST['es_credito'];

			$traerCompra = ModeloCompras::mdlMostrarCompra($id_compra);

			$traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerCompra['id_proveedor']);

			$id_proveedor = $traerCompra['id_proveedor'];

			$id_sucursal = $traerCompra['id_sucursal'];

			$traerPartidasCompra = ControladorPartCom::ctrMostrarPartidasCompra($id_compra);

			if($traerPartidasCompra == false){

				echo "<script>

						Swal.fire({
							icon: 'error',
							title: 'No se puede confirmar la compra porque no tiene productos en ella',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'lista-compras';
								});
								</script>";

				return;
			}

			if($es_credito == 1){
				$valorEstatus = 2;
				$columnaFechaProbable = "fecha_probable";
				$valorFechaProbable = date("Y-m-d", strtotime("now + ".$traerProveedor['dias_credito']." days"));
				$actualizarFechaProbable = ModeloCompras::mdlActualizarCompra($columnaFechaProbable, $valorFechaProbable, $id_compra, $_SESSION['id']);

				$valorSaldoActual = $traerCompra["total"];
			}else{
				$valorEstatus = 1;

				$valorSaldoActual = 0;
			}
			

			$valorFechaConfirmacion = date("Y-m-d H:i:s");


			$datosCompraConfirmada1 = array(
				"estatus"=>$valorEstatus,
				"saldo_actual"=>$valorSaldoActual,
				"fecha_confirmacion"=>$valorFechaConfirmacion,
				"id_compra"=>$id_compra,
				"id_usuario_ult_mod" => $_SESSION['id']);





			$respuestaConfirmarCompra = ModeloCompras::mdlActualizarCompraConfirmada1($datosCompraConfirmada1);


			if($respuestaConfirmarCompra == 1){



				foreach ($traerPartidasCompra as $key => $value) {

					$id_partcom = $value['id_partcom'];

					$id_producto = $value["id_producto"];

					$traerProductoES = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

					$nuevoStock =  $value["cantidad"] + $traerProductoES["stock"];

					$fecha_actual = $day = date("Y-m-d");

					$fecha_ult_compra = date("Y-m-d H:i:s");

					ModeloProductos::mdlActualizarProducto('fecha_ult_compra', $fecha_ult_compra, $id_producto, $_SESSION['id']);

					$datosProductoCompraConfirmada1 = array(
						"stock"=>$nuevoStock,
						"fecha_ult_compra"=>$fecha_actual,
						"id_producto"=>$id_producto,
						"id_sucursal"=>$id_sucursal,
						"id_usuario_ult_mod" => $_SESSION['id']);


					ModeloExistenciasSucursales::mdlActualizarProductoCompraConfirmada1($datosProductoCompraConfirmada1);


					$datosPartidaKardexProductos = array("mo_tipo"=>"COMPRA",
						"mo_refer"=>$id_compra,
						"mo_entsal"=>"ENTRADA",
						"id_producto"=>$id_producto,
						"mo_cant"=>$value["cantidad"],
						"mo_pu"=>$value["precio"],
						"mo_existencias"=>$nuevoStock,
						"id_sucursal"=>$id_sucursal);

					ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);



					$traerProductoProv = ControladorProductos::ctrMostrarProductoProveedor2($id_producto, $id_proveedor);

					if($traerProductoProv == false){
				    	//c_p_p = clave_producto_proveedor = c_prod
						$datosPP = array("id_producto" => $id_producto,
							"id_proveedor" => $id_proveedor,
							"clave_prod_prov" => $traerProductoES['clave_producto']);

						$crearProductoProv = ControladorProductos::ctrCrearProductoProveedor($datosPP);
					}



					ControladorPartCom::ctrActualizarPartCom("estatus", 1, $id_partcom);

					if($traerCompra["cambiar_precios"] == 1){

						$nuevoPrecioCompra = $value["precio"] / 1.16;

						$columnaPrecioCompra = "precio_compra";

						ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecioCompra, $nuevoPrecioCompra,$id_producto, $id_sucursal, $_SESSION['id']);

						/*$precio1 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad1"]/100))*1.16, 0);

						$columnaPrecio1 = "precio1";

						ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio1, $precio1 ,$id_producto, $id_sucursal, $_SESSION['id']);

						$columnaPrecio2 = "precio2";

						$precio2 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad2"]/100))*1.16, 0);

						ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio2, $precio2 ,$id_producto, $id_sucursal, $_SESSION['id']);

						$columnaPrecio3 = "precio3";

						$precio3 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad3"]/100))*1.16, 0);

						ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio3, $precio3 ,$id_producto, $id_sucursal, $_SESSION['id']);*/
					}
				}


				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido confirmada',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-compras';
						});
						</script>";


					}else{
						echo "<script>

						Swal.fire({
							icon: 'error',
							title: 'La compra no.".$id_compra." no se ha confirmado',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){
								window.location = 'lista-compras';
								});
								</script>";
							}

						}



					}












					static public function ctrCrearCompraXML(){

						if(isset($_FILES['xmlCrearCompra'])){

							$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

							$id_sucursal = $traerUsuario['id_sucursal'];


							$datos = array(
								"id_sucursal"=>$id_sucursal,
								"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datos);

							$respuestaCompra = ModeloCompras::mdlIngresarCompra($datos);

							if($respuestaCompra !== "error"){

								$id_compra = $respuestaCompra[0];


								$nombre_archivo_xml = "OC_".$id_compra.".xml";
								$tempname2 = $_FILES["xmlCrearCompra"]["tmp_name"];
								$folder2 = "recursos/compras_xml/".$nombre_archivo_xml;
								if(move_uploaded_file($tempname2, $folder2)){
									$xml = simplexml_load_file($folder2);

									$nombres = $xml->getNameSpaces(true);

									$xml->registerXPathNamespace('cfdi', $nombres['cfdi']);

									foreach ($xml->xpath('//cfdi:Emisor') as $emisor) {

										$rfc_proveedor = $emisor['Rfc'];

										$traerProveedor = ControladorProveedores::ctrMostrarProveedor2("rfc", $rfc_proveedor);

										ModeloCompras::mdlActualizarCompra("id_proveedor", $traerProveedor['id_proveedor'], $id_compra, $_SESSION['id']);

									}

									foreach ($xml->xpath('//cfdi:Concepto') as $cfdi) {

										$clave_producto_xml = $cfdi['NoIdentificacion'];



										$cantidad = $cfdi['Cantidad'];

										$precio_unitario = $cfdi['ValorUnitario'];

										$precio_neto = $precio_unitario * 1.16;

										
										$subtotal = $cfdi['Importe'];

										$descuento_pesos = $cfdi['Descuento'];

										$descuento = (($descuento_pesos * 100)/$subtotal);

										$precio_neto_descuento = $precio_neto -($precio_neto * ($descuento / 100));

										$total = ($subtotal - $descuento_pesos);

										$traerProductoMulticlave = ControladorExistenciasSucursales::ctrMostrarProductoESMulticlave($clave_producto_xml, $id_sucursal);

										//var_dump($traerProductoMulticlave."\n");
										//
										//echo var_dump($traerProductoMulticlave);

										if($traerProductoMulticlave !== false){

											$id_producto = $traerProductoMulticlave['id_producto'];

											$stock_actual = $traerProductoMulticlave["stock"];

											$traerProductoCompra = ControladorPartCom::ctrMostrarPartCom2($id_producto, $id_compra);

										if($traerProductoCompra !== false){
											$cantidd_actual = $traerProductoCompra['cantidad'];
											$nueva_cantidad = $cantidd_actual + $cantidad;
											ControladorPartCom::ctrActualizarPartCom("cantidad", $nueva_cantidad, $traerProductoCompra["id_partcom"]);
										}else{

										

										$datosPartida = array(
										"id_compra"=>$id_compra,
										"id_producto"=>$id_producto,
										"clave_xml"=>$clave_producto_xml,
										"cantidad"=>$cantidad,
										"stock_actual"=>$stock_actual,
										"precio_unitario"=>$precio_unitario,
										"precio"=>$precio_neto_descuento,
										"descuento"=>$descuento,
										"total"=>$total);


										$respuesta = ModeloPartCom::mdlIngresarPartidasCompra($datosPartida);

									}

										}else{

											$id_producto = 0;

											$stock_actual = 0;
										

										$datosPartida = array(
										"id_compra"=>$id_compra,
										"id_producto"=>$id_producto,
										"clave_xml"=>$clave_producto_xml,
										"cantidad"=>$cantidad,
										"stock_actual"=>$stock_actual,
										"precio_unitario"=>$precio_unitario,
										"precio"=>$precio_neto_descuento,
										"descuento"=>$descuento,
										"total"=>$total);


										$respuesta = ModeloPartCom::mdlIngresarPartidasCompra($datosPartida);

									

										}






									}

								}

								//return;


				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido generada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'index.php?ruta=editar-compra&id_compra=".$id_compra."';
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
					}

	}//CREAR COMPRA










	static public function ctrCancelarCompra(){

		if(isset($_POST['cancelarCompra'])){

			$id_compra = $_POST['cancelarCompra'];

			$respuesta = ModeloCompras::mdlActualizarCompra("estatus", 3, $id_compra, $_SESSION['id']);

			if($respuesta == "ok"){

				echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La compra no.".$id_compra." ha sido cancelada',
							showConfirmButton: true
							}).then(function(result){
								window.location = 'lista-compras';
								});
								</script>";

			}else{
				echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'La compra no.".$id_compra." NO se ha podido cancelar',
						showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-compras';
					});
				</script>";
			}

		}
	}










	static public function ctrMostrarSumaComprasRangoFechas($no_rango){

		list($fecha1, $fecha2) = ControladorGlobal::ctrObtenerRangoFechas($no_rango);

		$respuesta = ModeloCompras::mdlMostrarSumaComprasRangoFechas($fecha1, $fecha2);

		return $respuesta;
	}










	static public function ctrMostrarUltimaCompraProducto($id_producto, $id_sucursal){

		$respuesta = ModeloCompras::mdlMostrarUltimaCompraProducto($id_producto, $id_sucursal);

		return $respuesta;
	}


	static public function ctrMostrarPenultimaCompraProducto($id_producto, $id_sucursal){

		$respuesta = ModeloCompras::mdlMostrarPenultimaCompraProducto($id_producto, $id_sucursal);

		return $respuesta;
	}
}




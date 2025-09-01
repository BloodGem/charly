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




	/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrCrearCompra(){
	    
	    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		$id_sucursal = $traerUsuario['id_sucursal'];

		if(isset($_POST["listaProductos"])){


			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS COMPRAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'La compra no tiene productos a venderse',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
				}


				



				if($_POST["cambiarPrecios"] == 1){

					$cambiarPrecios = 1;

				}else{
					$cambiarPrecios = 0;
				}
			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			

			$datos = array(
				"id_proveedor"=>$_POST["nuevoIdProveedor2"],
				"productos"=>$_POST["listaProductos"],
				"total"=>$_POST["totalCompra"],
				"cambiar_precios"=>$cambiarPrecios,
				"id_sucursal"=>$id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datos);

			$respuestaCompra = ModeloCompras::mdlIngresarCompra($datos);

			//var_dump($respuestaCompra);

			if($respuestaCompra !== "error"){

				$id_compra = $respuestaCompra[0];

				

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido generada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-compras';
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

			if($_POST["listaProductos"] == ""){

				

                    $compra = ControladorCompras::ctrMostrarCompra($id_compra);

                    $listaProductos = $compra["productos"];

				
				}elseif ($_POST["listaProductos"] !== "") {

					$listaProductos = $_POST["listaProductos"];
				}

				if($_POST["cambiarPrecios"] == 1){

					$cambiarPrecios = 1;

				}else{
					$cambiarPrecios = 0;
				}
			/*=============================================
			EDITAR LA COMPRA
			=============================================*/	

			$datos = array(
				"productos"=>$listaProductos,
				"total"=>$_POST["totalCompra"],
				"cambiar_precios"=>$cambiarPrecios,
				"id_compra"=>$id_compra,
				"id_usuario_ult_mod" => $_SESSION['id']);

			$respuesta = ModeloCompras::mdlEditarCompra($datos);

			


			if($respuesta !== "error"){

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La compra no.".$id_compra." ha sido modificado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-compras';
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









static public function ctrConfirmarCompra($id_compra, $es_credito){

		if($id_compra !== "" && $id_compra !== null){
		    
		    $traerCompra = ModeloCompras::mdlMostrarCompra($id_compra);

		    $id_sucursal = $traerCompra['id_sucursal'];

			$listaProductos = json_decode($traerCompra['productos'], true);



			foreach ($listaProductos as $key => $value) {

				$datosPartida = array(
							"id_compra"=>$id_compra,
							"id_producto"=>$value["id"],
							"cantidad"=>$value["cantidad"],
							"precio"=>$value["precio"],
							"descuento"=>$value["descuento"],
							"total"=>$value["total"]


						);

						ModeloPartCom::mdlIngresarPartidasCompra($datosPartida);

			    $id_producto = $value["id"];

			    $traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

			    $columnaStock = "stock";

				$nuevoStock =  $value["cantidad"] + $traerProductoES["stock"];

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);

				$datosPartidaKardexProductos = array("mo_tipo"=>"CO",
							"mo_refer"=>$id_compra,
							"mo_entsal"=>"E",
							"id_producto"=>$id_producto,
							"mo_cant"=>$value["cantidad"],
							"mo_pu"=>$value["precio"],
							"mo_existencias"=>$nuevoStock,
							"id_sucursal"=>$id_sucursal);

				ModeloKardexProductos::mdlIngresarPartidasKardex($datosPartidaKardexProductos);
			
				if($traerCompra["cambiar_precios"] == 1){

				$nuevoPrecioCompra = $value["costoCompra"];

				$columnaPrecioCompra = "precio_compra";

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecioCompra, $nuevoPrecioCompra,$id_producto, $id_sucursal, $_SESSION['id']);

				$precio1 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad1"]/100))*1.16, 0);

				$columnaPrecio1 = "precio1";

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio1, $precio1 ,$id_producto, $id_sucursal, $_SESSION['id']);

				$columnaPrecio2 = "precio2";

				$precio2 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad2"]/100))*1.16, 0);

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio2, $precio2 ,$id_producto, $id_sucursal, $_SESSION['id']);

				$columnaPrecio3 = "precio3";

				$precio3 = round($nuevoPrecioCompra*(1+($traerProductoES["utilidad3"]/100))*1.16, 0);

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaPrecio3, $precio3 ,$id_producto, $id_sucursal, $_SESSION['id']);
			}

			}
			
			$id_compra = $traerCompra["id"];
			$columnaEstatus = "estatus";

			if($es_credito == 1){
				$valorEstatus = 2;
				$valorSaldoActual = $traerCompra["total"];
			}else{
				$valorEstatus = 1;
				$valorSaldoActual = 0;
			}
			

        $actualizarEstatus = ModeloCompras::mdlActualizarCompra($columnaEstatus, $valorEstatus, $id_compra, $_SESSION['id']);

        $columnaSaldoActual = "saldo_actual";
        

        $actualizarSaldoActual = ModeloCompras::mdlActualizarCompra($columnaSaldoActual, $valorSaldoActual, $id_compra, $_SESSION['id']);
        
        return $id_compra;

		}else{
		    return;
		}

		
		
	}







}




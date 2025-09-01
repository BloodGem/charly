<?php



class ControladorAjustesInventario{




	/*=============================================
	MOSTRAR COMPRA CLIENTE
	=============================================*/

	static public function ctrMostrarAjusteInventario($id_ajuste_inventario){

		$respuesta = ModeloAjustesInventario::mdlMostrarAjusteInventario($id_ajuste_inventario);

		return $respuesta;

	}




	/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrCrearAjusteInventario(){
	    
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
					title: 'No hay productos en este ajuste',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
				}



				if($_POST["nuevoTipoAjuste"] == 1){

					$tipo_ajuste = 1;

				}else{
					$tipo_ajuste = 0;
				}
				
			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			

			$datos = array("productos"=>$_POST["listaProductos"],
				"tipo_ajuste"=>$tipo_ajuste,
				"id_sucursal"=>$id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);



			$respuestaAjusteInventario = ModeloAjustesInventario::mdlCrearAjusteInventario($datos);

			if($respuestaAjusteInventario !== "error"){

				$id_ajuste_inventario = $respuestaAjusteInventario[0];

				

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El ajuste de inventario no.".$id_ajuste_inventario." ha sido generado con exito',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-ajustes-inventario';
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

	static public function ctrEditarAjusteInventario(){
	    

		if(isset($_POST["id_ajuste_inventario"])){

$id_ajuste_inventario = $_POST["id_ajuste_inventario"];


			if($_POST["listaProductos"] == ""){

				

                    $traerAjusteInventario = ControladorAjustesInventario::ctrMostrarAjusteInventario($id_ajuste_inventario);

                    $listaProductos = $traerAjusteInventario["productos"];

				
				}elseif ($_POST["listaProductos"] !== "") {

					$listaProductos = $_POST["listaProductos"];
				}

				if($_POST["nuevoTipoAjuste"] == 1){

					$tipo_ajuste = 1;

				}else{
					$tipo_ajuste = 0;
				}
			/*=============================================
			EDITAR LA COMPRA
			=============================================*/	

			$datos = array(
				"productos"=>$listaProductos,
				"tipo_ajuste"=>$tipo_ajuste,
				"id_ajuste_inventario"=>$id_ajuste_inventario,
				"id_usuario_ult_mod" => $_SESSION['id']);


			$respuesta = ModeloAjustesInventario::mdlEditarAjusteInventario($datos);

			


			if($respuesta !== "error"){

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El ajuste de inventario no.".$id_ajuste_inventario." ha sido modificado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-ajustes-inventario';
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









static public function ctrConfirmarAjusteInventario($id_ajuste_inventario){

		if($id_ajuste_inventario !== "" && $id_ajuste_inventario !== null){
		    
		    $traerAjusteInventario = ModeloAjustesInventario::mdlMostrarAjusteInventario($id_ajuste_inventario);

		    $id_sucursal = $traerAjusteInventario['id_sucursal'];

			$listaProductos = json_decode($traerAjusteInventario['productos'], true);



			foreach ($listaProductos as $key => $value) {


				$id_producto = $value["id_producto"];

			    $traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

			    $columnaStock = "stock";

			    if($traerAjusteInventario['tipo_ajuste'] == 1){
			    	$nuevoStock =  $traerProductoES["stock"] + $value["cantidad"];
			    	$tipo_mo_entsal = "ENTRADA";
			    }else{
			    	$nuevoStock =  $traerProductoES["stock"] - $value["cantidad"];
			    	$tipo_mo_entsal = "SALIDA";
			    }

				

				ModeloExistenciasSucursales::mdlActualizarProductoES($columnaStock, $nuevoStock, $id_producto, $id_sucursal, $_SESSION['id']);



				$datosPartida = array(
							"id_ajuste_inventario"=>$id_ajuste_inventario,
							"id_producto"=>$value["id_producto"],
							"cantidad"=>$value["cantidad"]


						);

						ModeloPartidasAjustesInventario::mdlIngresarPartidasAjusteInventario($datosPartida);

			   

				$datosPartidaKardexProductos = array("mo_tipo"=>"AJUSTE",
							"mo_refer"=>$id_ajuste_inventario,
							"mo_entsal"=>$tipo_mo_entsal,
							"id_producto"=>$id_producto,
							"mo_cant"=>$value["cantidad"],
							"mo_pu"=>$traerProductoES["precio_compra"],
							"mo_existencias"=>$nuevoStock,
							"id_sucursal"=>$id_sucursal);

				ModeloKardexProductos::mdlIngresarPartidaKarprod($datosPartidaKardexProductos);
			
				

			}
			
			$columnaEstatus = "estatus";
			$valorEstatus = 1;
			
			

        $actualizarEstatus = ModeloAjustesInventario::mdlActualizarAjusteInventario($columnaEstatus, $valorEstatus, $id_ajuste_inventario, $_SESSION['id']);

  
        
        return $id_ajuste_inventario;

		}else{
		    return;
		}

		
		
	}







}




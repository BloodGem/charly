<?php

class ControladorComputadoras{

	static public function ctrCrearComputadora(){

		if(isset($_POST["nuevaComputadora"])){

			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

			$id_sucursal = $traerUsuario['id_sucursal'];

			$datos = array("codigo" => $_POST["nuevoCodigo"],
				"computadora" => $_POST["nuevaComputadora"],
				"imp_ventas" => $_POST["nuevaImpresoraVentas"],
				"imp_caja" => $_POST["nuevaImpresoraCaja"],
				"imp_almacen" => $_POST["nuevaImpresoraAlmacen"],
				"imp_devoluciones" => $_POST["nuevaImpresoraDevoluciones"],
				"imp_compras" => $_POST["nuevaImpresoraCompras"],
				"imp_cotizaciones" => $_POST["nuevaImpresoraCotizaciones"],
				"imp_garantias" => $_POST["nuevaImpresoraGarantias"],
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datos);

			$respuesta = ModeloComputadoras::mdlCrearComputadora($datos);

			if ($respuesta == "ok") {
				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'La computadora ha sido creada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						
						window.location = 'lista-computadoras';

						});


						</script>";
					}



				}
			}



	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarComputadora(){

		if(isset($_POST["editarComputadora"])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora($_POST["idComputadora"]);


				//VENTAS
			if($_POST["editarImpresoraVentas"] !== ""){
				$imp_ventas = $_POST["editarImpresoraVentas"];
			}else{
				$imp_ventas = $traerComputadora['imp_ventas'];
			}


				//CAJA
			if($_POST["editarImpresoraCaja"] !== ""){
				$imp_caja = $_POST["editarImpresoraCaja"];
			}else{
				$imp_caja = $traerComputadora['imp_caja'];
			}


				//ALMACEN
			if($_POST["editarImpresoraAlmacen"] !== ""){
				$imp_almacen = $_POST["editarImpresoraAlmacen"];
			}else{
				$imp_almacen = $traerComputadora['imp_almacen'];
			}


				//DEVOLUCIONES
			if($_POST["editarImpresoraDevoluciones"] !== ""){
				$imp_devoluciones = $_POST["editarImpresoraDevoluciones"];
			}else{
				$imp_devoluciones = $traerComputadora['imp_devoluciones'];
			}


				//COMPRAS
			if($_POST["editarImpresoraCompras"] !== ""){
				$imp_compras = $_POST["editarImpresoraCompras"];
			}else{
				$imp_compras = $traerComputadora['imp_compras'];
			}


				//COTIZACIONES
			if($_POST["editarImpresoraCotizaciones"] !== ""){
				$imp_cotizaciones = $_POST["editarImpresoraCotizaciones"];
			}else{
				$imp_cotizaciones = $traerComputadora['imp_cotizaciones'];
			}


				//GARANTIAS
			if($_POST["editarImpresoraGarantias"] !== ""){
				$imp_garantias = $_POST["editarImpresoraGarantias"];
			}else{
				$imp_garantias = $traerComputadora['imp_garantias'];
			}



			$datos = array("id_computadora" => $_POST["idComputadora"],
				"codigo" => $_POST["editarCodigo"],
				"computadora" => $_POST["editarComputadora"],
				"imp_ventas" => $imp_ventas,
				"imp_caja" => $imp_caja,
				"imp_almacen" => $imp_almacen,
				"imp_devoluciones" => $imp_devoluciones,
				"imp_compras" => $imp_compras,
				"imp_cotizaciones" => $imp_cotizaciones,
				"imp_garantias" => $imp_garantias,
				"id_usuario_ult_mod" => $_SESSION['id']);


			$respuesta = ModeloComputadoras::mdlEditarComputadora($datos);

			if($respuesta == "ok"){

				echo "<script>
				Swal.fire({
					icon: 'success',
					title: 'La computadora a sido editada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-computadoras';
						});
						</script>";

					}
				}
			}








			static public function ctrInicioSesion(){

				if (isset($_POST['ingComputadora'])) {
					$computadora = $_POST['ingComputadora'];

					$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$respuesta = ModeloComputadoras::mdlInicioSesion($computadora, $encriptar);

					if($respuesta['computadora'] == $computadora && $respuesta['password'] == $encriptar){

						$id_computadora = $respuesta['id'];

						if ($respuesta['estado'] == 1) {

							$respuestaCorteCaja = ModeloCajas::mdlRevisarCorteCajaActivo($id_computadora);

							if($respuestaCorteCaja == 1){

								$respuestaCorteCaja2 = ModeloCajas::mdlRevisarCorteCajaActivo2($id_computadora);
								
								$_SESSION['id_corte_caja'] = $respuestaCorteCaja2['id_corte_caja'];


							}


							$objXmlDocument = simplexml_load_file("../../../../../computadora.xml");
							$objJsonDocument = json_encode($objXmlDocument);
							$arrOutput = json_decode($objJsonDocument, TRUE);
							foreach ($arrOutput as $key => $value) {
								$id_computadora = $value['id_computadora'];
								$_SESSION["id_computadora"] = $id_computadora;
							}


							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION['id'] = $id_computadora;
							$_SESSION['id_sucursal_actual'] = $respuesta['id_sucursal'];

							$columna1 = "ultimo_login";
							$valor1 = date('Y-m-d h:i:s'); 

							$ultimoLogin = ModeloComputadoras::mdlActualizarComputadora($columna1,$valor1,$id_computadora, $id_computadora);


							if($ultimoLogin == "ok"){
								echo '<script> window.location = "inicio"; </script>';
							}



						}else{
							echo '<br><div class="alert alert-warning">El computadora esta desactivado</div>';
						}



					}else{
						echo '<br><div class="alert alert-danger">El computadora o contraseña son incorrectos</div>';
					}

				}
			}





			static public function ctrMostrarComputadoras(){

				$respuesta = ModeloComputadoras::mdlMostrarComputadoras();

				return $respuesta;

			}




			static public function ctrMostrarComputadora($id_computadora){

				$respuesta = ModeloComputadoras::mdlMostrarComputadora($id_computadora);

				return $respuesta;

			}





			static public function ctrMostrarComputadora2($columna, $valor){

				$respuesta = ModeloComputadoras::mdlMostrarComputadora2($columna, $valor);

				return $respuesta;

			}




			

			static public function ctrMostrarComputadorasSucursal($id_sucursal){

				$respuesta = ModeloComputadoras::mdlMostrarComputadorasSucursal($id_sucursal);

				return $respuesta;

			}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrEliminarComputadora(){

		if(isset($_GET["id_computadora"])){

			$id_computadora = $_GET["id_computadora"];

			$respuesta = ModeloComputadoras::mdlEliminarComputadora($id_computadora);

			if($respuesta == "ok"){

				echo "<script>
				Swal.fire({
					icon: 'success',
					title: 'El computadora a sido eliminado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'computadoras';
						});
						</script>";

					}		

				}

			}








			static public function ctrDarPermiso($computadora, $password, $permiso){
				$encriptar = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2($computadora, $encriptar);



				if($traerComputadora['computadora'] == $computadora && $traerComputadora['password'] == $encriptar){
					if ($traerComputadora['estado'] == 1) {

						$id_grupo = $traerComputadora['id_grupo'];

						$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

						$array = json_decode($respuesta2['permisos']);

						$indicePermiso = array_search($permiso, $array,true);

						if($indicePermiso !== false){
							return 1;
						}else{
							return 2;
						}

					}else{
						return 3;
					}
				}else{
					return 4;
				}
			}











		}	
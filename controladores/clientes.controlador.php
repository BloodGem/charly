<?php

class ControladorClientes{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarClientes($columna, $valor){


		$respuesta = ModeloClientes::mdlMostrarClientes($columna, $valor);

		return $respuesta;

	}





	static public function ctrMostrarClientes2(){


		$respuesta = ModeloClientes::mdlMostrarClientes2();

		return $respuesta;

	}
	
	
	
	
	
	
	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarCliente($id_cliente){

		$respuesta = ModeloClientes::mdlMostrarCliente($id_cliente);

		return $respuesta;

	}





	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearCliente(){

		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 

		if(isset($_POST["nuevoNombre"]) && isset($_POST["nuevoRfc"]) && isset($_POST["nuevoEmail"]) && isset($_POST["nuevoIdRegimen"]) && isset($_POST["nuevoNombreComercial"]) && isset($_POST["nuevoTelefono1"])){


			function generate_string($input, $strength = 16) {
				$input_length = strlen($input);
				$random_string = '';
				for($i = 0; $i < $strength; $i++) {
					$random_character = $input[mt_rand(0, $input_length - 1)];
					$random_string .= $random_character;
				}

				return $random_string;
			}

			$password = generate_string($permitted_chars, 6);

			$encriptar = $password;

			//$encriptar = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



			$datos = array("nombre" => $_POST["nuevoNombre"],
				"nombre_comercial" => $_POST["nuevoNombreComercial"],
				"rfc" => $_POST["nuevoRfc"],
				"email" => $_POST["nuevoEmail"],
				"telefono1" => $_POST["nuevoTelefono1"],
				"telefono2" => $_POST["nuevoTelefono2"],
				"direccion" => $_POST["nuevaDireccion"],
				"no_interior" => $_POST["nuevoNoInterior"],
				"no_exterior" => $_POST["nuevoNoExterior"],
				"colonia" => $_POST["nuevaColonia"],
				"codigo_postal" => $_POST["nuevoCodigoPostal"],
				"ciudad" => $_POST["nuevaCiudad"],
				"id_estado" => $_POST["nuevoIdEstado"],
				"dia_revpag" => $_POST["nuevoDiaRevpag"],
				"dias_credito" => $_POST["nuevoDiasCredito"],
				"limite_credito" => $_POST["nuevoLimiteCredito"],
				"descuento" => $_POST["nuevoDescuento"],
				"no_precio" => $_POST["nuevoNoPrecio"],
				"id_regimen" => $_POST["nuevoIdRegimen"],
				"password" => $encriptar,
				"id_usuario_creador" => $_SESSION['id']);

			$respuesta = ModeloClientes::mdlCrearCliente($datos);

			if ($respuesta == "ok") {
				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El cliente ha sido creado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-clientes';
						});
						</script>";
					}



				}

			}










	/*=============================================
	CREAR CLIENTE DESDE ALGUN MODULO
	=============================================*/

	static public function ctrCrearClienteModulo($nombre, $rfc, $email, $telefono1, $codigo_postal, $id_regimen, $no_precio){

		if($nombre !== ""){

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 


			function generate_string($input, $strength = 16) {
				$input_length = strlen($input);
				$random_string = '';
				for($i = 0; $i < $strength; $i++) {
					$random_character = $input[mt_rand(0, $input_length - 1)];
					$random_string .= $random_character;
				}

				return $random_string;
			}

			$password = generate_string($permitted_chars, 6);

			$encriptar = $password;

			//$encriptar = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array("nombre" => $nombre,
				"rfc" => $rfc,
				"email" => $email,
				"telefono1" => $telefono1,
				"codigo_postal" => $codigo_postal,
				"id_regimen" => $id_regimen,
				"no_precio" => $no_precio,
				"id_usuario_creador" => $_SESSION['id'],
				"password" => $encriptar);

			$respuesta = ModeloClientes::mdlCrearClienteModulo($datos);

			if($respuesta !== "error"){

				$id_cliente = $respuesta[0];

				$traerCliente = ModeloClientes::mdlMostrarCliente($id_cliente);

				return $traerCliente;

			}else{
				return "error";
			}


		}

	}










		/*=============================================
	EDITAR DATOS CORTOS DEL CLIENTE DESDE ALGUN MODULO
	=============================================*/

	static public function ctrEditarDatosCortosCliente($datosCortosCliente){

		if($datosCortosCliente['id_cliente'] !== ""){

				$respuesta = ModeloClientes::mdlEditarDatosCortosCliente($datosCortosCliente);

				return $respuesta;


			}

		}






	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["id_cliente"])){

			/*if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])/* &&
			   preg_match('/^[a-zA-Z0-9ñÑ]+$/', $_POST["editarClaveSat"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑ]+$/', $_POST["editarCveUnidad"]) &&
			   preg_match('/^[a-zA-ZñÑ]+$/', $_POST["editarUnidad"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionLarga"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCorta"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUbicacion"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarObservacion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdAuto"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdFamilia"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdSubfamilia"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecio1"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarUtilidad1"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecio2"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarUtilidad2"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecio3"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarUtilidad3"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarCostoCompra"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNivelMinimo"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNivelMedio"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNivelMaximo"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdProveedor1"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdProveedor2"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarIdProveedor3"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarLinea"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])*/
			   /*preg_match('/^[INOS]+$/', $_POST["editarEnGarantia"]) &&
			   preg_match('/^[INOS]+$/', $_POST["editarDescuento"]) &&
			   preg_match('/^[INOS]+$/', $_POST["editarDescontinuado"]) &&	){*/
			   	
			   	




			   	$datos = array("id_cliente" => $_POST["id_cliente"],
			   		"nombre" => $_POST["editarNombre"],
			   		"nombre_comercial" => $_POST["editarNombreComercial"],
			   		"rfc" => $_POST["editarRfc"],
			   		"email" => $_POST["editarEmail"],
			   		"telefono1" => $_POST["editarTelefono1"],
			   		"telefono2" => $_POST["editarTelefono2"],
			   		"direccion" => $_POST["editarDireccion"],
			   		"no_interior" => $_POST["editarNoInterior"],
			   		"no_exterior" => $_POST["editarNoExterior"],
			   		"colonia" => $_POST["editarColonia"],
			   		"codigo_postal" => $_POST["editarCodigoPostal"],
			   		"ciudad" => $_POST["editarCiudad"],
			   		"id_estado" => $_POST["editarIdEstado"],
			   		"dia_revpag" => $_POST["editarDiaRevpag"],
			   		"dias_credito" => $_POST["editarDiasCredito"],
			   		"limite_credito" => $_POST["editarLimiteCredito"],
			   		"descuento" => $_POST["editarDescuento"],
			   		"no_precio" => $_POST["editarNoPrecio"],
			   		"id_regimen" => $_POST["editarIdRegimen"],
			   		"id_usuario_ult_mod" => $_SESSION['id']);

			   	$respuesta = ModeloClientes::mdlEditarCliente($datos);

			   	if($respuesta == "ok"){

			   		echo "<script>

			   		Swal.fire({
			   			icon: 'success',
			   			title: 'El cliente ha sido editado con exito',
			   			showConfirmButton: false,
			   			timer: 2000
			   			}).then(function(result){

			   				window.location = 'lista-clientes';

			   				});


			   				</script>";

			   			}




			   		}

			   	}
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarCliente(){

		if(isset($_GET["id_cliente"])){

			
			$datos = $_GET["id_cliente"];

			

			$respuesta = ModeloClientes::mdlEliminarCliente($datos);

			if($respuesta == "ok"){

				echo "<script>
				Swal.fire({
					icon: 'success',
					title: 'El cliente ha sido eliminado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-clientes';
						});
						</script>";

					}		
				}


			}











			static public function ctrActualizarCliente($columna, $valor, $id_cliente, $id_usuario_ult_mod){

				$respuesta = ModeloClientes::mdlActualizarCliente($columna, $valor, $id_cliente, $id_usuario_ult_mod);

				return $respuesta;
			}




		}
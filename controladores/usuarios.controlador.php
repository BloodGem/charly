<?php

//error_reporting(0);

class ControladorUsuarios{

	/*static public function ctrVerificarSesion(){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$objXmlDocument = simplexml_load_file("sesiones/".$traerUsuario['usuario'].".xml");
		$objJsonDocument = json_encode($objXmlDocument);
          $arrOutput = json_decode($objJsonDocument, TRUE);
          foreach ($arrOutput as $key => $value) {
            $fecha_sesion = $value['fecha_sesion'];
            }

            if($fecha_sesion == $_SESSION['fecha_sesion']){
              return 1;
            }else{
              return 0;
            }

	}*/










	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){
		    
		    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		    $id_sucursal = $traerUsuario['id_sucursal'];

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$codigo = $_POST["nuevoCodigo"];


				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "codigo" => $_POST["nuevoCodigo"],
					           "id_grupo" => $_POST["nuevoIdGrupo"],
					           "id_sucursal" => $id_sucursal,
					           "id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloUsuarios::mdlCrearUsuario($datos);

				if ($respuesta == "ok") {

					QRcode::png($codigo, "QR/Usuarios/".$codigo.".png",QR_ECLEVEL_L,10,2);

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El usuario ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'usuarios';

					});
				

				</script>";
				}


	
	}
}



	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_POST["idUsuario"]);

				if($_POST["editarPassword"] !== ""){

					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


				}else{

					$encriptar = $_POST["passwordActual"];

				}

				


				$codigo = $_POST["editarCodigo"];


				$datos = array("id_usuario" => $_POST["idUsuario"],
				               "nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "codigo" => $_POST["editarCodigo"],
							   "id_grupo" => $_POST["editarIdGrupo"],
							   "id_usuario_ult_mod" => $_SESSION['id']);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($datos);

				if($respuesta == "ok"){

					unlink("QR/Usuarios/".$traerUsuario['codigo'].".png");

					QRcode::png($codigo, "QR/Usuarios/".$codigo.".png",QR_ECLEVEL_L,10,2);

					echo "<script>
									Swal.fire({
									icon: 'success',
									title: 'El usuario a sido editado con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
											window.location = 'usuarios';
										});
								</script>";

				}
		}
	}

		

	




	static public function ctrInicioSesion(){

		if (isset($_POST['ingUsuario'])) {
		    $usuario = $_POST['ingUsuario'];

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$respuesta = ModeloUsuarios::mdlInicioSesion($usuario, $encriptar);

				if($respuesta['usuario'] == $usuario && $respuesta['password'] == $encriptar){
				    
				    $id_usuario = $respuesta['id'];

					if ($respuesta['estado'] == 1) {
					    
						$respuestaCorteCaja = ModeloCajas::mdlRevisarCorteCajaActivo($id_usuario);

							if($respuestaCorteCaja == 1){

								$respuestaCorteCaja2 = ModeloCajas::mdlRevisarCorteCajaActivo2($id_usuario);
								
								$_SESSION['id_corte_caja'] = $respuestaCorteCaja2['id_corte_caja'];


							}

							
					//$objXmlDocument = simplexml_load_file("../../../../../computadora.xml");
					//$objXmlDocument = simplexml_load_file("C:/Users/braulio/Documents/computadora.xml");
					
					/*$objJsonDocument = json_encode($objXmlDocument);
					$arrOutput = json_decode($objJsonDocument, TRUE);
					foreach ($arrOutput as $key => $value) {
						$id_computadora = $value['id_computadora'];
						$_SESSION["id_computadora"] = $id_computadora;
					}*/

						
					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION['id'] = $id_usuario;
					$_SESSION['id_sucursal_actual'] = $respuesta['id_sucursal'];

					$columna1 = "ultimo_login";
					$valor1 = date('Y-m-d h:i:s'); 

					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($columna1,$valor1,$id_usuario, $id_usuario);



					$xml = <<< XML
					<sesiones>   
					    <sesion>
					        <fecha_sesion>$valor1</fecha_sesion>
					    </sesion>
					</sesiones>
					XML;
					file_put_contents('sesiones/'.$respuesta['usuario'].'.xml', $xml);

					$_SESSION['fecha_sesion'] = $valor1;


					if($ultimoLogin == "ok"){
						echo '<script> window.location = "inicio"; </script>';
					}

					
					
					}else{
						echo '<br><div class="alert alert-warning">El usuario esta desactivado</div>';
					}

					

				}else{
					echo '<br><div class="alert alert-danger">El usuario o contraseña son incorrectos</div>';
				}
			
		}
	}





	static public function ctrMostrarUsuarios($columna, $valor){

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($columna,$valor);

		return $respuesta;

	}




	static public function ctrMostrarUsuario($id_usuario){

		$respuesta = ModeloUsuarios::mdlMostrarUsuario($id_usuario);

		return $respuesta;

	}




	static public function ctrMostrarVendedores(){
	    
		$respuesta = ModeloUsuarios::mdlMostrarVendedores();

		return $respuesta;

	}

	static public function ctrMostrarCajeros(){
	    
		$respuesta = ModeloUsuarios::mdlMostrarCajeros();

		return $respuesta;

	}


	static public function ctrMostrarUsuariosSucursal($id_sucursal){
	    
		$respuesta = ModeloUsuarios::mdlMostrarUsuariosSucursal($id_sucursal);

		return $respuesta;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrEliminarUsuario(){

		if(isset($_GET["id_usuario"])){

			$id_usuario = $_GET["id_usuario"];

			$respuesta = ModeloUsuarios::mdlEliminarUsuario($id_usuario);

			if($respuesta == "ok"){

				echo "<script>
									Swal.fire({
									icon: 'success',
									title: 'El usuario a sido eliminado con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
											window.location = 'usuarios';
										});
								</script>";

			}		

		}

	}




	static public function ctrMostrarUsuario2($codigo){
		$respuesta = ModeloUsuarios::mdlMostrarUsuario2($codigo);

		return $respuesta;

	}











	static public function ctrDarPermiso($codigo, $permiso){

		$traerUsuario = ControladorUsuarios::ctrMostrarUsuario2($codigo);

		
		if($codigo != ""){
			if($traerUsuario['codigo'] == $codigo){
				if ($traerUsuario['estado'] == 1) {

					$id_grupo = $traerUsuario['id_grupo'];

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
		}else{
			return 4;
		}
	}











}	
<?php

class ControladorTerminalesBancarias{

	/*=============================================
	CREAR MOTOR
	=============================================*/

	static public function ctrCrearTerminalBancaria(){

		if(isset($_POST["nuevaTerminalBancaria"])){

			$id_usuario = $_SESSION['id'];

      		$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

      		$id_sucursal = $traerUsuario['id_sucursal'];


				$datos = array("terminal_bancaria" => $_POST["nuevaTerminalBancaria"],
				"id_sucursal"=>$id_sucursal,
				"id_usuario_creador"=>$id_usuario);


				$respuesta = ModeloTerminalesBancarias::mdlCrearTerminalBancaria($datos);

				if($respuesta == "ok"){


					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La terminal bancaria ha sido creada con éxito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'lista-terminales-bancarias';

					});
				

				</script>";

				}


			}

		}


	

	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function ctrMostrarTerminalesBancarias(){

		$respuesta = ModeloTerminalesBancarias::mdlMostrarTerminalesBancarias();

		return $respuesta;
	
	}






	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function ctrMostrarTerminalesBancariasSucursal(){

		$id_usuario = $_SESSION['id'];

      	$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

      	$id_sucursal = $traerUsuario['id_sucursal'];

		$respuesta = ModeloTerminalesBancarias::mdlMostrarTerminalesBancariasSucursal($id_sucursal);

		return $respuesta;
	
	}






	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function ctrMostrarTerminalBancaria($id_terminal_bancaria){

		$respuesta = ModeloTerminalesBancarias::mdlMostrarTerminalBancaria($id_terminal_bancaria);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR MOTOR POR FILTRO
	=============================================*/

	static public function ctrMostrarTerminalBancariaFiltro($columna, $valor){

		$respuesta = ModeloTerminalesBancarias::mdlMostrarTerminalBancariaFiltro($columna, $valor);

		return $respuesta;

	}


	/*=============================================
	EDITAR MOTOR
	=============================================*/

	static public function ctrEditarTerminalBancaria(){

		if(isset($_POST["editarTerminalBancaria"])){

			$id_usuario = $_SESSION['id'];

      		$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);
				

				$datos = array("terminal_bancaria"=>$_POST["editarTerminalBancaria"],
							   "id_terminal_bancaria"=>$_POST["idTerminalBancaria"],
								"id_usuario_utl_mod"=>$id_usuario);

				

				$respuesta = ModeloTerminalesBancarias::mdlEditarTerminalBancaria($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La terminal bancaria ha sido editada con éxito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'lista-terminales-bancarias';

					});
				

				</script>";

				}


			

		}

	}


}

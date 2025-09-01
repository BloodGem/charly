<?php

class ControladorMotores{

	/*=============================================
	CREAR MOTOR
	=============================================*/

	static public function ctrCrearMotor(){

		if(isset($_POST["nuevaMotor"])){


				$datos = array("motor" => $_POST["nuevaMotor"]);

				$respuesta = ModeloMotores::mdlCrearMotor($datos);

				if($respuesta == "ok"){


					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El motor ha sido creado con éxito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'motores';

					});
				

				</script>";

				}


			}

		}










		/*=============================================
	CREAR MOTOR DESDE ALGUN MODULO
	=============================================*/

	static public function ctrCrearMotorModulo($motor){

		if($motor !== ""){


				$datos = array("motor" => $motor);

				$respuesta = ModeloMotores::mdlCrearMotorModulo($datos);

				if($respuesta !== "error"){

					$id_motor = $respuesta[0];

					$traerMotor = ModeloMotores::mdlMostrarMotor($id_motor);

					return $traerMotor;

				}else{
					return "error";
				}


			}

		}

	

	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function ctrMostrarMotores(){

		$respuesta = ModeloMotores::mdlMostrarMotores();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function ctrMostrarMotor($id_motor){

		$respuesta = ModeloMotores::mdlMostrarMotor($id_motor);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR MOTOR POR FILTRO
	=============================================*/

	static public function ctrMostrarMotorFiltro($columna, $valor){

		$respuesta = ModeloMotores::mdlMostrarMotorFiltro($columna, $valor);

		return $respuesta;

	}


	/*=============================================
	EDITAR MOTOR
	=============================================*/

	static public function ctrEditarMotor(){

		if(isset($_POST["editarMotor"])){
				

				$datos = array("motor"=>$_POST["editarMotor"],
							   "id_motor"=>$_POST["idMotorEM"]);

				

				$respuesta = ModeloMotores::mdlEditarMotor($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El motor ha sido editado con éxito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'motores';

					});
				

				</script>";

				}


			

		}

	}

	/*=============================================
	ELIMINAR MOTOR
	=============================================*/

	static public function ctrEliminarMotor(){

		if(isset($_GET["id_motor"])){

			$tabla ="motores";
			$datos = $_GET["id_motor"];

			$respuesta = ModeloMotores::mdlEliminarMotor($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El motor ha sido eliminado con éxito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'motores';

					});
				

				</script>";
			}
		}
		
	}
}

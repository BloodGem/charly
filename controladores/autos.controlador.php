<?php

class ControladorAutos{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearAuto(){

		if(isset($_POST["nuevoAutoCA"])){


				$auto_completo = $_POST["nuevoAutoCA"]." ".$_POST["nuevaVersionCA"]." ".$_POST["nuevoIdMotorCA"]." ".$_POST["nuevoIdArmadoraCA"];
                
                $datos = array("auto" => $_POST["nuevoAutoCA"],
                				"version" => $_POST["nuevaVersionCA"],
                               "id_motor" => $_POST["nuevoIdMotorCA"],
                               "id_armadora" => $_POST["nuevoIdArmadoraCA"],
							   "auto_completo" => $auto_completo,
					           "id_usuario_creador" => $_SESSION['id']);
                

				$respuesta = ModeloAutos::mdlCrearAuto($datos);


				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El auto ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'autos';

					});
				

				</script>";

				}else{
					echo "<script>

					Swal.fire({
  icon: 'error',
  title: '".$respuesta[1]."',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'autos';

					});
				

				</script>";
				}



		}

	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarAutosFiltro($columna, $valor){

		$respuesta = ModeloAutos::mdlMostrarAutosFiltro($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarAutos(){

		$respuesta = ModeloAutos::mdlMostrarAutos();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS CON FILTRO
	=============================================*/

	static public function ctrMostrarAutosModulo(){

		$respuesta = ModeloAutos::mdlMostrarAutosModulo();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarAuto($id_auto){

		$respuesta = ModeloAutos::mdlMostrarAuto($id_auto);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarAutoFiltro($columna, $valor){

		$respuesta = ModeloAutos::mdlMostrarAutoFiltro($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarAuto(){

		if(isset($_POST["editarAutoEA"])){


				$auto_completo = $_POST["editarAutoEA"]." ".$_POST["editarVersionEA"]." ".$_POST["editarIdMotorEA"]." ".$_POST["editarIdArmadoraEA"];

				$datos = array("auto"=>$_POST["editarAutoEA"],
								"version"=>$_POST["editarVersionEA"],
                               "id_motor"=>$_POST["editarIdArmadoraEA"],
                               "id_armadora" => $_POST["editarIdArmadoraEA"],
                               "auto_completo"=>$auto_completo,
							   "id_auto"=>$_POST["id_auto"],
							   "id_usuario_ult_mod" => $_SESSION['id']);


				$respuesta = ModeloAutos::mdlEditarAuto($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El auto ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'autos';

					});
				

				</script>";

				}else{
					echo "<script>

					Swal.fire({
  icon: 'error',
  title: '".print_r($respuesta)."',
  showConfirmButton: true
});
				

				</script>";
				}


		

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrEliminarAuto(){

		if(isset($_GET["id_auto"])){

			$tabla ="autos";
			$datos = $_GET["id_auto"];

			$respuesta = ModeloAutos::mdlEliminarAuto($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El auto ha sido eliminado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'autos';

					});
				

				</script>";
			}
		}
		
	}
}

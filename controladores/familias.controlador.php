<?php

class ControladorFamilias{

	/*=============================================
	CREAR FAMILIA
	=============================================*/

	static public function ctrCrearFamilia(){

		if(isset($_POST["nuevaFamilia"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaFamilia"])){

				

				$datos = array("familia" => $_POST["nuevaFamilia"]);

				$respuesta = ModeloFamilias::mdlCrearFamilia($datos);

				if($respuesta == "ok"){


					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La familia ha sido creada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'familias';

					});
				

				</script>";

				}


			}else{

				echo "<script>

					Swal.fire({
  icon: 'error',
  title: '¡La familia no puede llevar caracteres especiales!',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'familias';

					});
				

				</script>";

			}

		}

	}









	/*=============================================
	CREAR MARCA DESDE ALGUN MODULO
	=============================================*/

	static public function ctrCrearFamiliaModulo($familia){

		if($familia !== ""){


				$datos = array("familia" => $familia);

				$respuesta = ModeloFamilias::mdlCrearFamiliaModulo($datos);

				if($respuesta !== "error"){

					$id_familia = $respuesta[0];

					$traerFamilia = ModeloFamilias::mdlMostrarFamilia($id_familia);

					return $traerFamilia;

				}else{
					return "error";
				}


			}

		}


	/*=============================================
	MOSTRAR FAMILIAS
	=============================================*/

	static public function ctrMostrarFamilias(){

		$respuesta = ModeloFamilias::mdlMostrarFamilias();

		return $respuesta;
	
	}





	static public function ctrMostrarFamilia($id_familia){

		$respuesta = ModeloFamilias::mdlMostrarFamilia($id_familia);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR FAMILIA
	=============================================*/

	static public function ctrEditarFamilia(){

		if(isset($_POST["editarFamilia"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarFamilia"])){

				

				$datos = array("familia"=>$_POST["editarFamilia"],
							   "id_familia"=>$_POST["id_familia"]);


				$respuesta = ModeloFamilias::mdlEditarFamilia($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La familia ha sido editada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'familias';

					});
				

				</script>";

				}


			}else{

				echo "<script>

					Swal.fire({
  icon: 'error',
  title: '¡El familia no puede llevar caracteres especiales!',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'familias';

					});
				

				</script>";

			}

		}

	}

	/*=============================================
	ELIMINAR FAMILIA
	=============================================*/

	static public function ctrEliminarFamilia(){

		if(isset($_GET["id_familia"])){

			$tabla ="familias";
			$datos = $_GET["id_familia"];

			$respuesta = ModeloFamilias::mdlEliminarFamilia($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El familia ha sido eliminada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'familias';

					});
				

				</script>";
			}
		}
		
	}
}

<?php

class ControladorSubfamilias{

	/*=============================================
	CRESR CSTEGORIAS
	=============================================*/

	static public function ctrCrearSubfamilia(){

		if(isset($_POST["nuevaSubfamiliaCS"])){


				$subfamilia_completo = $_POST["nuevaSubfamiliaCS"]." ".$_POST["nuevoIdFamiliaCS"];
                
                $datos = array("subfamilia" => $_POST["nuevaSubfamiliaCS"],
                               "id_familia" => $_POST["nuevoIdFamiliaCS"],
							   "subfamilia_completo" => $subfamilia_completo,
					           "id_usuario_creador" => $_SESSION['id']);
                

				$respuesta = ModeloSubfamilias::mdlCrearSubfamilia($datos);


				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La subfamilia ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'subfamilias';

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
						
							window.location = 'subfamilias';

					});
				

				</script>";
				}



		}

	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSubfamiliasFiltro($columna, $valor){

		$respuesta = ModeloSubfamilias::mdlMostrarSubfamiliasFiltro($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSubfamilias(){

		$respuesta = ModeloSubfamilias::mdlMostrarSubfamilias();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS CON FILTRO
	=============================================*/

	static public function ctrMostrarSubfamiliasModulo(){

		$respuesta = ModeloSubfamilias::mdlMostrarSubfamiliasModulo();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSubfamilia($id_subfamilia){

		$respuesta = ModeloSubfamilias::mdlMostrarSubfamilia($id_subfamilia);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSubfamiliaFiltro($columna, $valor){

		$respuesta = ModeloSubfamilias::mdlMostrarSubfamiliaFiltro($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CSTEGORIA
	=============================================*/

	static public function ctrEditarSubfamilia(){

		if(isset($_POST["editarSubfamiliaES"])){


				$subfamilia_completo = $_POST["editarSubfamiliaES"]." ".$_POST["editarIdFamiliaES"];

				$datos = array("subfamilia"=>$_POST["editarSubfamiliaES"],
                               "id_familia"=>$_POST["editarIdArmadoraES"],
                               "subfamilia_completo"=>$subfamilia_completo,
							   "id_subfamilia"=>$_POST["id_subfamilia"],
							   "id_usuario_ult_mod" => $_SESSION['id']);


				$respuesta = ModeloSubfamilias::mdlEditarSubfamilia($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La subfamilia ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'subfamilias';

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
	BORRAR CSTEGORIA
	=============================================*/

	static public function ctrEliminarSubfamilia(){

		if(isset($_GET["id_subfamilia"])){

			$datos = $_GET["id_subfamilia"];

			$respuesta = ModeloSubfamilias::mdlEliminarSubfamilia($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La subfamilia ha sido eliminado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'subfamilias';

					});
				

				</script>";
			}
		}
		
	}
}

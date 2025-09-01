<?php

class ControladorGastos{

	/*=============================================
	CREAR GASTOS
	=============================================*/

	static public function ctrCrearGasto(){

		if(isset($_POST["nuevoIdTipoGasto"])){

				

				$datos = array("id_tipo_gasto" => $_POST["nuevoIdTipoGasto"],
							   "total" => $_POST["nuevoTotal"],
							   "archivo" => "xD",
							   "comentario" => $_POST["nuevoComentario"],
					           "id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloGastos::mdlCrearGasto($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El gasto ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'gastos';

					});
				

				</script>";

				}




		}

	}

	/*=============================================
	MOSTRAR GASTOS
	=============================================*/

	static public function ctrMostrarGastos($columna, $valor){

		

		$respuesta = ModeloGastos::mdlMostrarGastos($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR TIPO DE GASTO
	=============================================*/

	static public function ctrEditarGasto(){

		if(isset($_POST["id_gasto"])){

				

				$datos = array("id_tipo_gasto" => $_POST["editarIdTipoGasto"],
							   "total" => $_POST["editarTotal"],
							   "archivo" => $_POST["editarArchivo"],
							   "comentario" => $_POST["editarComentario"],
							   "id_gasto"=>$_POST["id_gasto"],
							   "id_usuario_ult_mod" => $_SESSION['id']);

				$respuesta = ModeloGastos::mdlEditarGasto($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El gasto ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'gastos';

					});
				

				</script>";

				}



		}

	}

	/*=============================================
	ELIMINAR TIPO DE GASTO
	=============================================*/

	static public function ctrEliminarGasto(){

		if(isset($_GET["id_gasto"])){

			$tabla ="gastos";
			$datos = $_GET["id_gasto"];

			$respuesta = ModeloGastos::mdlEliminarGasto($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El gasto ha sido eliminado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'gastos';

					});
				

				</script>";
			}
		}
		
	}
}

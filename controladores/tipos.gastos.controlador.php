<?php

class ControladorTiposGastos{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearTipoGasto(){

		if(isset($_POST["nuevoTipoGasto"])){



				$datos = array("tipo_gasto" => $_POST["nuevoTipoGasto"],
							   "id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloTiposGastos::mdlCrearTipoGasto($datos);

				var_dump($respuesta);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El tipo de gasto ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'tipos-gastos';

					});
				

				</script>";

				}




		}

	}

	/*=============================================
	MOSTRAR TIPOS DE GASTOS
	=============================================*/

	static public function ctrMostrarTiposGastos($columna, $valor){

		$respuesta = ModeloTiposGastos::mdlMostrarTiposGastos($columna, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR TIPO DE GASTO
	=============================================*/

	static public function ctrEditarTipoGasto(){

		if(isset($_POST["editarTipoGasto"])){

				$datos = array("tipo_gasto"=>$_POST["editarTipoGasto"],
							   "id_tipo_gasto"=>$_POST["id_tipo_gasto"],
							   "id_usuario_ult_mod" => $_SESSION['id']);

				$respuesta = ModeloTiposGastos::mdlEditarTipoGasto($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El tipo de gasto ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'tipos-gastos';

					});
				

				</script>";

				}


		}

	}

	/*=============================================
	ELIMINAR TIPO DE GASTO
	=============================================*/

	static public function ctrEliminarTipoGasto(){

		if(isset($_GET["id_tipo_gasto"])){

			$tabla ="tipos_gastos";
			$datos = $_GET["id_tipo_gasto"];

			$respuesta = ModeloTiposGastos::mdlEliminarTipoGasto($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El tipo de gasto ha sido eliminado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'tipos-gastos';

					});
				

				</script>";
			}
		}
		
	}
}

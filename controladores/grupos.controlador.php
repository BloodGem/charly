<?php

class ControladorGrupos{

	/*=============================================
	CREAR GRUPO
	=============================================*/

	static public function ctrCrearGrupo(){

		if(isset($_POST["nuevoNombreGrupo"])){

				

				$array1 = $_POST['nuevosPermisos'];

				if($array1 != null || $array1 != ""){

					$array2 = ['Mi perfil'];

				$combinarArray = array_merge($array2, $array1);

				}

				

				$permisos = json_encode($combinarArray);

				//$permisos = implode(', ', $_POST['nuevosPermisos']);


				$datos = array("nombre_grupo" => $_POST["nuevoNombreGrupo"],
								"permisos" => $permisos,
								"id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloGrupos::mdlCrearGrupo($datos);

				if($respuesta !== ""){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El grupo ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'grupos';

					});
				

				</script>";

				}



		}

	}

	/*=============================================
	MOSTRAR GRUPO ESPECIFICO
	=============================================*/

	static public function ctrMostrarGrupo($id_grupo){

		$respuesta = ModeloGrupos::mdlMostrarGrupo($id_grupo);

		return $respuesta;
	
	}


static public function ctrMostrarGrupos(){

		$respuesta = ModeloGrupos::mdlMostrarGrupos();

		return $respuesta;
	
	}

	static public function ctrMostrarGrupo2($columna, $valor){

		$respuesta = ModeloGrupos::mdlMostrarGrupo2($columna, $valor);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR GRUPOS
	=============================================*/

	static public function ctrBuscarPermiso($permisos,$permiso){

		$array = json_decode($permisos);

        $indice = array_search($permiso,$array,true);

        return $indice;

	}





	/*=============================================
	EDITAR GRUPO
	=============================================*/

	static public function ctrEditarGrupo(){

		if(isset($_POST["id_grupo"])){


				$tabla = "grupos";


				$array1 = $_POST['editarPermisos'];

				$array2 = ['Mi perfil'];

				$combinarArray = array_merge($array2, $array1);

				$permisos = json_encode($combinarArray);

				$datos = array("nombre_grupo"=>$_POST["editarNombreGrupo"],
							   "permisos"=>$permisos,
							   "id_grupo"=>$_POST["id_grupo"],
								"id_usuario_ult_mod" => $_SESSION['id']);

				$respuesta = ModeloGrupos::mdlEditarGrupo($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El grupo ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'grupos';

					});
				

				</script>";

				}


		}

	}

	/*=============================================
	ELIMINAR GRUPO
	=============================================*/

	static public function ctrEliminarGrupo(){

		if(isset($_GET["id_grupo"])){

			$datos = $_GET["id_grupo"];

			$respuesta = ModeloGrupos::mdlEliminarGrupo($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El grupo ha sido eliminada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'grupos';

					});
				

				</script>";
			}
		}
		
	}
}

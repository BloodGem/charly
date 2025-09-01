<?php

class ControladorMarcas{

	/*=============================================
	CREAR MARCA
	=============================================*/

	static public function ctrCrearMarca(){

		if(isset($_POST["nuevaMarca"])){


				$datos = array("marca" => $_POST["nuevaMarca"]);

				$respuesta = ModeloMarcas::mdlCrearMarca($datos);

				if($respuesta == "ok"){


					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La marca ha sido creada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'marcas';

					});
				

				</script>";

				}


			}

		}










		/*=============================================
	CREAR MARCA DESDE ALGUN MODULO
	=============================================*/

	static public function ctrCrearMarcaModulo($marca){

		if($marca !== ""){


				$datos = array("marca" => $marca);

				$respuesta = ModeloMarcas::mdlCrearMarcaModulo($datos);

				if($respuesta !== "error"){

					$id_marca = $respuesta[0];

					$traerMarca = ModeloMarcas::mdlMostrarMarca($id_marca);

					return $traerMarca;

				}else{
					return "error";
				}


			}

		}

	

	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function ctrMostrarMarcas(){

		$respuesta = ModeloMarcas::mdlMostrarMarcas();

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function ctrMostrarMarca($id_marca){

		$respuesta = ModeloMarcas::mdlMostrarMarca($id_marca);

		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR MARCA POR FILTRO
	=============================================*/

	static public function ctrMostrarMarcaFiltro($columna, $valor){

		$respuesta = ModeloMarcas::mdlMostrarMarcaFiltro($columna, $valor);

		return $respuesta;

	}


	/*=============================================
	EDITAR MARCA
	=============================================*/

	static public function ctrEditarMarca(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){

				

				$datos = array("marca"=>$_POST["editarMarca"],
							   "id_marca"=>$_POST["id_marca"]);


				$respuesta = ModeloMarcas::mdlEditarMarca($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'La marca ha sido editada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'marcas';

					});
				

				</script>";

				}


			}else{

				echo "<script>

					Swal.fire({
  icon: 'error',
  title: '¡El marca no puede llevar caracteres especiales!',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'marcas';

					});
				

				</script>";

			}

		}

	}

	/*=============================================
	ELIMINAR MARCA
	=============================================*/

	static public function ctrEliminarMarca(){

		if(isset($_GET["id_marca"])){

			$tabla ="marcas";
			$datos = $_GET["id_marca"];

			$respuesta = ModeloMarcas::mdlEliminarMarca($datos);

			if($respuesta == "ok"){

				echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El marca ha sido eliminada con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'marcas';

					});
				

				</script>";
			}
		}
		
	}
}

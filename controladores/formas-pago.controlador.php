<?php

class ControladorFormasPago{

	/*=============================================
	CREAR FORMA DE COBRO
	=============================================

	static public function ctrCrearFormaPago(){

		if(isset($_POST["nuevaFormaPago"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaFormaPago"])){

				

				$datos = array("familia" => $_POST["nuevaFormaPago"]);

				$respuesta = ModeloFormasPago::mdlCrearFormaPago($datos);

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
	=============================================

	static public function ctrCrearFormaPagoModulo($familia){

		if($familia !== ""){


				$datos = array("familia" => $familia);

				$respuesta = ModeloFormasPago::mdlCrearFormaPagoModulo($datos);

				if($respuesta !== "error"){

					$id_familia = $respuesta[0];

					$traerFormaPago = ModeloFormasPago::mdlMostrarFormaPago($id_familia);

					return $traerFormaPago;

				}else{
					return "error";
				}


			}

		}


	/*=============================================
	MOSTRAR FAMILIAS
	=============================================

	static public function ctrMostrarFormasPago($columna, $valor){

		$respuesta = ModeloFormasPago::mdlMostrarFormasPago($columna, $valor);

		return $respuesta;
	
	}*/


	/*=============================================
	MOSTRAR FAMILIAS
	=============================================*/

	static public function ctrMostrarFormaPago($id_forma_pago){

		$respuesta = ModeloFormasPago::mdlMostrarFormaPago($id_forma_pago);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR FORMA DE PAGO RESTANTES PARA EL COBRO DDE LA VENTA (CV)
	=============================================*/

	static public function ctrMostrarFormasPagoRestantesCV($id_forma_pago){

		$respuesta = ModeloFormasPago::mdlMostrarFormasPagoRestantesCV($id_forma_pago);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR FAMILIA
	=============================================
	static public function ctrEditarFormaPago(){

		if(isset($_POST["editarFormaPago"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarFormaPago"])){

				

				$datos = array("familia"=>$_POST["editarFormaPago"],
							   "id_familia"=>$_POST["id_familia"]);


				$respuesta = ModeloFormasPago::mdlEditarFormaPago($datos);

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
	=============================================

	static public function ctrEliminarFormaPago(){

		if(isset($_GET["id_familia"])){

			$tabla ="familias";
			$datos = $_GET["id_familia"];

			$respuesta = ModeloFormasPago::mdlEliminarFormaPago($datos);

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
		
	}*/
}

<?php

class ControladorProveedores{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProveedores(){


		$respuesta = ModeloProveedores::mdlMostrarProveedores();

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProveedor($id_proveedor){

		$respuesta = ModeloProveedores::mdlMostrarProveedor($id_proveedor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PROVEEDOR CON PARAMETRO CUALQUIERA PARA VALIDACIÓN
	=============================================*/

	static public function ctrMostrarProveedor2($columna, $valor){

		$respuesta = ModeloProveedores::mdlMostrarProveedor2($columna, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoNombre"]) && isset($_POST["nuevoRfc"]) && isset($_POST["nuevoEmail"]) && isset($_POST["nuevoNombreComercial"]) && isset($_POST["nuevoTelefono1"])){


			   	
			   	


				

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "nombre_comercial" => $_POST["nuevoNombreComercial"],
							   "rfc" => $_POST["nuevoRfc"],
							   "email" => $_POST["nuevoEmail"],
							   "telefono1" => $_POST["nuevoTelefono1"],
							   "telefono2" => $_POST["nuevoTelefono2"],
							   "direccion" => $_POST["nuevaDireccion"],
							   "no_interior" => $_POST["nuevoNoInterior"],
							   "no_exterior" => $_POST["nuevoNoExterior"],
							   "colonia" => $_POST["nuevaColonia"],
							   "codigo_postal" => $_POST["nuevoCodigoPostal"],
							   "ciudad" => $_POST["nuevaCiudad"],
							   "id_estado" => $_POST["nuevoIdEstado"],
							   "dia_revpag" => $_POST["nuevoDiaRevpag"],
							   "dias_credito" => $_POST["nuevoDiasCredito"],
							   "limite_credito" => $_POST["nuevoLimiteCredito"],
							   "descuento" => $_POST["nuevoDescuento"],
					           "id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloProveedores::mdlCrearProveedor($datos);

				if ($respuesta == "ok") {
					echo "<script>

						Swal.fire({
  						icon: 'success',
  						title: 'El proveedor ha sido creado con exito',
  						showConfirmButton: false,
  						timer: 2000
						}).then(function(result){
						window.location = 'lista-proveedores';
						});
					</script>";
				}

		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["id_proveedor"])){



				$datos = array("id_proveedor" => $_POST["id_proveedor"],
								"nombre" => $_POST["editarNombre"],
							   "nombre_comercial" => $_POST["editarNombreComercial"],
							   "rfc" => $_POST["editarRfc"],
							   "email" => $_POST["editarEmail"],
							   "telefono1" => $_POST["editarTelefono1"],
							   "telefono2" => $_POST["editarTelefono2"],
							   "direccion" => $_POST["editarDireccion"],
							   "no_interior" => $_POST["editarNoInterior"],
							   "no_exterior" => $_POST["editarNoExterior"],
							   "colonia" => $_POST["editarColonia"],
							   "codigo_postal" => $_POST["editarCodigoPostal"],
							   "ciudad" => $_POST["editarCiudad"],
								"id_estado" => $_POST["editarIdEstado"],
								"dia_revpag" => $_POST["editarDiaRevpag"],
								"dias_credito" => $_POST["editarDiasCredito"],
								"limite_credito" => $_POST["editarLimiteCredito"],
								"descuento" => $_POST["editarDescuento"],
							   "id_usuario_ult_mod" => $_SESSION['id']);

				$respuesta = ModeloProveedores::mdlEditarProveedor($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El proveedor ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'lista-proveedores';

					});
				

				</script>";

				}




		}

	}
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProveedor(){

		if(isset($_GET["id_proveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["id_proveedor"];

			

			$respuesta = ModeloProveedores::mdlEliminarProveedor($datos);

			if($respuesta == "ok"){

				echo "<script>
									Swal.fire({
									icon: 'success',
									title: 'El proveedor ha sido eliminado con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
											window.location = 'lista-proveedores';
										});
								</script>";

			}		
		}


	}




}
<?php

class ControladorSucursales{


	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSucursales(){

		$respuesta = ModeloSucursales::mdlMostrarSucursales();

		return $respuesta;
	
	}



	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function ctrMostrarSucursal($valor){

		$respuesta = ModeloSucursales::mdlMostrarSucursal($valor);

		return $respuesta;
	
	}

	static public function ctrEditarSucursal(){

		if(isset($_POST["id_sucursal"])){

			//CCER
			$ccer = $_FILES["editarCcerE"]["name"];
			   	if ($ccer !== '') {

    				$tempname1 = $_FILES["editarCcerE"]["tmp_name"];    
    				$folder1 = "SDK2/certificados/".$ccer;
   					move_uploaded_file($tempname1, $folder1);
   					$ccer_db = "SDK2/certificados/".$ccer;

			   	}else{
			   		$ccer_db = $_POST['actualCcerE'];
			   	}



			   	//CKEY
				$ckey = $_FILES["editarCkeyE"]["name"];
			   	if ($ckey !== '') {

    				$tempname2 = $_FILES["editarCkeyE"]["tmp_name"];    
    				$folder2 = "SDK2/certificados/".$ckey;
   					move_uploaded_file($tempname2, $folder2);
   					$ckey_db = "SDK2/certificados/".$ckey;

			   	}else{
			   		$ckey_db = $_POST['actualCkeyE'];
			   	}



			   	//CLAVE
			   	if ($_POST['editarClaveE'] !== '') {

   					$clave_db = $_POST['editarClaveE'];

			   	}else{
			   		$clave_db = $_POST['actualClaveE'];
			   	}




				$datos = array("id_sucursal" => $_POST["id_sucursal"],
								"ccer" => $ccer_db,
								"ckey" => $ckey_db,
								"clave" => $clave_db,
								"rfc" => $_POST["editarRfcE"],
								"nombre" => $_POST["editarNombreE"],
								"id_regimen" => $_POST["editarIdRegimenE"],
							   "email" => $_POST["editarEmailE"],
							   "telefono1" => $_POST["editarTelefono1E"],
							   "telefono2" => $_POST["editarTelefono2E"],
							   "direccion" => $_POST["editarDireccionE"],
							   "no_interior" => $_POST["editarNoInteriorE"],
							   "no_exterior" => $_POST["editarNoExteriorE"],
							   "colonia" => $_POST["editarColoniaE"],
							   "codigo_postal" => $_POST["editarCodigoPostalE"],
							   "ciudad" => $_POST["editarCiudadE"],
								"id_estado" => $_POST["editarIdEstadoE"],
								"sitio_web" => $_POST["editarSitioWebE"]);

				$respuesta = ModeloSucursales::mdlEditarSucursal($datos);

				if($respuesta == "ok"){

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'Los datos de la sucursal han sido cambiados con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'perfil-sucursal';

					});
				

				</script>";

				}


			}

		}
}

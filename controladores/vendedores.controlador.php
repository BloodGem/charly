<?php

//error_reporting(0);

class ControladorVendedores{

	static public function ctrCrearVendedor(){

		if(isset($_POST["nuevoCodigo"])){
		    
		    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		    $id_sucursal = $traerUsuario['id_sucursal'];

		    $codigo = $_POST["nuevoCodigo"];

				//$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombres" => $_POST["nuevosNombres"],
								"apellido_p" => $_POST["nuevoApellidoP"],
								"apellido_m" => $_POST["nuevoApellidoM"],
					           "codigo" => $_POST["nuevoCodigo"],
					           "id_sucursal" => $id_sucursal);


				$respuesta = ModeloVendedores::mdlCrearVendedor($datos);

				if ($respuesta == "ok") {

					  QRcode::png($codigo, "QR/Vendedores/".$codigo.".png",QR_ECLEVEL_L,10,2);

					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El vendedor ha sido creado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'vendedores';

					});
				

				</script>";
				}


	
	}
}




	static public function ctrMostrarVendedores(){

		$respuesta = ModeloVendedores::mdlMostrarVendedores();

		return $respuesta;

	}





	static public function ctrMostrarVendedor($columna, $valor){
	    
		$respuesta = ModeloVendedores::mdlMostrarVendedor($columna, $valor);

		return $respuesta;

	}

	static public function ctrMostrarVendedor2($id_vendedor){
	    
		$respuesta = ModeloVendedores::mdlMostrarVendedor2($id_vendedor);

		return $respuesta;

	}


}	
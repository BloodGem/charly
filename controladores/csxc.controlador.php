<?php


class ControladorCsxc{




	static public function ctrCrearAbono(){

		if(isset($_POST["listaCsxcCC"])){

			if($_POST["listaCsxcCC"] == ""){

				echo"<script>
				Swal.fire({
					icon: 'error',
					title: 'No puedes realizar esta operación',
					showConfirmButton: false,
					timer: 2000
					});
					</script>";

					return;
			}


			$listaVentas = json_decode($_POST["listaCsxcCC"], true);



			

			list($codigo_mf_texto) = ModeloCsxc::mdlTimbrarCxc($_POST["mostrarIdClienteC"], $_POST["listaCsxcCC"]);

				if($codigo_mf_texto == '[MODO PRUEBAS] OK'){

					foreach ($listaVentas as $key => $value) {


				$id_venta = $value["id_venta"];

				$datos = array("id_venta" => $id_venta,
					           "id_cliente" => $_POST["mostrarIdClienteC"],
					           //"id_metodo" => $_POST["nuevoIdFormaPagoCxc"],
					           "importe" => $value["importe"]
					           //"documento" => $_POST["nuevoDocumento"],
					       	   //"observacion" => $_POST["nuevaObservacion"]
					       );
				$respuesta = ModeloCsxc::mdlCrearCxc($datos);


				if ($respuesta == "ok") {
					$nuevoSaldo = $value["adeudo"] - $value["importe"];

					$cambiarSaldoActual = ModeloVentas::mdlActualizarSaldoActual($nuevoSaldo, $id_venta);

					if($cambiarSaldoActual == "ok"){
						echo "<script>
						var Toast = Swal.mixin({
				        toast: true,
				        position: 'top-end',
				        showConfirmButton: false,
				        timer: 5000
				        });

						toastr.success('A la venta: ".$id_venta." se le ha creado con exito su respectivo abono');
						</script>";
					}else{
						echo "<script>
						var Toast = Swal.mixin({
				        toast: true,
				        position: 'top-end',
				        showConfirmButton: false,
				        timer: 5000
				        });

						toastr.error('A la venta: ".$id_venta." no se le ha creado su respectivo abono');
						</script>";
					}
				}else{
					echo "<script>
						var Toast = Swal.mixin({
				        toast: true,
				        position: 'top-end',
				        showConfirmButton: false,
				        timer: 5000
				        });

						toastr.error('venta: ".$id_venta." error de creación de cxc');
						</script>";
				}
			}

									echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El documento fiscal ha sido generado correctamente',
					showConfirmButton: false,
					timer: 7000
					}).then(function(result){

						window.location = 'lista-csxc';
						});
						</script>";

								}else{

									echo "<script>

				Swal.fire({
					icon: 'error',
					title: '".$codigo_mf_texto."',
					text: 'No se ha podido generar documento fiscal',
					text: 'Por ende no ha habido ningun movimiento',
					showConfirmButton: false,
					timer: 7000
					}).then(function(result){

						window.location = 'lista-csxc';
						});
						</script>";

						var_dump($codigo_mf_texto);

								}

								

					
		}//ISSET LISTA DE CUENTAS POR COBRAR
	}














































	static public function ctrCrearCxc(){

		if(isset($_POST["nuevoImporte"])){

			$id_venta = $_POST["nuevoIdVenta"];

			$nuevoSaldo = $_POST['saldoActual'] - $_POST['nuevoImporte'];

			$cambiarSaldoActual = ModeloVentas::mdlActualizarSaldoActual($nuevoSaldo, $id_venta);

			if ($cambiarSaldoActual == 'ok') {

				$datos = array("id_venta" => $_POST["nuevoIdVenta"],
					           "id_cliente" => $_POST["nuevoIdCliente"],
					           "id_metodo" => $_POST["nuevoIdFormaPagoCxc"],
					           "importe" => $_POST["nuevoImporte"],
					           "documento" => $_POST["nuevoDocumento"],
					       	   "observacion" => $_POST["nuevaObservacion"]);

				$respuesta = ModeloCsxc::mdlCrearCxc($datos);

				if ($respuesta == "ok") {


					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El abono ha sido creado con exito',
  showConfirmButton: false,
  timer: 4000
}).then(function(result){
						window.location = 'lista-csxc';
						});
				
				</script>";
				}
				
			}else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'No se ha podido realizar operación',
					showConfirmButton: false,
					timer: 4000
					});
						</script>";
			}

				


	}






}





	/*=============================================
	MOSTRAR ADEUDO TOTAL DEL CLIENTE Y SUS DATOS
	=============================================*/

	static public function ctrMostrarAdeudoTotalClienteC($id_cliente){

		$respuesta = ModeloCsxc::mdlMostrarAdeudoTotalClienteC($id_cliente);

		return $respuesta;

	}




}	
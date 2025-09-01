<?php


class ControladorCsxp{




	static public function ctrCrearAbono(){

		if(isset($_POST["listaCsxpCC"])){

			if($_POST["listaCsxpCC"] == ""){

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


			$listaCompras = json_decode($_POST["listaCsxpCC"], true);

			foreach ($listaCompras as $key => $value) {


				$id_compra = $value["id_compra"];

				$datos = array("id_compra" => $id_compra,
					"id_proveedor" => $_POST["mostrarIdProveedorC"],
					//"id_metodo" => $_POST["nuevoIdFormaPagoCxp"],
					"importe" => $value["importe"],
					//"documento" => $_POST["nuevoDocumento"],
					//"observacion" => $_POST["nuevaObservacion"]
					"id_usuario_creador" => $_SESSION['id']
				);

				$respuesta = ModeloCsxp::mdlCrearCxp($datos);


				if ($respuesta == "ok") {

					$columnaSaldoActual = "saldo_actual";

					$nuevoSaldo = $value["adeudo"] - $value["importe"];

					$cambiarSaldoActual = ModeloCompras::mdlActualizarCompra($columnaSaldoActual, $nuevoSaldo, $id_compra, $_SESSION['id']);

					if($cambiarSaldoActual == "ok"){
						echo "<script>
							var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 5000
							});

							toastr.success('A la compra: ".$id_compra." se le ha creado con exito su respectivo abono');
						</script>";
					}else{
						echo "<script>
							var Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 5000
							});

							toastr.error('A la compra: ".$id_compra." no se le ha creado su respectivo abono');
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

						toastr.error('compra: ".$id_compra." error de creación de cxp');
					</script>";
				}
			}
		}//ISSET LISTA DE CUENTAS POR COBRAR
	}







	static public function ctrCrearCxp(){

		if(isset($_POST["nuevoImporte"])){

			$id_compra = $_POST["nuevoIdCompra"];

			$nuevoSaldo = $_POST['saldoActual'] - $_POST['nuevoImporte'];

			$cambiarSaldoActual = ModeloCompras::mdlActualizarSaldoActual($nuevoSaldo, $id_compra);

			if ($cambiarSaldoActual == 'ok') {

				$datos = array("id_compra" => $_POST["nuevoIdCompra"],
					"id_proveedor" => $_POST["nuevoIdProveedor"],
					"id_metodo" => $_POST["nuevoIdFormaPagoCxp"],
					"importe" => $_POST["nuevoImporte"],
					"documento" => $_POST["nuevoDocumento"],
					"observacion" => $_POST["nuevaObservacion"]);

				$respuesta = ModeloCsxp::mdlCrearCxp($datos);

				if ($respuesta == "ok") {


					echo "<script>

					Swal.fire({
						icon: 'success',
						title: 'El abono ha sido creado con exito',
						showConfirmButton: false,
						timer: 4000
						}).then(function(result){
							window.location = 'lista-csxp';
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

	static public function ctrMostrarAdeudoTotalProveedorC($id_proveedor){

		$respuesta = ModeloCsxp::mdlMostrarAdeudoTotalProveedorC($id_proveedor);

		return $respuesta;

	}




}	
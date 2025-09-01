<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorCajas{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarCorteCaja($id_corte_caja);

		return $respuesta;

	}


    /*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarTotalesCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalesCorteCaja($id_corte_caja);

		return $respuesta;

	}

     /*=============================================
	MOSTRAR RETIROS DEL CORTE
	=============================================*/

	static public function ctrMostrarTotalRetirosCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalRetirosCorteCaja($id_corte_caja);

		return $respuesta;

	}





	 /*=============================================
	MOSTRAR RETIROS DEL CORTE
	=============================================*/

	static public function ctrMostrarTotalRetirosBaulCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalRetirosBaulCorteCaja($id_corte_caja);

		return $respuesta;

	}







	 /*=============================================
	MOSTRAR RETIROS DEL CORTE
	=============================================*/

	static public function ctrMostrarTotalTarjetaDebitoRetirosCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalTarjetaDebitoRetirosCorteCaja($id_corte_caja);

		return $respuesta;

	}





	/*=============================================
	MOSTRAR DEVOLUCIONES DEL CORTE
	=============================================*/

	static public function ctrMostrarTotalDevolucionesCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalDevolucionesCorteCaja($id_corte_caja);

		return $respuesta;

	}





	/*=============================================
	MOSTRAR GARANTIAS DEL CORTE
	=============================================*/

	static public function ctrMostrarTotalGarantiasCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarTotalGarantiasCorteCaja($id_corte_caja);

		return $respuesta;

	}



	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarCorteCaja($id_corte_caja);

		return $respuesta;

	}


/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrRevisarCorteCajaActivo($id_usuario){

		$respuesta = ModeloCajas::mdlRevisarCorteCajaActivo($id_usuario);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrRevisarCorteCajaActivo2($id_usuario){

		$respuesta = ModeloCajas::mdlRevisarCorteCajaActivo2($id_usuario);

		return $respuesta;

	}









	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarRetirosCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarRetirosCorteCaja($id_corte_caja);

		return $respuesta;

	}






	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarRetiroCorteCaja($id_retiro){

		$respuesta = ModeloCajas::mdlMostrarRetiroCorteCaja($id_retiro);

		return $respuesta;

	}









	/*=============================================
	MOSTRAR RETIROS BAUL DEL CORTE DE CAJA
	=============================================*/

	static public function ctrMostrarRetirosBaulCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarRetirosBaulCorteCaja($id_corte_caja);

		return $respuesta;

	}






	/*=============================================
	MOSTRAR UN RETIRO DE BAUL
	=============================================*/

	static public function ctrMostrarRetiroBaulCorteCaja($id_retiro){

		$respuesta = ModeloCajas::mdlMostrarRetiroBaulCorteCaja($id_retiro);

		return $respuesta;

	}





	/*=============================================
	MOSTRAR VRENTA INICIAL Y FINAL DEUN CORTE
	=============================================*/

	static public function ctrMostrarVentaInicialCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarVentaInicialCorteCaja($id_corte_caja);

		return $respuesta;

	}

	static public function ctrMostrarVentaFinalCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarVentaFinalCorteCaja($id_corte_caja);

		return $respuesta;

	}










	/*=============================================
	MOSTRAR DEVOLCION INICIAL Y FINAL DE UN CORTE
	=============================================*/

	static public function ctrMostrarDevolucionInicialCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarDevolucionInicialCorteCaja($id_corte_caja);

		return $respuesta;

	}

	static public function ctrMostrarDevolucionFinalCorteCaja($id_corte_caja){

		$respuesta = ModeloCajas::mdlMostrarDevolucionFinalCorteCaja($id_corte_caja);

		return $respuesta;

	}

	




	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearCorteCaja($apertura){



		if(isset($apertura)){


			$datos = array("apertura" => $apertura,
				"id_usuario_creador" => $_SESSION['id']);

			$respuesta = ModeloCajas::mdlCrearCorteCaja($datos);

			if($respuesta !== "error"){

				$id_venta = $respuesta[0];

				

				return $id_venta;
			}else{
				return "error";
			}

				/*if ($respuesta == "ok") {
					echo "<script>

						Swal.fire({
  						icon: 'success',
  						title: 'Se ha creado con exito la apertura de su caja',
  						showConfirmButton: false,
  						timer: 2000
						}).then(function(result){
						window.location = 'lista-cajas';
						});
					</script>";
				}*/

				


			}

		}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarCorteCaja(){

		if(isset($_POST["mostrarIdCorteCaja"])){

			$datos = array("id_corte_caja" => $_POST["mostrarIdCorteCaja"],
				"c0" => $_POST["cantidadCentavos"],
				"c1" => $_POST["cantidadUnPeso"],
				"c2" => $_POST["cantidadDosPesos"],
				"c5" => $_POST["cantidadCincoPesos"],
				"c10" => $_POST["cantidadDiezPesos"],
				"c20" => $_POST["cantidadVeintePesos"],
				"c50" => $_POST["cantidadCincuentaPesos"],
				"c100" => $_POST["cantidadCienPesos"],
				"c200" => $_POST["cantidadDoscientosPesos"],
				"c500" => $_POST["cantidadQuinientosPesos"],
				"c1000" => $_POST["cantidadMilPesos"],
				"id_usuario_ult_mod" => $_SESSION['id']);



			$respuesta = ModeloCajas::mdlEditarCorteCaja($datos);

			if($respuesta == "ok"){

				echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'Los cambios en su corte han sido modificado correctamente',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						
						window.location = 'caja';

						});


						</script>";

					}



				}

			}










	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrConfirmarCorteCaja($id_corte_caja){

		if(isset($id_corte_caja)){

			

			$columna1 = "estatus";

			$valor1 = 1;

			$respuesta = ModeloCajas::mdlActualizarCaja($columna1, $valor1, $id_corte_caja, $_SESSION['id']);

			if($respuesta == "ok"){

				return $respuesta;

			}	else{
				return $respuesta;
			}	
		}


	}










	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarCaja(){

		if(isset($_GET["id_caja"])){

			$tabla ="cajas";
			$datos = $_GET["id_caja"];

			

			$respuesta = ModeloCajas::mdlEliminarCaja($tabla, $datos);

			if($respuesta == "ok"){

				echo "<script>
				Swal.fire({
					icon: 'success',
					title: 'El caja ha sido eliminado con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						window.location = 'lista-cajas';
						});
						</script>";

					}		
				}


			}




	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearRetiroCorteCaja(){



		if(isset($_POST['mostrarIdCorteCajaCRCC']) && isset($_POST['nuevoImporteCRCC'])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_corte_caja = $_POST['mostrarIdCorteCajaCRCC'];
			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

				/*if($_POST["nuevoTipoRetiroCRCC"] == 1){

					$tipo_retiro = 1;

				}else{
					$tipo_retiro = 0;
				}*/

				$tipo_retiro = 0;

				$datos = array("id_corte_caja" => $id_corte_caja,
					"descripcion" => $_POST['nuevaDescripcionCRCC'],
					"importe" => $_POST['nuevoImporteCRCC'],
					"tipo_retiro" => $tipo_retiro,
					"id_usuario_creador" => $_SESSION['id']);

				$respuesta = ModeloCajas::mdlCrearRetiroCorteCaja($datos);

				if($respuesta !== "error"){

					$id_retiro = $respuesta[0];

					$traerRetiro = ControladorCajas::ctrMostrarRetiroCorteCaja($id_retiro);
					$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerRetiro['id_usuario_creador']);

					$archivo1 = $_FILES["nuevoArchivoCRCC"]["name"];

					if($archivo1 !== ""){

						$tempname1 = $_FILES["nuevoArchivoCRCC"]["tmp_name"];
						$extension1 = pathinfo($archivo1, PATHINFO_EXTENSION); 
						$folder1 = "recursos/retiros_cajas/R".$id_retiro."CC".$id_corte_caja.".".$extension1;
						$archivo_db1 = "R".$id_retiro."CC".$id_corte_caja.".".$extension1;

						if(move_uploaded_file($tempname1, $folder1)){

							$respuestaRACC = ControladorCajas::ctrActualizarRetiroCorteCaja("ruta_archivo", $archivo_db1, $id_retiro, $_SESSION['id']);
							$respuestaEACC = ControladorCajas::ctrActualizarRetiroCorteCaja("archivo", 1, $id_retiro, $_SESSION['id']);

							$descripcion = preg_replace("/[\r\n|\n|\r]+/", " ", $traerRetiro['descripcion']);

							for ($i = 1; $i < 3; $i++) {
								$impresora = $traerComputadora['imp_caja'];

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text("R E T I R O  D E  C A J A");

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("Fecha: ".$traerRetiro['fecha_creacion']);

								$printer -> feed(2);

								$printer -> text("Corte Caja: ".$id_corte_caja);

								$printer -> feed(1);

								$printer -> text("Retiro: ".$id_retiro);

								$printer -> feed(1);

								$printer -> text("=============================================");

								$printer -> feed(2);

								$printer -> text("MOTIVO: ".$descripcion);

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text("IMPORTE: $".number_format($traerRetiro['importe'], 2));

								$printer -> feed(2);

								$printer -> setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("=============================================");

								$printer -> feed(4);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text("_____________________________________________");

								$printer -> feed(1);

								$printer -> text("Firma del Cajero");

								$printer -> feed(1);

								$printer -> text($traerCajero['nombre']);

								$printer -> feed(4);

								$printer -> text("_____________________________________________");

								$printer -> feed(1);

								$printer -> text("Nombre y Firma de quien recibe");

								$printer -> feed(1);

								$printer -> cut();

								$printer -> close();

							}

							echo "<script>

							Swal.fire({
								icon: 'success',
								title: 'El retiro se ha creado con éxito',
								showConfirmButton: true
								}).then(function(result){
									window.location = 'caja';
									});
									</script>";

								}else{
									for ($i = 1; $i < 3; $i++) {

										$impresora = $traerComputadora['imp_caja'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("R E T I R O  D E  C A J A");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("Fecha: ".$traerRetiro['fecha_creacion']);

										$printer -> feed(2);

										$printer -> text("Corte Caja: ".$id_corte_caja);

										$printer -> feed(1);

										$printer -> text("Retiro: ".$id_retiro);

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(2);

										$printer -> text("MOTIVO: ".$descripcion);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("IMPORTE: $".number_format($traerRetiro['importe'], 2));

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(4);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("_____________________________________________");

										$printer -> feed(1);

										$printer -> text("Firma del Cajero");

										$printer -> feed(1);

										$printer -> text($traerCajero['nombre']);

										$printer -> feed(4);

										$printer -> text("_____________________________________________");

										$printer -> feed(1);

										$printer -> text("Nombre y Firma de quien recibe");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> close();

									}

									echo "<script>

									Swal.fire({
										icon: 'info',
										title: 'El retiro se creo con exito',
										text: 'Pero el archivo no se ha podido guardar',
										showConfirmButton: true
										});
										</script>";
									}
								}else{
									for ($i = 1; $i < 3; $i++) {

										$impresora = $traerComputadora['imp_caja'];

										$conector = new WindowsPrintConnector($impresora);

										$printer = new Printer($conector);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("R E T I R O  D E  C A J A");

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("Fecha: ".$traerRetiro['fecha_creacion']);

										$printer -> feed(2);

										$printer -> text("Corte Caja: ".$id_corte_caja);

										$printer -> feed(1);

										$printer -> text("Retiro: ".$id_retiro);

										$printer -> feed(1);

										$printer -> text("=============================================");

										$printer -> feed(2);

										$printer -> text("MOTIVO: ".$descripcion);

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("IMPORTE: $".number_format($traerRetiro['importe'], 2));

										$printer -> feed(2);

										$printer -> setJustification(Printer::JUSTIFY_LEFT);

										$printer -> text("=============================================");

										$printer -> feed(4);

										$printer -> setJustification(Printer::JUSTIFY_CENTER);

										$printer -> text("_____________________________________________");

										$printer -> feed(1);

										$printer -> text("Firma del Cajero");

										$printer -> feed(1);

										$printer -> text($traerCajero['nombre']);

										$printer -> feed(4);

										$printer -> text("_____________________________________________");

										$printer -> feed(1);

										$printer -> text("Nombre y Firma de quien recibe");

										$printer -> feed(1);

										$printer -> cut();

										$printer -> close();
									}

									echo "<script>

									Swal.fire({
										icon: 'success',
										title: 'El retiro se ha creado con éxito',
										showConfirmButton: true
										}).then(function(result){
											window.location = 'caja';
											});
											</script>";

				}//IF SI NO VIENE VACIO EL ARCHIVO (SI EXISTE ARCHIVO)

			}else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'Ha habido un error',
					footer: 'si el error permanese comuníquese con soporte para que le den solución al problema',
					showConfirmButton: true
					});
					</script>";
				}






			}

		}










		static public function ctrReimprimirTicketRetiroCorteCaja(){

			if(isset($_POST['reimprimir_ticket_retiro_corte_caja'])){

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

				$id_retiro = $_POST['reimprimir_ticket_retiro_corte_caja'];
				$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);
				$traerRetiro = ControladorCajas::ctrMostrarRetiroCorteCaja($id_retiro);
				$id_corte_caja = $traerRetiro['id_corte_caja'];
				$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerRetiro['id_usuario_creador']);

				$descripcion = preg_replace("/[\r\n|\n|\r]+/", " ", $traerRetiro['descripcion']);

				for ($i = 1; $i < 3; $i++) {
					$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("R E T I R O  D E  C A J A");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerRetiro['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);

					$printer -> feed(1);

					$printer -> text("Retiro: ".$id_retiro);

					$printer -> feed(1);

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> text("MOTIVO: ".$descripcion);

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("IMPORTE: $".number_format($traerRetiro['importe'], 2));

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Firma del Cajero");

					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");

					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
				}
			}

		}





















	/*=============================================
	CREAR RETIRO BAÚL CORTE CAJA
	=============================================*/

	static public function ctrCrearRetiroBaulCorteCaja(){



		if(isset($_POST['mostrarIdCorteCajaCRBCC']) && isset($_POST['nuevoImporteCRBCC'])){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

			$id_corte_caja = $_POST['mostrarIdCorteCajaCRBCC'];
			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);


			$datos = array("id_corte_caja" => $id_corte_caja,
				"observaciones" => $_POST['nuevaObservacionCRBCC'],
				"importe" => $_POST['nuevoImporteCRBCC'],
				"id_usuario_creador" => $_SESSION['id']);

				//var_dump($datos);

			$respuesta = ModeloCajas::mdlCrearRetiroBaulCorteCaja($datos);

			if($respuesta !== "error"){

				$id_retiro_baul = $respuesta[0];

				$traerRetiroBaul = ControladorCajas::ctrMostrarRetiroBaulCorteCaja($id_retiro_baul);

				$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerRetiroBaul['id_usuario_creador']);

				$archivo1 = $_FILES["nuevoArchivoCRBCC"]["name"];

				if($archivo1 !== ""){

					$tempname1 = $_FILES["nuevoArchivoCRBCC"]["tmp_name"];
					$extension1 = pathinfo($archivo1, PATHINFO_EXTENSION); 
					$folder1 = "recursos/retiros_cajas_baul/RB".$id_retiro_baul."CC".$id_corte_caja.".".$extension1;
					$archivo_db1 = "RB".$id_retiro_baul."CC".$id_corte_caja.".".$extension1;

					if(move_uploaded_file($tempname1, $folder1)){

						ControladorCajas::ctrActualizarRetiroBaulCorteCaja("ruta_archivo", $archivo_db1, $id_retiro_baul, $_SESSION['id']);

						ControladorCajas::ctrActualizarRetiroBaulCorteCaja("archivo", 1, $id_retiro_baul, $_SESSION['id']);

						$observaciones = preg_replace("/[\r\n|\n|\r]+/", " ", $traerRetiroBaul['observaciones']);


						for ($i = 1; $i < 3; $i++) {
					$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("R E T I R O  D E  C A J A  A  B A U L'");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerRetiroBaul['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);
					
					$printer -> feed(1);

					$printer -> text("Retiro: ".$id_retiro_baul);
					
					$printer -> feed(1);

					$printer -> text("=============================================");
					
					$printer -> feed(2);

					$printer -> text("Observaciones: ".$observaciones);
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("IMPORTE: $".number_format($traerRetiroBaul['importe'], 2));
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");
					
					$printer -> feed(1);

					$printer -> text("Firma del Cajero");
					
					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");
					
					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
				}

						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'El retiro se ha creado con éxito',
							showConfirmButton: true
							}).then(function(result){
								window.location = 'caja';
								});
								</script>";

							}else{

								for ($i = 1; $i < 3; $i++) {
					$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("R E T I R O  D E  C A J A  A  B A U L'");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerRetiroBaul['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);
					
					$printer -> feed(1);

					$printer -> text("Retiro: ".$id_retiro_baul);
					
					$printer -> feed(1);

					$printer -> text("=============================================");
					
					$printer -> feed(2);

					$printer -> text("Observaciones: ".$observaciones);
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("IMPORTE: $".number_format($traerRetiroBaul['importe'], 2));
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");
					
					$printer -> feed(1);

					$printer -> text("Firma del Cajero");
					
					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");
					
					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
				}
								
								}
							}else{

								for ($i = 1; $i < 3; $i++) {
					$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("R E T I R O  D E  C A J A  A  B A U L'");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerRetiroBaul['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);
					
					$printer -> feed(1);

					$printer -> text("Retiro: ".$id_retiro_baul);
					
					$printer -> feed(1);

					$printer -> text("=============================================");
					
					$printer -> feed(2);

					$printer -> text("Observaciones: ".$observaciones);
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("IMPORTE: $".number_format($traerRetiroBaul['importe'], 2));
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");
					
					$printer -> feed(1);

					$printer -> text("Firma del Cajero");
					
					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");
					
					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
				}

								echo "<script>

								Swal.fire({
									icon: 'success',
									title: 'El retiro se ha creado con éxito',
									showConfirmButton: true
									}).then(function(result){
										window.location = 'caja';
										});
										</script>";

				}//IF SI NO VIENE VACIO EL ARCHIVO (SI EXISTE ARCHIVO)

			}else{
				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'Ha habido un error',
					footer: 'si el error permanese comuníquese con soporte para que le den solución al problema',
					showConfirmButton: true
					});
					</script>";
				}






			}

		}










		static public function ctrReimprimirTicketRetiroBaulCorteCaja(){

			if(isset($_POST['reimprimir_ticket_retiro_baul_corte_caja'])){

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

				$id_retiro_baul = $_POST['reimprimir_ticket_retiro_baul_corte_caja'];
				$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);
				$traerRetiroBaul = ControladorCajas::ctrMostrarRetiroBaulCorteCaja($id_retiro_baul);
				$id_corte_caja = $traerRetiroBaul['id_corte_caja'];
				$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerRetiroBaul['id_usuario_creador']);

				$observaciones = preg_replace("/[\r\n|\n|\r]+/", " ", $traerRetiroBaul['observaciones']);


				for ($i = 1; $i < 3; $i++) {
					$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("R E T I R O  D E  C A J A  A  B A U L'");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerRetiroBaul['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);
					
					$printer -> feed(1);

					$printer -> text("Retiro: ".$id_retiro_baul);
					
					$printer -> feed(1);

					$printer -> text("=============================================");
					
					$printer -> feed(2);

					$printer -> text("Observaciones: ".$observaciones);
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("IMPORTE: $".number_format($traerRetiroBaul['importe'], 2));
					
					$printer -> feed(2);
					
					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");
					
					$printer -> feed(1);

					$printer -> text("Firma del Cajero");
					
					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");
					
					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
			}
			
		}

	}




















		static public function ctrReimprimirTicketCorteCaja(){

			if(isset($_POST['reimprimir_ticket_corte_caja'])){

				$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

				$id_corte_caja = $_POST['reimprimir_ticket_corte_caja'];

				$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

				$traerCorteCaja = ControladorCajas::ctrMostrarCorteCaja($id_corte_caja);

				$traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerCorteCaja['id_usuario_creador']);

				$traerTotalesCC = ControladorCajas::ctrMostrarTotalesCorteCaja($id_corte_caja);

				$traerTotalRetiros = ControladorCajas::ctrMostrarTotalRetirosCorteCaja($id_corte_caja);

				$traerTotalRetirosBaul = ControladorCajas::ctrMostrarTotalRetirosBaulCorteCaja($id_corte_caja);

				$traerTotalDevoluciones = ControladorCajas::ctrMostrarTotalDevolucionesCorteCaja($id_corte_caja);

				$traerTotalGarantias = ControladorCajas::ctrMostrarTotalGarantiasCorteCaja($id_corte_caja);

				$traerRetirosCC = ControladorCajas::ctrMostrarRetirosCorteCaja($id_corte_caja);

				$traerRetirosDebitoCC = ControladorCajas::ctrMostrarTotalTarjetaDebitoRetirosCorteCaja($id_corte_caja);

				$total_ventas = $traerTotalesCC['sumaEfectivoVentas'] + $traerTotalesCC['sumaTarjetaDebitoVentas'] + $traerTotalesCC['sumaTarjetaCreditoVentas'] + $traerTotalesCC['sumaTransferenciaVentas'];

				$total_efectivo = $traerTotalesCC['sumaEfectivoVentas'] - $traerTotalRetiros['sumaImportesRetiros'] - $traerTotalRetirosBaul['sumaImportesRetirosBaul'] - $traerTotalDevoluciones['sumaImportesDevoluciones'] - $traerTotalGarantias['sumaImportesGarantias'];

				$c0 = $traerCorteCaja['c0'] * 0.5;
				$c1 = $traerCorteCaja['c1'] * 1;
				$c2 = $traerCorteCaja['c2'] * 2;
				$c5 = $traerCorteCaja['c5'] * 5;
				$c10 = $traerCorteCaja['c10'] * 10;
				$c20 = $traerCorteCaja['c20'] * 20;
				$c50 = $traerCorteCaja['c50'] * 50;
				$c100 = $traerCorteCaja['c100'] * 100;
				$c200 = $traerCorteCaja['c200'] * 200;
				$c500 = $traerCorteCaja['c500'] * 500;
				$c1000 = $traerCorteCaja['c1000'] * 1000;



				$traerVentaInicial = ControladorCajas::ctrMostrarVentaInicialCorteCaja($id_corte_caja);


				$traerVentaFinal = ControladorCajas::ctrMostrarVentaFinalCorteCaja($id_corte_caja);


				$traerDevolucionInicial = ControladorCajas::ctrMostrarDevolucionInicialCorteCaja($id_corte_caja);


				$traerDevolucionFinal = ControladorCajas::ctrMostrarDevolucionFinalCorteCaja($id_corte_caja);


				$impresora = $traerComputadora['imp_caja'];

					$conector = new WindowsPrintConnector($impresora);

					$printer = new Printer($conector);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("C O R T E  D E  C A J A");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Fecha: ".$traerCorteCaja['fecha_creacion']);

					$printer -> feed(2);

					$printer -> text("Corte Caja: ".$id_corte_caja);

					$printer -> feed(1);

					$printer -> text("Cajer@: ".$traerCajero['nombre']);

					$printer -> feed(1);

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> text("EFECTIVO: $".number_format($traerTotalesCC['sumaEfectivoVentas'], 2));

					$printer -> feed(2);

					$printer -> text("TARJERTA DEBITO: $".number_format($traerTotalesCC['sumaTarjetaDebitoVentas'], 2));

					$printer -> feed(2);

					$printer -> text("RETIROS DEBITO PERSONAL(+): $".number_format($traerRetirosDebitoCC['sumaImportesRetiros'], 2));

					$printer -> feed(2);

					$printer -> text("TARJETA CREDITO: $".number_format($traerTotalesCC['sumaTarjetaCreditoVentas'], 2));

					$printer -> feed(2);

					$printer -> text("TRANSFERENCIA: $".number_format($traerTotalesCC['sumaTransferenciaVentas'], 2));

					$printer -> feed(2);

					$printer -> text("TOTAL VENTAS: $".number_format($total_ventas, 2));

					$printer -> feed(2);

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> text("EFECTIVO +: $".number_format($traerTotalesCC['sumaEfectivoVentas'], 2));

					$printer -> feed(2);

					$printer -> text("GASTOS -: $".number_format($traerTotalRetiros['sumaImportesRetiros'], 2));

					$printer -> feed(2);

					$printer -> text("BAUL -: $".number_format($traerTotalRetirosBaul['sumaImportesRetirosBaul'], 2));

					$printer -> feed(2);

					$printer -> text("DEVOLUCIONES -: $".number_format($traerTotalDevoluciones['sumaImportesDevoluciones'], 2));

					$printer -> feed(2);

					$printer -> text("GARANTIAS -: $".number_format($traerTotalGarantias['sumaImportesGarantias'], 2));

					$printer -> feed(2);

					$printer -> text("TOTAL EFECTIVO: $".number_format($total_efectivo, 2));

					$printer -> feed(2);

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("E E F E C T I V O");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("$0.5 X: ".$traerCorteCaja['c0']." = $".number_format($c0, 2));

					$printer -> feed(1);

					$printer -> text("$1 X: ".$traerCorteCaja['c1']." = $".number_format($c1, 2));

					$printer -> feed(1);

					$printer -> text("$2 X: ".$traerCorteCaja['c2']." = $".number_format($c2, 2));

					$printer -> feed(1);

					$printer -> text("$5 X: ".$traerCorteCaja['c5']." = $".number_format($c5, 2));

					$printer -> feed(1);

					$printer -> text("$10 X: ".$traerCorteCaja['c10']." = $".number_format($c10, 2));

					$printer -> feed(1);

					$printer -> text("$20 X: ".$traerCorteCaja['c20']." = $".number_format($c20, 2));

					$printer -> feed(1);

					$printer -> text("$50 X: ".$traerCorteCaja['c50']." = ".number_format($c50, 2));

					$printer -> feed(1);
					$printer -> text("$100 X: ".$traerCorteCaja['c100']." = $".number_format($c100, 2));

					$printer -> feed(1);
					$printer -> text("$200 X: ".$traerCorteCaja['c200']." = $".number_format($c200, 2));

					$printer -> feed(1);
					$printer -> text("$500 X: ".$traerCorteCaja['c500']." = $".number_format($c500, 2));

					$printer -> feed(1);
					$printer -> text("$1,000 X: ".$traerCorteCaja['c1000']." = $".number_format($c1000, 2));

					$printer -> feed(1);

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("G A S T O S");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					foreach ($traerRetirosCC as $key => $value) {
						$motivo = preg_replace("/[\r\n|\n|\r]+/", " ", $value['descripcion']);
						if($value['tipo_retiro'] == 0){
							$tipo_retiro = "Caja";
						}else{
							$tipo_retiro = "Empleado";
						}

						$printer -> text($motivo);

						$printer -> feed(1);

						$printer -> text("$".number_format($value['importe'] ,2)."  ---   ".$tipo_retiro);

						$printer -> feed(2);
					}

					$printer -> text("=============================================");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("O T R O S");

					$printer -> feed(2);

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text("Folios ventas: ".$traerVentaInicial['folio']." - ".$traerVentaFinal['folio']);

					$printer -> feed(1);

					$printer -> text("Folios devoluciones: ".$traerDevolucionInicial['id_devolucion']." - ".$traerDevolucionFinal['id_devolucion']);

					$printer -> feed(2);

					$printer -> text("=============================================");

					$printer -> feed(4);

					$printer -> setJustification(Printer::JUSTIFY_CENTER);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Firma del Cajero");

					$printer -> feed(1);

					$printer -> text($traerCajero['nombre']);

					$printer -> feed(4);

					$printer -> text("_____________________________________________");

					$printer -> feed(1);

					$printer -> text("Nombre y Firma de quien recibe");

					$printer -> feed(1);

					$printer -> cut();

					$printer -> close();
			}

		}










		static public function ctrActualizarRetiroCorteCaja($columna1, $valor1, $id_retiro, $id_usuario_ult_mod){
			$respuesta = ModeloCajas::mdlActualizarRetiroCorteCaja($columna1, $valor1, $id_retiro, $id_usuario_ult_mod);

			return $respuesta;
		}









		static public function ctrActualizarRetiroBaulCorteCaja($columna, $valor, $id_retiro_baul, $id_usuario_ult_mod){
			$respuesta = ModeloCajas::mdlActualizarRetiroBaulCorteCaja($columna, $valor, $id_retiro_baul, $id_usuario_ult_mod);

			return $respuesta;
		}











	/*=============================================
	REGISTRAR DEVOLUCION A CAJA
	=============================================*/

	static public function ctrRegistrarDevolucionCorteCaja(){
		//RDCC = REGISTRAR DEVOLUCION CORTE CAJA
		if(isset($_SESSION['id_corte_caja'])){

			if (isset($_POST['mostrarIdDevolucionRDCC'])) {
				$id_corte_caja = $_SESSION['id_corte_caja'];
				$id_sucursal = $_SESSION['id_sucursal_actual'];
				$id_devolucion = $_POST['mostrarIdDevolucionRDCC'];
				$id_usuario_ult_mod = $_SESSION['id'];

				$columnaIdCorteCaja = "id_corte_caja";


				$respuesta = ControladorDevoluciones::ctrActualizarDevolucion($columnaIdCorteCaja, $id_corte_caja, $id_devolucion, $id_sucursal, $id_usuario_ult_mod);



				if($respuesta != "ok"){
					echo"<script>
					Swal.fire({
						icon: 'error',
						title: 'No se ha podido asignar la devolucion',
						showConfirmButton: false,
						timer: 2000
						});
						</script>";

					}else{
						echo"<script>
						Swal.fire({
							icon: 'success',
							title: 'La devolucion se ha asignado a tu corte de caja',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){

								window.location = 'cobro';

								});
								</script>";
							}

						}
		}//ISSER SI EXISTE UN CORTE DE CAJA
		else{
			echo"<script>
			Swal.fire({
				icon: 'error',
				title: 'Aún no has abierto tu corte de caja',
				showConfirmButton: false,
				timer: 2000
				});
				</script>";
			}
		}










	/*=============================================
	REGISTRAR GARANTIA A CAJA
	=============================================*/

	static public function ctrRegistrarGarantiaCorteCaja(){
		//RDCC = REGISTRAR DEVOLUCION CORTE CAJA
		if(isset($_SESSION['id_corte_caja'])){

			if (isset($_POST['mostrarIdGarantiaRGCC'])) {

				$id_garantia = $_POST['mostrarIdGarantiaRGCC'];

				$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

				$id_corte_caja = $_SESSION['id_corte_caja'];

				$id_sucursal = $traerGarantia['id_sucursal'];
				
				$id_usuario_ult_mod = $_SESSION['id'];

				$columnaIdCorteCaja = "id_corte_caja";


				$respuesta = ControladorGarantias::ctrActualizarGarantia($columnaIdCorteCaja, $id_corte_caja, $id_garantia, $id_sucursal, $id_usuario_ult_mod);



				if($respuesta != "ok"){
					echo"<script>
					Swal.fire({
						icon: 'error',
						title: 'No se ha podido asignar la garantía',
						showConfirmButton: false,
						timer: 2000
						});
						</script>";

					}else{
						echo"<script>
						Swal.fire({
							icon: 'success',
							title: 'La garantía se ha asignado a tu corte de caja',
							showConfirmButton: false,
							timer: 2000
							}).then(function(result){

								window.location = 'cobro';

								});
								</script>";
							}

						}
		}//ISSER SI EXISTE UN CORTE DE CAJA
		else{
			echo"<script>
			Swal.fire({
				icon: 'error',
				title: 'Aún no has abierto tu corte de caja',
				showConfirmButton: false,
				timer: 2000
				});
				</script>";
			}
		}










	}
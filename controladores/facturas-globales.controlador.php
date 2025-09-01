<?php



class ControladorFacturasGlobales{

	static public function ctrMostrarFacturaGlobal($id_factura_global){


		$respuesta = ModeloFacturasGlobales::mdlMostrarFacturaGlobal($id_factura_global);

		return $respuesta;

	}


	static public function ctrCrearFacturaGlobal(){

		if(isset($_POST["nuevaFechaInicial"]) && isset($_POST["nuevaFechaFinal"])){







			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

			$id_sucursal = $traerUsuario['id_sucursal'];

			$fecha_inicial = $_POST["nuevaFechaInicial"];
			$fecha_final = $_POST["nuevaFechaFinal"];

			/*$traerVentasFG = ModeloVentas::mdlMostrarVentasFechasFG($fecha_inicial, $fecha_final);

			if($traerVentasFG == null){
				echo "<script>

							Swal.fire({
								icon: 'error',
								title: 'No hay ventas de publico general en este rango de fecha',
								showConfirmButton: true
								}).then(function(result){
									window.location = 'lista-facturas-globales';
									});
								</script>";

				return;
			}*/

			/*$bruto = round($_POST["nuevoTotalFactuaGlobal"] / 1.16, 2);
			$impuesto = round($bruto * 0.16, 2); */

			$respuestaFolio = ModeloOtros::mdlIncrementarFolio("FC-BS");

			$folio = "FC-BS".$respuestaFolio[0];

			$bruto = round($_POST["nuevoTotalFactuaGlobal"] / 1.16, 2);
			$impuesto = round($bruto * 0.16, 2); 

			$total = $bruto + $impuesto;

			$datosCrearFacturaGlobal = array("folio" => $folio,
				"bruto" => $bruto,
				"impuesto" => $impuesto,
				"total" => $total,
				"fecha_inicial" => $_POST["nuevaFechaInicial"],
				"fecha_final" => $_POST["nuevaFechaFinal"],
				"id_periodo"=>$_POST["nuevoIdPeriodo"],
				"id_rango_mes"=>$_POST["nuevoIdRangoMes"],
				"year"=>$_POST["nuevoYear"],
				"id_forma_pago"=>$_POST["nuevoIdFormaPagoFacturaGlobal"],
				"id_cfdi"=>$_POST["nuevoIdCfdiFacturaGlobal"],
				"id_metodo_pago"=>$_POST["nuevoIdMetodoPagoFacturaGlobal"],
				"id_sucursal" => $id_sucursal,
				"id_usuario_creador" => $_SESSION['id']);

			//var_dump($datosCrearFacturaGlobal);


			$respuestaCrearFacturaGlobal = ModeloFacturasGlobales::mdlCrearFacturaGlobal($datosCrearFacturaGlobal);

			//var_dump($respuestaCrearFacturaGlobal);

			if($respuestaCrearFacturaGlobal != "error"){

				$id_factura_global = $respuestaCrearFacturaGlobal[0];

				$traerFacturaGlobal = ModeloFacturasGlobales::mdlMostrarFacturaGlobal($id_factura_global);

				/*$fecha_inicial = $traerFacturaGlobal["fecha_inicial"];
				$fecha_final = $traerFacturaGlobal["fecha_final"];

				$traerVentasFG = ModeloVentas::mdlMostrarVentasFechasFG($fecha_inicial, $fecha_final);

			var_dump($traerVentasFG);

			return;*/



			list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $total_encabezado) = ModeloFacturasGlobales::mdlTimbrarFacturaGlobal($id_factura_global);




			if($codigo_mf_numero == 0){


				$traerVentasFG = ControladorVentas::ctrInsertarFacturaGlobalVentas($fecha_inicial, $fecha_final, $id_factura_global, $id_sucursal);







				$datosTimbrada = array("id_factura_global"=>$id_factura_global,
					"uuid"=>$uuid,
					"certnumber"=>$certnumber,
					"sello"=>$sello,
					"sello_sat"=>$sello_sat,
					"cadena_timbre"=>$cadena_timbre,
					"no_certificado_sat"=>$no_certificado_sat,
					"fecha_timbrado"=>$fecha_timbrado,
					"ruta"=>$ruta,
					"id_usuario_ult_mod"=>$_SESSION['id']);

				$respuesta_datos_timbrada = ModeloFacturasGlobales::mdlFacturaGlobalTimbrada($datosTimbrada);

				if($respuesta_datos_timbrada == "ok"){

					echo "<script>
					Swal.fire({
						icon: 'success',
						title: 'La factura global ha sido timbrada',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'lista-facturas-globales';
							});
							</script>";

						}else{
							echo "<script>

							Swal.fire({
								icon: 'warning',
								title: 'Los datos de la factura global no se han podido guardar',
								showConfirmButton: true
								}).then(function(result){
									window.location = 'lista-facturas-globales';
									});
									</script>";
								}
							}else{

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
								$replace = ' ';

								$texto = str_replace($order, $replace, $codigo_mf_texto);
									//$texto = substr($codigo_mf_texto, 0, 50);

								$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);


								echo "<script>

								Swal.fire({
									icon: 'error',
									title: 'Error no.".$codigo_mf_numero."',
									showConfirmButton: true
									}).then(function(result){
										Swal.fire({
											icon: 'error',
											title: '".$texto."',
											footer: 'No se ha podido timbrar la factura',
											showConfirmButton: true
											})
											});


											</script>";

										}
									}else{
										echo "<script>

										Swal.fire({
											icon: 'error',
											title: 'No se ha podido crear la factura global',
											showConfirmButton: true
											});
											</script>";
										}




		}//ISSET RANGO DE FECHA

	}//CREAR FACTURA GLOBAL



	static public function ctrTimbrarFacturaGlobal(){

		if(isset($_POST["timbrarFacturaGlobal"])){

		$id_factura_global = $_POST["timbrarFacturaGlobal"];

		$traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);

		$id_sucursal = $traerFacturaGlobal['id_sucursal'];

		list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta, $total_encabezado) = ModeloFacturasGlobales::mdlTimbrarFacturaGlobal($id_factura_global);


			if($codigo_mf_numero == 0){


				$traerVentasFG = ControladorVentas::ctrInsertarFacturaGlobalVentas($traerFacturaGlobal['fecha_inicial'], $traerFacturaGlobal['fecha_final'], $id_factura_global, $id_sucursal);




				$datosTimbrada = array("id_factura_global"=>$id_factura_global,
					"uuid"=>$uuid,
					"certnumber"=>$certnumber,
					"sello"=>$sello,
					"sello_sat"=>$sello_sat,
					"cadena_timbre"=>$cadena_timbre,
					"no_certificado_sat"=>$no_certificado_sat,
					"fecha_timbrado"=>$fecha_timbrado,
					"ruta"=>$ruta,
					"id_usuario_ult_mod"=>$_SESSION['id']);

				$respuesta_datos_timbrada = ModeloFacturasGlobales::mdlFacturaGlobalTimbrada($datosTimbrada);

				if($respuesta_datos_timbrada == "ok"){

					echo "<script>
					Swal.fire({
						icon: 'success',
						title: 'La factura global ha sido timbrada',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'lista-facturas-globales';
							});
							</script>";

						}else{
							echo "<script>

							Swal.fire({
								icon: 'warning',
								title: 'Los datos de la factura global no se han podido guardar',
								showConfirmButton: true
								}).then(function(result){
									window.location = 'lista-facturas-globales';
									});
									</script>";
								}
							}else{

								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
								$replace = ' ';

								$texto = str_replace($order, $replace, $codigo_mf_texto);
									//$texto = substr($codigo_mf_texto, 0, 50);

								$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);


								echo "<script>

								Swal.fire({
									icon: 'error',
									title: 'Error no.".$codigo_mf_numero."',
									showConfirmButton: true
									}).then(function(result){
										Swal.fire({
											icon: 'error',
											title: '".$texto."',
											footer: 'No se ha podido timbrar la factura',
											showConfirmButton: true
											})
											});


											</script>";

										}

									}

							}










							static public function ctrMostrarVentasFacturaGlobal($id_factura_global){

								$respuesta = ModeloFacturasGlobales::mdlMostrarVentasFacturaGlobal($id_factura_global);

								return $respuesta;

							}










	static public function ctrComprimirNotasFacturaGlobal(){

		if(isset($_POST["comprimirNotasFacturaGlobal"])){

			$id_factura_global = $_POST["comprimirNotasFacturaGlobal"];

			$zip = new ZipArchive();
			// Ruta absoluta
			$nombreArchivoZip = __DIR__ . "/../recursos/facturas_globales/VFG-".$id_factura_global.".zip";

			if (!file_exists($nombreArchivoZip)){

			if (!$zip->open($nombreArchivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
			    exit("Error abriendo ZIP en $nombreArchivoZip");
			}
			// Si no hubo problemas, continuamos
			// Agregamos el script.js
			// Su ruta absoluta, como D:\documentos\codigo\script.js

			$traerNotasFacturaGlobal = ControladorFacturasGlobales::ctrMostrarVentasFacturaGlobal($id_factura_global);
			foreach ($traerNotasFacturaGlobal as $key => $row) {
				$id_venta = $row['id'];

				//var_dump($id_venta);

				$rutaAbsoluta = __DIR__ . "/../recursos/tickets/T-".$id_venta.".pdf";
			// Su nombre resumido, algo como "script.js"
			$nombre = basename($rutaAbsoluta);
			$zip->addFile($rutaAbsoluta, $nombre);
			}
			

			// No olvides cerrar el archivo
			$resultado = $zip->close();

			if ($resultado) {

			    echo'<script>window.open("vistas/modulos/descargarArchivo.php?no_archivo=4&id_factura_global='.$id_factura_global.'", "_blank");</script>';

			   

			} else {
			    echo "Error creando archivo";
			}

		}else{
			echo'<script>window.open("vistas/modulos/descargarArchivo.php?no_archivo=4&id_factura_global='.$id_factura_global.'", "_blank");</script>';
		}
					}
	}

}
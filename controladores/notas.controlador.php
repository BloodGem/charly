<?php

class ControladorNotas{

/*=============================================
	CONVERTIR NOTA A FACTURA
	=============================================*/

	static public function ctrConvertirNotaFactura(){

		if(isset($_POST["mostrarIdVenta"])){

			$traerVenta = ModeloVentas::mdlMostrarVentaCliente($_POST['mostrarIdVenta']);

			if ($traerVenta["tipo_venta"] == "NT") {

				$datos = array("id"=>$_POST["mostrarIdVenta"],
					"id_forma_pago"=>$_POST["nuevoIdFormaPagoCobro"],
					"id_cfdi"=>$_POST["nuevoIdCfdiCobro"],
					"id_metodo_pago"=>$_POST["nuevoIdMetodoPagoCobro"]);

				$respuesta = ModeloNotas::mdlConvertirNotaFactura($datos);

				if($respuesta == 'ok'){

					$respuestaFolio = ModeloOtros::mdlIncrementarFolio("FC-BS");

					$folio = "FC-BS".$respuestaFolio[0];

					ModeloVentas::mdlActualizarVenta("folio", $folio, $_POST["mostrarIdVenta"], $traerVenta['id_sucursal'], $_SESSION['id']);

					list($codigo_mf_texto, $codigo_mf_numero, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta) = ModeloVentas::mdlTimbrarVenta($traerVenta['id'], $traerVenta['productos']);



					if($codigo_mf_numero == 0){

					$datosTimbrada = array("id"=>$traerVenta['id'],
					"uuid"=>$uuid,
					"certnumber"=>$certnumber,
					"sello"=>$sello,
					"sello_sat"=>$sello_sat,
					"cadena_timbre"=>$cadena_timbre,
					"no_certificado_sat"=>$no_certificado_sat,
					"fecha_timbrado"=>$fecha_timbrado,
					"ruta"=>$ruta,
					"id_usuario_ult_mod"=>$_SESSION['id']);

					$respuesta_datos_timbrada = ModeloVentas::mdlVentaTimbrada($datosTimbrada);


						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La venta ha sido convertida de nota a factura y timbrada con exito',
							showConfirmButton: false,
							timer: 3000
							}).then(function(result){
								window.location = 'lista-notas';
								});
								</script>";

							}else{
								$order = array("'", "''", '"', '""', '{', '}', '{}', ';', "[", "]", "[]");
								$replace = ' ';

								$texto = str_replace($order, $replace, $codigo_mf_texto);

								//$numero = strlen ($texto);

								$texto = preg_replace("/[\r\n|\n|\r]+/", " ", $texto);


								//$texto = "a";


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
								}

							}




						}















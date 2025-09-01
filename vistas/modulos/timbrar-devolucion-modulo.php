
<?php

$id_devolucion = $_GET['id_devolucion'];

if($id_devolucion !== null && $id_devolucion !== ""){

	$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);


$traerDevolucion = ControladorDevoluciones::ctrMostrarDevolucion($id_devolucion);

$listaProductosDevolucion = json_decode($traerDevolucion['productos'], true);

$traerVenta = ControladorVentas::ctrMostrarVenta($traerDevolucion['id_venta']);

if ($traerVenta["tipo_venta"] == "FC") {

					list($codigo_mf_texto, $uuid, $certnumber, $sello, $sello_sat, $cadena_timbre, $no_certificado_sat, $fecha_timbrado, $ruta) = ModeloDevoluciones::mdlTimbrarDevolucion($id_devolucion);

					if($codigo_mf_texto == 0){

						$datosTimbrada = array("id_devolucion"=>$id_devolucion,
							"uuid"=>$uuid,
							"certnumber"=>$certnumber,
							"sello"=>$sello,
							"sello_sat"=>$sello_sat,
							"cadena_timbre"=>$cadena_timbre,
							"no_certificado_sat"=>$no_certificado_sat,
							"fecha_timbrado"=>$fecha_timbrado,
							"ruta"=>$ruta);

						ModeloDevoluciones::mdlDevolucionTimbrada($datosTimbrada);

					echo "
						<script>
						const URLPlugin = 'http://localhost:8000'
						const init = async () => {
							imprimirHolaMundo('".$traerComputadora['imp_devoluciones']."');
						}


						const imprimirHolaMundo = async (nombreImpresora) => {
							const conector = new ConectorPluginV3(URLPlugin, licencia);
							conector.Iniciar();
							conector.EstablecerAlineacion(1);
							conector.CargarImagenLocalEImprimir('C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.jpg', ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL, 400);
							conector.Feed(1);
							conector.EscribirTexto('".$traerSucursal['nombre']."');
							conector.Feed(1);
							conector.TextoSegunPaginaDeCodigos(2, 'cp850', '".$traerSucursal['direccion']." Mz.".$traerSucursal['no_interior']." Lt.".$traerSucursal['no_exterior']."');
							conector.Feed(1);
							conector.TextoSegunPaginaDeCodigos(2, 'cp850', '".$traerSucursal['colonia']."');
							conector.Feed(1);
							conector.TextoSegunPaginaDeCodigos(2, 'cp850', '".$traerSucursal['codigo_postal'].", ".$traerSucursal['ciudad'].", ".$traerSucursal['id_estado']."');
							conector.Feed(1);
							conector.EscribirTexto('".$traerSucursal['rfc']."');
							conector.Feed(1);
							conector.EscribirTexto('D E V O L U C I O N');
							conector.Feed(1);
							conector.EstablecerAlineacion(0);
							conector.TextoSegunPaginaDeCodigos(2, 'cp850', 'Devolucion: ".$id_devolucion."');
							conector.Feed(1);
							conector.EscribirTexto('=============================================');
							conector.Feed(1);";
							foreach ($listaProductosDevolucion as $key2 => $value2) {

								$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value2['id_producto']);

								$producto = preg_replace("/[\r\n|\n|\r]+/", " ", $traerProducto['descripcion_corta']);

								$cantidad = $value2["cantidad"];

								if($cantidad !== "0"){

									$total_producto = $value2["cantidad"] * $value2["precio_neto"];

									echo "
									conector.EstablecerAlineacion(0);
									conector.TextoSegunPaginaDeCodigos(2, 'cp850', '".$cantidad."  ".$producto."');
									conector.Feed(1);
									conector.EstablecerAlineacion(0);
									conector.EscribirTexto('".$traerProducto['ubicacion']."  ".$traerProducto['clave_producto']."    ');
									conector.EscribirTexto('$".number_format($value2["precio_neto"],2)."   $".number_format($total_producto,2)."');	
									conector.Feed(2);
									";
								}
							}
							echo "
							conector.EstablecerAlineacion(2);
							conector.EscribirTexto('TOTAL: $".number_format($traerDevolucion["total"],2)."');
							conector.Feed(1);
							conector.EstablecerAlineacion(0);
							conector.EscribirTexto('=============================================');
							conector.Feed(2);
							conector.EstablecerAlineacion(0);
							conector.EscribirTexto('UUID relacionado : ".$traerVenta['uuid']."');
							conector.Feed(2);
							conector.EscribirTexto('Sello Digital del CFDI : ".$sello."');
							conector.Feed(2);
							conector.EscribirTexto('Sello del SAT : ".$sello_sat."');
							conector.Feed(2);
							conector.EscribirTexto('Cadena Original del Complemento de Certficación Digital del SAT : ".$cadena_timbre."');
							conector.Feed(2);
							conector.EscribirTexto('NO. Serie Certificado SAT : ".$no_certificado_sat."');
							conector.Feed(2);
							conector.EscribirTexto('Fecha y Hora de Certificación : ".$fecha_timbrado."');
							conector.Feed(2);
							conector.EstablecerAlineacion(1);
							conector.EscribirTexto('Regrese pronto');
							conector.Feed(5);
							conector.CorteParcial();
							const respuesta = await conector
							.imprimirEn(nombreImpresora);
						}

						init();
						</script>";








						echo "<script>

						Swal.fire({
							icon: 'success',
							title: 'La devolucion ha sido generada y timbrada con exito',
							showConfirmButton: true
							}).then(function(result){
								window.close();
								});
							</script>";

						}else{

							echo "<script>

							Swal.fire({
								icon: 'error',
								title: '".$codigo_mf_texto."',
								showConfirmButton: true
								}).then(function(result){
									Swal.fire({
										icon: 'success',
										title: 'La devolucion no.".$id_devolucion." ha sido generada con exito',
										showConfirmButton: true
										}).then(function(result){
											window.close();
											});
											});
											</script>";	
					}//si la devolucion fue generada correctamente

				}	
}



?>




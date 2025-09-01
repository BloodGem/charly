
<?php

//error_reporting(0);
session_start();
require_once "../../../modelos/conexion.php";
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/partcom.controlador.php";
require_once "../../../modelos/partcom.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


$id_compra = $_POST["id_compra"];


                    /*$traerCompra = ControladorCompras::ctrMostrarCompras($columnaIdCompra, $id_compra);*/


                    $partidasCompra = ControladorPartCom::ctrMostrarPartidasCompra($id_compra);

                    foreach ($partidasCompra as $key => $value) {

                      $importe_devolucion = $value['cant_dev'] * $value['precio'];

                      $precio_unitario = number_format(($value['precio']/1.16), 2);

                      $traerProducto = ControladorProductos::ctrMostrarProducto($value['id_producto']);

                      echo'<div class="row">
                              <div class="col-4">
                              <input type="text" class="form-control nuevaClaveProducto" value="'.$traerProducto['descripcion_corta'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-2">
                              <input type="text" class="form-control nuevaDescripcionProducto" id_partcom="'.$value['id_partcom'].'" id_producto="'.$value['id_producto'].'" placeholder="" name="agregarProducto" value="'.$traerProducto['clave_producto'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divAdevolver">
                              <input type="number" class="form-control ingresoADevolver" name="ingresoADevolver" min="0" value="0" required>
                              </div>
                              <div class="col-1 divCantidadTotalDevuelta">
                              <input type="number" class="form-control ingresoCantidadTotalDevuelta" name="ingresoCantidadTotalDevuelta" value="'.$value['cant_dev'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divCantidadComprada">
                              <input type="number" class="form-control ingresoCantidadComprada" name="ingresoCantidadComprada" value="'.$value['cantidad'].'" tabindex="-1" readonly>
                              </div>
                              <div class="divPrecioUnitario">
                              <input type="hidden" class="form-control ingresoPrecioUnitario" name="ingresoPrecioUnitario" value="'.$precio_unitario.'" tabindex="-1" readonly>
                              </div>


                              <div class="divDescuento">
                              <input type="hidden" class="form-control ingresoDescuento" name="ingresoDescuento" value="'.$value['descuento'].'" tabindex="-1" readonly>
                              </div>
                              <div class="divImpuesto">
                              <input type="hidden" class="form-control ingresoImpuesto" name="ingresoImpuesto" value="16" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divPrecioNeto">
                              <input type="number" class="form-control ingresoPrecioNeto" name="ingresoPrecioNeto" value="'.$value['precio'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divTotalADevolver">
                              <input type="number" class="form-control ingresoTotalADevolver" name="ingresoTotalADevolver" value="0" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divImporteDevolucion">
                              <input type="number" class="form-control ingresoImporteDevolucion" name="ingresoImporteDevolucion" value="'.$importe_devolucion.'" tabindex="-1" readonly>
                              </div>
                              </div>';
                    }

                

                   ?>
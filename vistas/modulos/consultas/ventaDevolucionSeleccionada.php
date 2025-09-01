
<?php

//error_reporting(0);
session_start();
require_once "../../../modelos/conexion.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


$id_venta = $_POST["id_venta"];

$columnaIdVenta = "id";


                    /*$traerVenta = ControladorVentas::ctrMostrarVentas($columnaIdVenta, $id_venta);*/


                    $partidasVenta = ControladorVentas::ctrMostrarPartidasVenta($id_venta);

                    foreach ($partidasVenta as $key => $value) {

                      $importe_devolucion = $value['cant_dev'] * $value['precio_neto'];

                      

                      $traerProducto = ControladorProductos::ctrMostrarProducto($value['id_producto']);

                      echo'<div class="row">
                              <div class="col-4">
                              <input type="text" class="form-control nuevaClaveProducto" value="'.$traerProducto['descripcion_corta'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-2">
                              <input type="text" class="form-control nuevaDescripcionProducto" id_partvta="'.$value['id_partvta'].'" id_producto="'.$value['id_producto'].'" placeholder="" name="agregarProducto" value="'.$traerProducto['clave_producto'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divAdevolver">
                              <input type="number" class="form-control ingresoADevolver" name="ingresoADevolver" min="0" value="0" required>
                              </div>
                              <div class="col-1 divCantidadTotalDevuelta">
                              <input type="number" class="form-control ingresoCantidadTotalDevuelta" name="ingresoCantidadTotalDevuelta" value="'.$value['cant_dev'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divCantidadVendida">
                              <input type="number" class="form-control ingresoCantidadVendida" name="ingresoCantidadVendida" value="'.$value['cantidad'].'" tabindex="-1" readonly>
                              </div>
                              <div class="divPrecioUnitario">
                              <input type="hidden" class="form-control ingresoPrecioUnitario" name="ingresoPrecioUnitario" value="'.$value['precio_unitario'].'" tabindex="-1" readonly>
                              </div>


                              <div class="divDescuento">
                              <input type="hidden" class="form-control ingresoDescuento" name="ingresoDescuento" value="'.$value['descuento'].'" tabindex="-1" readonly>
                              </div>
                              <div class="divImpuesto">
                              <input type="hidden" class="form-control ingresoImpuesto" name="ingresoImpuesto" value="'.$value['impuesto'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divPrecioNeto">
                              <input type="number" class="form-control ingresoPrecioNeto" name="ingresoPrecioNeto" value="'.$value['precio_neto'].'" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divTotalADevolver">
                              <input type="number" class="form-control ingresoTotalADevolver" name="ingresoTotalADevolver" value="0" tabindex="-1" readonly>
                              </div>
                              <div class="col-1 divImporteDevolucion">
                              <input type="number" class="form-control ingresoImporteDevolucion" name="ingresoImporteDevolucion" value="'.$importe_devolucion.'" tabindex="-1" readonly>
                              </div>
                              </div>';
                    }

                  //$listaProductos = json_decode($traerVenta["productos"], true);

                /*foreach ($listaProductos as $key => $value) {

                  echo'<div class="row">
                              <div class="col-1">
                              <button type="button" class="btn btn-danger quitarProducto" id_producto="'.$value['id'].'" accesskey="q"><i class="fa fa-times"></i></button>
                              </div>
                              <div class="col-3">
                              <input type="text" class="form-control nuevaDescripcionProducto" id_producto="'.$value['id'].'" placeholder="" name="agregarProducto" value="'.$value['descripcion'].'" readonly>
                              </div>
                              <div class="col-2 ingresoCantidad">
                              <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value['cantidad'].'" stock="'.$value['cantidad'].'" required>
                              </div>
                              <div class="col-2 ingresoDescuento">
                              <input type="number" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'.$value['descuento'].'" descuento="'.$value['descuento'].'">
                              </div>
                              </div>';
                }*/


                   ?>
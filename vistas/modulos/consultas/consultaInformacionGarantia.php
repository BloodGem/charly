<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/garantias.controlador.php";
require_once "../../../modelos/garantias.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
//require_once "conexion.php";


$id_garantia = $_POST["id_garantia"];

//var_dump($id_resurtido);
    
$traerGarantia = ControladorGarantias::ctrMostrarGarantia($id_garantia);

$traerVenta = ControladorVentas::ctrMostrarVenta($traerGarantia['id_venta']);

$traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerGarantia['id_proveedor']);

$traerProducto = ControladorProductos::ctrMostrarProducto($traerGarantia['id_producto']);
echo '<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Reclamación</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Validación Garantía a cliente</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Envio de productos al proveedor</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <table>
                      <tr>
                        <th>Garantia:</th>
                        <td>'.$id_garantia.'</td>
                      </tr>
                      <tr>
                        <th>Venta:</th>
                        <td>'.$traerGarantia['id_venta'].' --- '.$traerVenta['folio'].'</td>
                      </tr>
                      <tr>
                        <th>Producto:</th>
                        <td>'.$traerProducto['clave_producto'].'  --- '.$traerProducto['descripcion_corta'].'</td>
                      </tr>
                      <tr>
                        <th>Fecha reclamación:</th>
                        <td>'.$traerGarantia['fecha_creacion'].'</td>
                      </tr>
                      <tr>
                        <th>Fecha probable:</th>
                        <td>'.$traerGarantia['fecha_probable'].'</td>
                      </tr>
                      <tr>
                        <th>Descripción falla:</th>
                        <td>'.$traerGarantia['descripcion_falla'].'</td>
                      </tr>
                      <tr>
                        <th>Nombre del cliente:</th>
                        <td>'.$traerGarantia['nombre_cliente'].'</td>
                      </tr>
                    </table>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <table>
                      <tr>
                        <th>¿Quién autoriza?:</th>
                        <td>';

                        if($traerGarantia['quien_autoriza'] == 1){
                          echo 'Proveedor';
                        }else if($traerGarantia['quien_autoriza'] == 2){
                          echo 'Sucursal';
                        }

                        echo'</td>
                      </tr>
                    </table>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <table>
                      <tr>
                        <th>Proveedor:</th>
                        <td>'.$traerProveedor['nombre'].'</td>
                      </tr>
                      <tr>
                        <th>Fecha envio:</th>
                        <td>'.$traerGarantia['fecha_envio'].'</td>
                      </tr>
                      <tr>
                        <th>Fecha regreso:</th>
                        <td>'.$traerGarantia['fecha_regreso'].'</td>
                      </tr>
                      <tr>
                        <th>Valida garantía:</th>
                        <td>';

                        if($traerGarantia['valida_garantia'] == 1){
                          echo 'Producto (Pieza)';
                        }else if($traerGarantia['valida_garantia'] == 2){
                          echo 'Efectivo (Dinero)';
                        }

                        echo '</td>
                      </tr>
                      <tr>
                        <th>Obsercaciones:</th>
                        <td>'.$traerGarantia['observaciones'].'</td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>';



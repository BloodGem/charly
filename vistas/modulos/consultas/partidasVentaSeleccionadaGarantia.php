


<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../modelos/partvta.modelo.php";

//require_once "conexion.php";


$id_venta = $_POST["id_venta"];

//var_dump($id_resurtido);
    
$partidas_venta = ModeloPartvta::mdlMostrarPartidasVenta($id_venta);

echo '<table class="table table-bordered table-hover" id="tablaPartidasVentaSeleccionada">
            <thead>
                  <tr>
                    <th style="text-align: center;">Id producto</th>
                    <th style="text-align: center;">Clave producto</th>
                    <th style="text-align: center;">Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Cantidad Dev.</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    foreach ($partidas_venta as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

$total_cant_pu = $value["cantidad"] * $value["precio_neto"];

$cantidad_disponible = $value["cantidad"] - $value["cant_dev"];

        echo '<tr>
    

    <td>
    '.$value["id_producto"].'
    </td>
    <td>
    '.$traerProducto["clave_producto"].'
    </td>
    <td>
    '.$traerProducto["descripcion_corta"].'
    </td>
    <td style="text-align: right;">
    '.number_format($value["cantidad"], 0).'
    </td>
    <td style="text-align: right;">
    '.number_format($value["cant_dev"], 0).'
    </td>
    <td style="text-align: right;">
    $'.number_format($value["precio_neto"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($total_cant_pu, 2).'
    </td>
    <td><div class="btn-group">
            <button class="btn btn-info btnSeleccionaProductoVenta" id_producto="'.$value["id_producto"].'" clave_producto="'.$traerProducto["clave_producto"].'" cantidad_disponible="'.$cantidad_disponible.'" precio_neto="'.$value["precio_neto"].'">Seleccionar</button>
        </div></td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th style="text-align: center;">Id producto</th>
                    <th style="text-align: center;">Clave producto</th>
                    <th style="text-align: center;">Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Cantidad Dev.</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Acciones</th>
                  </tr>
                  </tfoot>
        </table>';



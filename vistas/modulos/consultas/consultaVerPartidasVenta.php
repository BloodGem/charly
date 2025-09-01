


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

echo '<table class="table table-bordered table-hover" id="tablaPartidasVenta">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Unitario</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_venta = 0;
    foreach ($partidas_venta as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

$total_cant_pu = $value["cantidad"] * $value["precio_neto"];

$total_venta = $total_venta + $total_cant_pu;

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
    $'.number_format($value["precio_neto"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($total_cant_pu, 2).'
    </td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Unitario</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total venta = $'.number_format($total_venta, 2).'</h1>';



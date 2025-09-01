


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

require_once "../../../modelos/partdev.modelo.php";

//require_once "conexion.php";


$id_devolucion = $_POST["id_devolucion"];

//var_dump($id_resurtido);
    
$partidas_devolucion = ModeloPartdev::mdlMostrarPartidasDevolucion($id_devolucion);

echo '<table class="table table-bordered table-hover" id="tablaPartidasDevolucion">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Unitario</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_devolucion = 0;
    foreach ($partidas_devolucion as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

$total_cant_pu = $value["cantidad"] * ($value["precio_unitario"]+(($value["precio_unitario"]*16)/100));

$neto = ($value["precio_unitario"]+(($value["precio_unitario"]*16)/100));

$total_devolucion = $total_devolucion + ($total_cant_pu);

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
    $'.number_format($value["precio_unitario"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($neto, 2).'
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
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total devolucion = $'.number_format($total_devolucion, 2).'</h1>';



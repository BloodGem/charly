


<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


//require_once "conexion.php";


$id_factura_global = $_POST["id_factura_global"];

//var_dump($id_resurtido);
    
$ventas_factura_global = ModeloVentas::mdlMostrarVentasFG($id_factura_global);

echo '<table class="table table-bordered table-hover" id="tablaVentasFacturaGlobal">
            <thead>
                  <tr>
                    <th>Id venta</th>
                    <th>Fecha</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_ventas = 0;
    foreach ($ventas_factura_global as $key => $value) {

      $total_ventas = $total_ventas + $value["total"];

        echo '<tr>
    

    <td>
    '.$value["id"].'
    </td>
    <td>
    '.$value["fecha_creacion"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($value["total"], 2).'
    </td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id venta</th>
                    <th>Fecha</th>
                    <th style="text-align: right;">Total</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total ventas = $'.number_format($total_ventas, 2).'</h1>';



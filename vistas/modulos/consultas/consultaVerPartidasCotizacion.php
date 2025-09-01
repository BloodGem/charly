<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";


//require_once "conexion.php";


$id_cotizacion = $_POST["id_cotizacion"];

//var_dump($id_resurtido);
    
$traerCotizacion = ControladorCotizaciones::ctrMostrarCotizacion($id_cotizacion);

$listaProductosCotizacion = json_decode($traerCotizacion['productos'], true);

echo '<table class="table table-bordered table-hover" id="tablaPartidasCotizacion">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_cotizacion = 0;

    foreach ($listaProductosCotizacion as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id"]);


$total_cotizacion = $total_cotizacion + $value['total'];

        echo '<tr>
    

    <td>
    '.$value["id"].'
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
    $'.number_format($value["precio"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($value['total'], 2).'
    </td>
    <td style="text-align: right;">
    '.number_format($value['descuento'], 2).'%
    </td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total cotizacion = $'.number_format($total_cotizacion, 2).'</h1>';



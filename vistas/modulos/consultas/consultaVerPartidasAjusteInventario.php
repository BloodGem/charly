


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

require_once "../../../modelos/partidas-ajustes-inventario.modelo.php";

//require_once "conexion.php";


$id_ajuste_inventario = $_POST["id_ajuste_inventario"];

//var_dump($id_resurtido);
    
$partidas_ajuste_inventario = ModeloPartidasAjustesInventario::mdlMostrarPartidasAjusteInventario($id_ajuste_inventario);

echo '<table class="table table-bordered table-hover" id="tablaPartidasDevolucion">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_devolucion = 0;
    foreach ($partidas_ajuste_inventario as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

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
    </td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                  </tr>
                  </tfoot>
        </table>';

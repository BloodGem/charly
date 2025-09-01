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

require_once "../../../modelos/partcom.modelo.php";

//require_once "conexion.php";


$id_compra = $_POST["id_compra"];

//var_dump($id_resurtido);
    
$partidas_compra = ModeloPartCom::mdlMostrarPartidasCompra($id_compra);

echo '<table class="table table-bordered table-hover" id="tablaPartidasCompraSeleccionada">
            <thead>
                  <tr>
                    <th style="text-align: center;">Id producto</th>
                    <th style="text-align: center;">Clave producto</th>
                    <th style="text-align: center;">Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                    <th style="text-align: center;">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    foreach ($partidas_compra as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);


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
    $'.number_format($value["precio"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($value["total"], 2).'
    </td>
    <td style="text-align: right;">
    '.number_format($value["descuento"], 2).'
    </td>
    <td><div class="btn-group">
            <button class="btn btn-info btnSeleccionaProductoCompra" id_producto="'.$value["id_producto"].'" clave_producto="'.$traerProducto["clave_producto"].'" cantidad_disponible="'.$cantidad_disponible.'" precio_neto="'.$value["precio"].'">Seleccionar</button>
        </div></td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th style="text-align: center;">Id producto</th>
                    <th style="text-align: center;">Clave producto</th>
                    <th style="text-align: center;">Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                    <th style="text-align: center;">Acciones</th>
                  </tr>
                  </tfoot>
        </table>';
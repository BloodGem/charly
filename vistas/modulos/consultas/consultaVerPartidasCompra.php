<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../modelos/partcom.modelo.php";

//require_once "conexion.php";
$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$id_compra = $_POST["id_compra"];

//var_dump($id_resurtido);
$traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);
    
$partidas_compra = ModeloPartCom::mdlMostrarPartidasCompra($id_compra);

echo '<table class="table table-bordered table-hover" id="tablaPartidasCompra">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_compra = 0;
    foreach ($partidas_compra as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

$total_producto = $value["cantidad"] * $value["precio"];
$total_compra = $total_compra + $total_producto;

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
    $'.number_format($total_producto, 2).'
    </td>
    <td style="text-align: right;">
    '.number_format($value["descuento"], 2).'
    </td>
    <td>';

    if($traerCompra['estatus'] != 0){
      $indiceEditarProductosExistenciasSucursales = array_search("Editar existencias sucursales",$array,true);

            if($indiceEditarProductosExistenciasSucursales !== false){

      echo '<button type="button" class="btn btn-xs btn-warning" id="btnEditarExistenciasProducto" id_producto="'.$value["id_producto"].'">Editar Precios</button>';
    }
    }

    echo'</td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">Cantidad</th>
                    <th style="text-align: right;">Precio Neto</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Descuento</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total compra = $'.number_format($total_compra, 2).'</h1>';



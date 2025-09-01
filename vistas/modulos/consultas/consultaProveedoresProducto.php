<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

$id_grupo = $traerUsuario['id_grupo'];

$traerGrupo = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($traerGrupo['permisos']);
//require_once "conexion.php";


$id_producto = $_POST["id_producto"];

$traerProveedoresProducto = ControladorProductos::ctrMostrarProveedoresProducto($id_producto);

echo '<table class="table table-bordered table-hover" id="tablaProveedoresProducto">
            <thead>
                  <tr>
                    <th>RFC</th>
                    <th>Proveedor</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    foreach ($traerProveedoresProducto as $key => $value) {

      $traerProveedor = ControladorProveedores::ctrMostrarProveedor($value["id_proveedor"]);

        echo '<tr>
    

    <td>
    '.$traerProveedor["rfc"].'
    </td>
    <td>
    '.$traerProveedor["nombre"].'
    </td>';

    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>RFC</th>
                    <th>Proveedor</th>
                  </tr>
                  </tfoot>
        </table>';
<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
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

$traerMulticlavesProducto = ControladorProductos::ctrMostrarMulticlavesProducto($id_producto);

$traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

echo '<table class="table table-bordered table-hover" id="tablaMulticlavesProducto">
            <thead>
                  <tr>
                    <th>Id</th>
                    <th>Multiclave</th>
                    <th>Múltiplo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    foreach ($traerMulticlavesProducto as $key => $value) {

        echo '<tr>
    

    <td>
    '.$value["id_multiclave"].'
    </td>
    <td>
    '.$value["multiclave"].'
    </td>
    <td>
    '.$value["multiplo_entrega"].'
    </td>';

    $indiceEliminarMulticlavesProductos = array_search("Eliminar multiclaves productos",$array,true);

                    if($indiceEliminarMulticlavesProductos !== false){

    echo'<td><button type="button" class="btn btn-sm btn-danger eliminarMulticlave" id_multiclave="'.$value["id_multiclave"].'">Eliminar</button>
    </td>';

  }
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Multiclave</th>
                    <th>Múltiplo</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>';
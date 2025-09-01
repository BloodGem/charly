<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);



$busquedaProveedores = $_POST["buscarProveedores"];


if ($busquedaProveedores != "") {
	$porcionesProveedores = explode(" ", $busquedaProveedores);
    $contadorProveedores = count($porcionesProveedores); 

    for ($iProveedores=0; $iProveedores < $contadorProveedores; $iProveedores++) { 
        $generaFiltroProveedores = $generaFiltroProveedores."nombre LIKE '%".$porcionesProveedores[$iProveedores]."%'";

        if ($iProveedores < $contadorProveedores-1) {
           $generaFiltroProveedores = $generaFiltroProveedores." AND ";
       }

   }

   $generaFiltroProveedores = $generaFiltroProveedores." OR ";

   for ($iProveedores=0; $iProveedores < $contadorProveedores; $iProveedores++) { 
    $generaFiltroProveedores = $generaFiltroProveedores."rfc LIKE '%".$porcionesProveedores[$iProveedores]."%'";

    if ($iProveedores < $contadorProveedores-1) {
       $generaFiltroProveedores = $generaFiltroProveedores." AND ";
   }

}

$generaFiltroProveedores = $generaFiltroProveedores." OR ";

for ($iProveedores=0; $iProveedores < $contadorProveedores; $iProveedores++) { 
    $generaFiltroProveedores = $generaFiltroProveedores."email LIKE '%".$porcionesProveedores[$iProveedores]."%'";

    if ($iProveedores < $contadorProveedores-1) {
       $generaFiltroProveedores = $generaFiltroProveedores." AND ";
   }

}

$consultaProveedores= "SELECT * FROM proveedores WHERE ".$generaFiltroProveedores." LIMIT 50";
}else{

	$consultaProveedores = "SELECT * FROM proveedores LIMIT 50";
}



$rsBuscadorProveedores = $conexion->query($consultaProveedores);

echo '<table class="table table-bordered table-striped" id="tablaProveedores">
                <thead>
                    <tr>
                    <th></th>
                        <th>Nombre</th>
                        <th>RFC</th>
                        <th>Email</th>
                        <th>Teléfono1</th>
                        <th>Teléfono2</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

$contador = 0;                

while($resultadoProveedores = $rsBuscadorProveedores->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    <td>
    '.$resultadoProveedores["nombre"].'
    </td>

    <td>
    '.$resultadoProveedores["rfc"].'
    </td> 
    <td>
    '.$resultadoProveedores["email"].'
    </td>
    <td>
    '.$resultadoProveedores["telefono1"].'
    </td>
    <td>
    '.$resultadoProveedores["telefono2"].'
    </td>';


    /*if ($resultadoProveedores["estatus"] != 0) {
        echo '<td><button class="btn btn-success btn-xs btnActivarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" estadoProveedor="0">ACTIVADO</button></td>';
    }else{
        echo '<td><button class="btn btn-danger btn-xs btnActivarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" estadoProveedor="1">DESACTIVADO</button></td>';
    }*/


    echo'<td class="botones"><div class="btn-group">';

    $indiceEditarProveedores = array_search("Editar proveedores",$array,true);

    if($indiceEditarProveedores == 0){

    }else if($indiceEditarProveedores !== ""){

        echo '<button class="btn btn-warning btnEditarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarProveedor">Editar</button>';

    }

    $indiceEliminarProveedores = array_search("Eliminar proveedores",$array,true);

    if($indiceEliminarProveedores == 0){

    }else if($indiceEliminarProveedores !== ""){ 

        echo '<button class="btn btn-danger btnEliminarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" accesskey="0"><i class="fa fa-times"></i></button>';

    }


    echo '</div></td>';




} 



echo '</tbody>
                <tfoot>
                    <tr>
                    <th></th>
                        <th>Nombre</th>
                        <th>RFC</th>
                        <th>Email</th>
                        <th>Teléfono1</th>
                        <th>Teléfono2</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>';

            ?>






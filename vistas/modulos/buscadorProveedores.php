<?php 
error_reporting(0);
session_start();

require_once "../../modelos/grupos.modelo.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "conexion.php";

function highlightWords($text, $word){
    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\0</span>', $text);
    return $text;
}

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
        $generaFiltroProveedores = $generaFiltroProveedores."nombre_comercial LIKE '%".$porcionesProveedores[$iProveedores]."%'";

        if ($iProveedores < $contadorProveedores-1) {
           $generaFiltroProveedores = $generaFiltroProveedores." AND ";
       }

   }



$consultaProveedores= "SELECT * FROM proveedores WHERE ".$generaFiltroProveedores." LIMIT 50";
}else{

	$consultaProveedores = "SELECT * FROM proveedores LIMIT 50";
}


$contador = 0;
$rsBuscadorProveedores = $conexion->query($consultaProveedores);  


echo '<table class="table table-bordered table-hover" id="tablaProveedores">
                <thead>
                    <tr>
                        <th>Nombre Comercial</th>
                        <th>RFC</th>
                        <th>Email</th>
                        <th>Teléfono1</th>
                        <th>Teléfono2</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

while($resultadoProveedores = $rsBuscadorProveedores->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

$nombre_comercial = $resultadoProveedores["nombre_comercial"];


    for ($iProveedores=0; $iProveedores < $contadorProveedores; $iProveedores++) {

        $texto = highlightWords($porcionesProveedores[$iProveedores], $porcionesProveedores[$iProveedores]);


            $nombre_comercial = str_replace($porcionesProveedores[$iProveedores], $texto, $nombre_comercial);
}


    echo '<tr class="contador'.$contador.'">


    <td>
    '.$nombre_comercial.'
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


    if ($resultadoProveedores["estatus"] != 0) {
        echo '<td><button class="btn btn-success btn-xs btnActivarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" estadoProveedor="0" tabindex="-1">ACTIVADO</button></td>';
    }else{
        echo '<td><button class="btn btn-danger btn-xs btnActivarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" estadoProveedor="1" tabindex="-1">DESACTIVADO</button></td>';
    }


    echo'<td><div class="btn-group">';

    $indiceEditarProveedores = array_search("Editar proveedores",$array,true);

    if($indiceEditarProveedores == 0){

    }else if($indiceEditarProveedores !== ""){

        echo '<button class="btn btn-warning btnEditarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" contador="'.$contador.'" accesskey="2" data-toggle="modal" data-target="#modalEditarProveedor">Editar</button>';

    }

    $indiceEliminarProveedores = array_search("Eliminar proveedores",$array,true);

    if($indiceEliminarProveedores == 0){

    }else if($indiceEliminarProveedores !== ""){ 

        echo '<button class="btn btn-danger btnEliminarProveedor" id_proveedor="'.$resultadoProveedores["id_proveedor"].'" accesskey="0" tabindex="-1"><i class="fa fa-times"></i></button>';

    }


    echo '</div></td>';




} 

echo'</tbody>
                <tfoot>
                    <tr>
                        <th>Nombre Comercial</th>
                        <th>Contacto</th>
                        <th>Email</th>
                        <th>Teléfono1</th>
                        <th>Teléfono2</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>';


?>






<?php 
//error_reporting(0);
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


$busquedaClientes = $_POST["buscarClientes"];


if ($busquedaClientes != "") {
	$porcionesClientes = explode(" ", $busquedaClientes);
$contadorClientes = count($porcionesClientes); 

for ($iClientes=0; $iClientes < $contadorClientes; $iClientes++) { 
$generaFiltroClientes = $generaFiltroClientes."rfc LIKE '%".$porcionesClientes[$iClientes]."%'";

if ($iClientes < $contadorClientes-1) {
	$generaFiltroClientes = $generaFiltroClientes." AND ";
}

}



$consultaClientes= "SELECT * FROM clientes WHERE ".$generaFiltroClientes." LIMIT 50";
}else{

	return;
}

$contador = 0;

$rsBuscadorClientes = $conexion->query($consultaClientes);  

echo '<table class="table table-bordered table-hover" id="tablaClientes">
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
            <tbody >
            ';

 while($resultadoClientes = $rsBuscadorClientes->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

$rfc = $resultadoClientes["rfc"];


    for ($iClientes=0; $iClientes < $contadorClientes; $iClientes++) {

        $texto = highlightWords($porcionesClientes[$iClientes], $porcionesClientes[$iClientes]);


            $rfc = str_replace($porcionesClientes[$iClientes], $texto, $rfc);
}

echo '<tr class="contador'.$contador.'">
                    

                    <td>
                    '.$resultadoClientes["nombre_comercial"].'
                    </td>

                    <td>
                    '.$rfc.'
                    </td> 
                    <td>
                    '.$resultadoClientes["email"].'
                    </td>
                    <td>
                    '.$resultadoClientes["telefono1"].'
                    </td>
                    <td>
                    '.$resultadoClientes["telefono2"].'
                    </td>';


                    if ($resultadoClientes["estatus"] != 0) {
                        echo '<td><button class="btn btn-success btn-xs btnActivarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" estadoCliente="0" tabindex="-1">ACTIVADO</button></td>';
                    }else{
                        echo '<td><button class="btn btn-danger btn-xs btnActivarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" estadoCliente="1" tabindex="-1">DESACTIVADO</button></td>';
                    }


                    echo'<td><div class="btn-group">';


    $indiceEditarClientes = array_search("Editar clientes",$array,true);

    if($indiceEditarClientes == 0){
     
    }else if($indiceEditarClientes !== ""){

                            echo '<button class="btn btn-warning btnEditarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" contador="'.$contador.'" accesskey="2" data-toggle="modal" data-target="#modalEditarCliente">Editar</button>';
                            }









    /*$indiceClientesLigados = array_search("Ver clientes ligados",$array,true);

    if($indiceClientesLigados !== false){

        echo '<button class="btn btn-warning btnClientesLigados" id_cliente="'.$resultadoClientes["id_cliente"].'">Editar</button>';
    }*/










    $indiceEliminarClientes = array_search("Eliminar clientes",$array,true);

    if($indiceEliminarClientes == 0){
     
    }else if($indiceEliminarClientes !== ""){ 
                            
                                echo '<button class="btn btn-danger btnEliminarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" accesskey="0" tabindex="-1"><i class="fa fa-times"></i></button>';

                                }
                        echo '</div></td>';

                    


 } 

 echo '</tbody>
            <tfoot>
                <tr>
            <th>Nombre Comercial</th>
            <th>RFC</th>
            <th>Email</th>
            <th>Teléfono1</th>
            <th>Teléfono2</th>
            <th>Estatus</th>
            <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';?>




                    
              
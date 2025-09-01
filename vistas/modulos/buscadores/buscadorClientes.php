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


$busquedaClientes = $_POST["buscarClientes"];


if ($busquedaClientes != "") {
	$porcionesClientes = explode(" ", $busquedaClientes);
$contadorClientes = count($porcionesClientes); 

for ($iClientes=0; $iClientes < $contadorClientes; $iClientes++) { 
$generaFiltroClientes = $generaFiltroClientes."nombre LIKE '%".$porcionesClientes[$iClientes]."%'";

if ($iClientes < $contadorClientes-1) {
	$generaFiltroClientes = $generaFiltroClientes." AND ";
}

}

$generaFiltroClientes =  $generaFiltroClientes." OR ";

for ($iClientes=0; $iClientes < $contadorClientes; $iClientes++) { 
$generaFiltroClientes = $generaFiltroClientes."rfc LIKE '%".$porcionesClientes[$iClientes]."%'";

if ($iClientes < $contadorClientes-1) {
	$generaFiltroClientes = $generaFiltroClientes." AND ";
}

}

$generaFiltroClientes =  $generaFiltroClientes." OR ";

for ($iClientes=0; $iClientes < $contadorClientes; $iClientes++) { 
$generaFiltroClientes = $generaFiltroClientes."email LIKE '%".$porcionesClientes[$iClientes]."%'";

if ($iClientes < $contadorClientes-1) {
	$generaFiltroClientes = $generaFiltroClientes." AND ";
}

}

$consultaClientes= "SELECT * FROM clientes WHERE ".$generaFiltroClientes." LIMIT 75";
}else{

	$consultaClientes = "SELECT * FROM clientes LIMIT 75";
}

$rsBuscadorClientes = $conexion->query($consultaClientes); 

echo '<table class="table-sm table-bordered table-striped" id="tablaClientes">
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
            
 while($resultadoClientes = $rsBuscadorClientes->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    

                    <td>
                    '.$resultadoClientes["nombre"].'
                    </td>

                    <td>
                    '.$resultadoClientes["rfc"].'
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


                    /*if ($resultadoClientes["estatus"] != 0) {
                        echo '<td><button class="btn btn-success btn-xs btnActivarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" estadoCliente="0">ACTIVADO</button></td>';
                    }else{
                        echo '<td><button class="btn btn-danger btn-xs btnActivarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" estadoCliente="1">DESACTIVADO</button></td>';
                    }*/


                    echo'<td class="botones"><div class="btn-group">';


    $indiceEditarClientes = array_search("Editar clientes",$array,true);

    if($indiceEditarClientes == 0){
     
    }else if($indiceEditarClientes !== ""){

                            echo '<button class="btn-sm btn-warning btnEditarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarCliente">Editar</button>';
                            }

    $indiceEliminarClientes = array_search("Eliminar clientes",$array,true);

    if($indiceEliminarClientes == 0){
     
    }else if($indiceEliminarClientes !== ""){ 
                            
                                echo '<button class="btn-sm btn-danger btnEliminarCliente" id_cliente="'.$resultadoClientes["id_cliente"].'" accesskey="0"><i class="fa fa-times"></i></button>';

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




                    
              
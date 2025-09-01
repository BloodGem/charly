<?php 
error_reporting(0);
session_start();
require_once "../../modelos/conexion.php";
require_once "../../modelos/grupos.modelo.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busquedaCompras = $_POST["buscarCompras"];


if ($busquedaCompras != "") {
    $porcionesCompras = explode(" ", $busquedaCompras);
    $contadorCompras = count($porcionesCompras); 

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."compras.id LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }

    /*$generaFiltroCompras = $generaFiltroCompras." OR ";

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."proveedores.nombre LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }*/

    /*$generaFiltroCompras = $generaFiltroCompras." OR ";

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."DATE_FORMAT(fecha,'%d-%m-%Y') LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }*/

    $consultaCompras= "SELECT compras.id, compras.estatus, proveedores.nombre, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE ".$generaFiltroCompras." id_sucursal = $id_sucursal ORDER BY estatus ASC, id DESC LIMIT 50";


}else{

    $consultaCompras = "SELECT compras.id, compras.estatus, proveedores.nombre, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE id_sucursal = $id_sucursal ORDER BY estatus ASC, id DESC LIMIT 50";

}



$rsBuscadorCompras = $conexion->query($consultaCompras);  

while($resultadoCompras = $rsBuscadorCompras->fetch_array(MYSQLI_BOTH)){ 


    echo '<tr>
    

    <td>
    '.$resultadoCompras["id"].'
    </td>
    <td>
    '.$resultadoCompras["nombre"].'
    </td>
    </td>  
    <td>
    '.$resultadoCompras["fecha"].'
    </td>

    <td><div class="btn-group">';

    $indiceConfirmarCompras = array_search("Confirmar compras",$array,true);

    if($indiceConfirmarCompras == 0){
       
    }else if($indiceConfirmarCompras !== ""){

        if($resultadoCompras["estatus"] == 1){
            

            echo '<button class="btn btn-disabled"  accesskey="2" disabled>Confirmar compra</button>';  
        }else{

            echo '<button class="btn btn-info btnConfirmarCompra" id_compra="'.$resultadoCompras["id"].'" accesskey="2">Confirmar compra</button></div>';
            
        }

                }//PERMISO PARA CONFIRMAR COMPRAS
                
                
                
                
                
                
                
                
    $indiceEditarCompras = array_search("Editar compras",$array,true);

    if($indiceEditarCompras == 0){
       
    }else if($indiceEditarCompras !== ""){

        if($resultadoCompras["estatus"] == 1){
            

            echo '<button class="btn btn-disabled" disabled>Editar</button>
                </td>';
        }else{

            echo '<button class="btn btn-warning btnEditarCompra" id_compra="'.$resultadoCompras["id"].'">Editar</button>
                </td>';
        }

                }//PERMISO PARA EDITAR COMPRAS
                
                
                

                


            } ?>




            
            
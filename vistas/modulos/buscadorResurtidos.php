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


$busquedaResurtidos = $_POST["buscarResurtidos"];


if ($busquedaResurtidos != "") {
    $porcionesResurtidos = explode(" ", $busquedaResurtidos);
    $contadorResurtidos = count($porcionesResurtidos); 

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."resurtidos.id_resurtido LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }

    /*$generaFiltroResurtidos = $generaFiltroResurtidos." OR ";

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."proveedores.nombre LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }*/

    /*$generaFiltroResurtidos = $generaFiltroResurtidos." OR ";

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."DATE_FORMAT(fecha,'%d-%m-%Y') LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }*/

    $consultaResurtidos= "SELECT resurtidos.id_resurtido, resurtidos.estatus, proveedores.nombre, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM resurtidos INNER JOIN proveedores ON resurtidos.id_proveedor = proveedores.id_proveedor WHERE ".$generaFiltroResurtidos." AND id_sucursal = $id_sucursal ORDER BY id_resurtido DESC LIMIT 50";

    //$consultaResurtidos= "SELECT * WHERE ".$generaFiltroResurtidos." ORDER BY id DESC LIMIT 50";


}else{

    $consultaResurtidos = "SELECT resurtidos.id_resurtido, resurtidos.estatus, proveedores.nombre, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM resurtidos INNER JOIN proveedores ON resurtidos.id_proveedor = proveedores.id_proveedor WHERE id_sucursal = $id_sucursal ORDER BY  id_resurtido DESC LIMIT 50";

    //$consultaResurtidos = "SELECT * FROM resurtidos WHERE resurtidos.id_sucursal ORDER BY id DESC LIMIT 50";
}



$rsBuscadorResurtidos = $conexion->query($consultaResurtidos);  

while($resultadoResurtidos = $rsBuscadorResurtidos->fetch_array(MYSQLI_BOTH)){ 


    echo '<tr>
    

    <td>
    '.$resultadoResurtidos["id_resurtido"].'
    </td>
    <td>
    '.$resultadoResurtidos["nombre"].'
    </td>
    </td>  
    <td>
    '.$resultadoResurtidos["fecha"].'
    </td>

    <td><div class="btn-group">';


    $indiceConvertirResurtidosAComprasResurtidos = array_search("Convertir resurtidos a compras",$array,true);

    if($indiceConvertirResurtidosAComprasResurtidos == 0){
       
    }else if($indiceConvertirResurtidosAComprasResurtidos !== ""){

        if($resultadoResurtidos["estatus"] == 1){
            

            echo '<button class="btn btn-disabled btnConvertirResurtidoACompra" id_compra="'.$resultadoResurtidos["id"].'" accesskey="2" disabled>ConvertirResurtidosACompras compra</button>';  
        }else{

            echo '<button class="btn btn-info btnConvertirResurtidoACompra" id_resurtido="'.$resultadoResurtidos["id_resurtido"].'" accesskey="2">Convertir a compra</button></div>';
            
        }

                }//PERMISO PARA CONVERTIR RESURTIDOS A COMPRAS
                

                


            } ?>




            
            
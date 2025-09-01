<?php 
error_reporting(0);
session_start();

require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";


/*function highlightWords($text, $word){
    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\0</span>', $text);
    return $text;
}*/

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);



$busquedaVendedores = $_POST["buscarVendedores"];

if ($busquedaVendedores != "") {
    $porcionesVendedores = explode(" ", $busquedaVendedores);
    $contadorVendedores = count($porcionesVendedores); 

    for ($iVendedores=0; $iVendedores < $contadorVendedores; $iVendedores++) { 
        $generaFiltroVendedores = $generaFiltroVendedores."nombres LIKE '%".$porcionesVendedores[$iVendedores]."%'";

        if ($iVendedores < $contadorVendedores-1) {
           $generaFiltroVendedores = $generaFiltroVendedores." AND ";
       }

   }


   $generaFiltroVendedores = $generaFiltroVendedores." OR ";

for ($iVendedores=0; $iVendedores < $contadorVendedores; $iVendedores++) { 
    $generaFiltroVendedores = $generaFiltroVendedores."apellido_p LIKE '%".$porcionesVendedores[$iVendedores]."%'";

    if ($iVendedores < $contadorVendedores-1) {
       $generaFiltroVendedores = $generaFiltroVendedores." AND ";
   }

}


$generaFiltroVendedores = $generaFiltroVendedores." OR ";

for ($iVendedores=0; $iVendedores < $contadorVendedores; $iVendedores++) { 
    $generaFiltroVendedores = $generaFiltroVendedores."apellido_m LIKE '%".$porcionesVendedores[$iVendedores]."%'";

    if ($iVendedores < $contadorVendedores-1) {
       $generaFiltroVendedores = $generaFiltroVendedores." AND ";
   }

}






$generaFiltroVendedores = $generaFiltroVendedores." OR ";

for ($iVendedores=0; $iVendedores < $contadorVendedores; $iVendedores++) { 
    $generaFiltroVendedores = $generaFiltroVendedores."codigo LIKE '%".$porcionesVendedores[$iVendedores]."%'";

    if ($iVendedores < $contadorVendedores-1) {
       $generaFiltroVendedores = $generaFiltroVendedores." AND ";
   }

}



$consultaVendedores= "SELECT * FROM vendedores WHERE ".$generaFiltroVendedores." LIMIT 50";
}else{

    $consultaVendedores = "SELECT * FROM vendedores LIMIT 50";
}


$contador = 0;
$rsBuscadorVendedores = $conexion->query($consultaVendedores);  


echo '<table class="table table-bordered table-hover" id="tablaVendedores">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>';

while($resultadoVendedores = $rsBuscadorVendedores->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

$nombre = $resultadoVendedores["nombres"].' '.$resultadoVendedores["apellido_p"].' '.$resultadoVendedores["apellido_m"];


    /*for ($iVendedores=0; $iVendedores < $contadorVendedores; $iVendedores++) {

        $texto = highlightWords($porcionesVendedores[$iVendedores], $porcionesVendedores[$iVendedores]);


            $nombre = str_replace($porcionesVendedores[$iVendedores], $texto, $nombre);
}*/


    echo '<tr class="contador'.$contador.'">


    <td>
    '.$nombre.'
    </td>
    <td>
    <img width="150px" src="QR/Vendedores/'.$resultadoVendedores["codigo"].'.png">
    </td>';



    if ($resultadoVendedores["estatus"] != 0) {
        echo '<td><button class="btn btn-success btn-xs btnActivarVendedor" id_vendedor="'.$resultadoVendedores["id_vendedor"].'" estadoVendedor="0" tabindex="-1">ACTIVADO</button></td>';
    }else{
        echo '<td><button class="btn btn-danger btn-xs btnActivarVendedor" id_vendedor="'.$resultadoVendedores["id_vendedor"].'" estadoVendedor="1" tabindex="-1">DESACTIVADO</button></td>';
    }

    echo '</tr>';

} 

echo'</tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Estatus</th>
                    </tr>
                </tfoot>
            </table>';


?>






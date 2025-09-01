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

$busquedaSubfamilias = $_POST["buscarSubfamilias"];


if ($busquedaSubfamilias != "") {
    $porcionesSubfamilias = explode(" ", $busquedaSubfamilias);
$contadorSubfamilias = count($porcionesSubfamilias); 

for ($iSubfamilias=0; $iSubfamilias < $contadorSubfamilias; $iSubfamilias++) { 
$generaFiltroSubfamilias = $generaFiltroSubfamilias."subfamilias.subfamilia LIKE '%".$porcionesSubfamilias[$iSubfamilias]."%'";

if ($iSubfamilias < $contadorSubfamilias-1) {
    $generaFiltroSubfamilias = $generaFiltroSubfamilias." AND ";
}

}


    $generaFiltroSubfamilias = $generaFiltroSubfamilias." OR ";

    for ($iSubfamilias=0; $iSubfamilias < $contadorSubfamilias; $iSubfamilias++) { 
        $generaFiltroSubfamilias = $generaFiltroSubfamilias."familias.familia LIKE '%".$porcionesSubfamilias[$iSubfamilias]."%'";

        if ($iSubfamilias < $contadorSubfamilias-1) {
            $generaFiltroSubfamilias = $generaFiltroSubfamilias." AND ";
        }

    }



$consultaSubfamilias= "SELECT subfamilias.id_subfamilia, subfamilias.subfamilia, familias.familia FROM subfamilias INNER JOIN familias ON subfamilias.id_familia = familias.id_familia WHERE ".$generaFiltroSubfamilias." LIMIT 50";
}else{

    $consultaSubfamilias = "SELECT subfamilias.id_subfamilia, subfamilias.subfamilia, familias.familia FROM subfamilias INNER JOIN familias ON subfamilias.id_familia = familias.id_familia";
}


//echo $consultaSubfamilias;

$buscardor3 = $conexion->query($consultaSubfamilias);  


echo '<br>

<table class="table table-bordered table-striped" id="tablaSubfamilias">
            <thead>
                <tr>
                    <th></th>
                    <th>Subfamilia</th>
                    <th>Familia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

                
                


$contador = 0;        

 while($resultadoSubfamilias = $buscardor3->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    <td>'.$resultadoSubfamilias["subfamilia"].'</td>
                    <td>'.$resultadoSubfamilias["familia"].'</td>
                    <td class="botones"><div class="btn-group">

                            <button class="btn btn-warning btnEditarSubfamilia" id_subfamilia="'.$resultadoSubfamilias["id_subfamilia"].'">Editar</button> 
                            
                                <button class="btn btn-danger btnEliminarSubfamilia" id_subfamilia="'.$resultadoSubfamilias["id_subfamilia"].'" accesskey="0"><i class="fa fa-times"></i></button>

                                
                        </div></td></tr>';

                    


 } 


 echo '</tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Subfamilia</th>
                    <th>Familia</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';


        ?>




                    
              
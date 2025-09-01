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



$busquedaFamilias = $_POST["buscarFamilias"];


if ($busquedaFamilias != "") {
	$porcionesFamilias = explode(" ", $busquedaFamilias);
$contadorFamilias = count($porcionesFamilias); 

for ($iFamilias=0; $iFamilias < $contadorFamilias; $iFamilias++) { 
$generaFiltroFamilias = $generaFiltroFamilias."familia LIKE '%".$porcionesFamilias[$iFamilias]."%'";

if ($iFamilias < $contadorFamilias-1) {
	$generaFiltroFamilias = $generaFiltroFamilias." AND ";
}

}

$consultaFamilias= "SELECT * FROM familias WHERE ".$generaFiltroFamilias." LIMIT 50";
}else{

	$consultaFamilias = "SELECT * FROM familias LIMIT 50";
}



$rsBuscadorFamilias = $conexion->query($consultaFamilias);

echo '<table class="table table-bordered table-striped" id="tablaFamilias">
            <thead>
                <tr>
                <th></th>
           <th>Familia</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';




$contador = 0;

 while($resultadoFamilias = $rsBuscadorFamilias->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    <td>'.$resultadoFamilias["familia"].'</td> 
                    <td class="botones"><div class="btn-group">';

                        $indiceEditarFamilias = array_search("Editar familias",$array,true);

if($indiceEditarFamilias == 0){
   
}else if($indiceEditarFamilias !== ""){

    

                            echo'<button class="btn btn-warning btnEditarFamilia" id_familia="'.$resultadoFamilias["id_familia"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarFamilia">Editar</button>';

                            } 

                            $indiceEliminarFamilias = array_search("Eliminar familias",$array,true);

if($indiceEliminarFamilias == 0){
   
}else if($indiceEliminarFamilias !== ""){
                            
                                echo '<button class="btn btn-danger btnEliminarFamilia" id_familia="'.$resultadoFamilias["id_familia"].'" accesskey="0"><i class="fa fa-times"></i></button>';

                                }

                            
                        echo'</div></td>';

                    


 } 




 echo '</tbody>
            <tfoot>
                <tr>
                <th></th>
           <th>Familia</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';?>




                    
              
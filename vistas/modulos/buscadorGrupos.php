<?php 
//error_reporting(0);
session_start();


require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "conexion.php";


$busquedaGrupos = $_POST["buscarGrupos"];

 $generaFiltroGrupos = "";

if ($busquedaGrupos != "") {
	$porcionesGrupos = explode(" ", $busquedaGrupos);
    $contadorGrupos = count($porcionesGrupos); 

    for ($iGrupos=0; $iGrupos < $contadorGrupos; $iGrupos++) { 
        $generaFiltroGrupos = $generaFiltroGrupos."nombre_grupo LIKE '%".$porcionesGrupos[$iGrupos]."%'";

        if ($iGrupos < $contadorGrupos-1) {
           $generaFiltroGrupos = $generaFiltroGrupos." AND ";
       }

   }

   $consultaGrupos= "SELECT * FROM grupos WHERE ".$generaFiltroGrupos." LIMIT 50";
}else{

	$consultaGrupos = "SELECT * FROM grupos LIMIT 50";
}



$rsBuscadorGrupos = $conexion->query($consultaGrupos);  

echo '<table class="table table-bordered table-striped" id="tablaGrupos">
            <thead>
                <tr>
           <th>Grupo</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

while($resultadoGrupos = $rsBuscadorGrupos->fetch_array(MYSQLI_BOTH)){ 



    echo '<tr>
    <td>'.$resultadoGrupos["nombre_grupo"].'</td> 
    <td><div class="btn-group">';
    
    $traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);
    
    $respuesta2 = ControladorGrupos::ctrMostrarGrupo($traerUsuario['id_grupo']);
    
    

    $array = json_decode($respuesta2['permisos']);
    

    $indiceEditarGrupos = array_search("Editar grupos",$array,true);

    if($indiceEditarGrupos == 0){
     
    }else if($indiceEditarGrupos !== ""){
        echo'<button class="btn btn-warning btnEditarGrupo" id_grupo="'.$resultadoGrupos["id_grupo"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarGrupo">Editar</button>';
    }
    
    
    $indiceEliminarGrupos = array_search("Eliminar grupos",$array,true);

    if($indiceEliminarGrupos == 0){
     
    }else if($indiceEliminarGrupos !== ""){
        
        echo '<button class="btn btn-danger btnEliminarGrupo" id_grupo="'.$resultadoGrupos["id_grupo"].'" accesskey="0"><i class="fa fa-times"></i></button>';
    }
    
    echo '</div></td>';

    


}





echo '</tbody>
            <tfoot>
                <tr>
           <th>Grupo</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';

?>






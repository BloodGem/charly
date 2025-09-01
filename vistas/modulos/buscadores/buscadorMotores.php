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



$busquedaMotores = $_POST["buscarMotores"];


if ($busquedaMotores != "") {
	$porcionesMotores = explode(" ", $busquedaMotores);
$contadorMotores = count($porcionesMotores); 

for ($iMotores=0; $iMotores < $contadorMotores; $iMotores++) { 
$generaFiltroMotores = $generaFiltroMotores."motor LIKE '%".$porcionesMotores[$iMotores]."%'";

if ($iMotores < $contadorMotores-1) {
	$generaFiltroMotores = $generaFiltroMotores." AND ";
}

}

$consultaMotores= "SELECT * FROM motores WHERE ".$generaFiltroMotores." LIMIT 50";
}else{

	$consultaMotores = "SELECT * FROM motores LIMIT 50";
}



$rsBuscadorMotores = $conexion->query($consultaMotores);

echo '<table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th></th>
           <th>Motor</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';




$contador = 0;

 while($resultadoMotores = $rsBuscadorMotores->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    <td>'.$resultadoMotores["motor"].'</td> 
                    <td class="botones"><div class="btn-group">';

                        $indiceEditarMotores = array_search("Editar motores",$array,true);

if($indiceEditarMotores == 0){
   
}else if($indiceEditarMotores !== ""){

    

                            echo'<button class="btn btn-warning btnEditarMotor" id_motor="'.$resultadoMotores["id_motor"].'">Editar</button>';

                            } 

                            $indiceEliminarMotores = array_search("Eliminar motores",$array,true);

if($indiceEliminarMotores == 0){
   
}else if($indiceEliminarMotores !== ""){
                            
                                echo '<button class="btn btn-danger btnEliminarMotor" id_motor="'.$resultadoMotores["id_motor"].'"><i class="fa fa-times"></i></button>';

                                }
                            
                        echo'</div></td>';

                    


 } 





 echo '</tbody>
            <tfoot>
                <tr>
                <th></th>
           <th>Motor</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';?>




                    
              
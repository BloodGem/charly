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

$busquedaAutos = $_POST["buscarAutos"];


if ($busquedaAutos != "") {
	$porcionesAutos = explode(" ", $busquedaAutos);
$contadorAutos = count($porcionesAutos); 

for ($iAutos=0; $iAutos < $contadorAutos; $iAutos++) { 
$generaFiltroAutos = $generaFiltroAutos."autos.auto LIKE '%".$porcionesAutos[$iAutos]."%'";

if ($iAutos < $contadorAutos-1) {
	$generaFiltroAutos = $generaFiltroAutos." AND ";
}

}

$generaFiltroAutos = $generaFiltroAutos." OR ";

    for ($iAutos=0; $iAutos < $contadorAutos; $iAutos++) { 
        $generaFiltroAutos = $generaFiltroAutos."autos.submarca LIKE '%".$porcionesAutos[$iAutos]."%'";

        if ($iAutos < $contadorAutos-1) {
            $generaFiltroAutos = $generaFiltroAutos." AND ";
        }

    }

    $generaFiltroAutos = $generaFiltroAutos." OR ";

    for ($iAutos=0; $iAutos < $contadorAutos; $iAutos++) { 
        $generaFiltroAutos = $generaFiltroAutos."motores.motor LIKE '%".$porcionesAutos[$iAutos]."%'";

        if ($iAutos < $contadorAutos-1) {
            $generaFiltroAutos = $generaFiltroAutos." AND ";
        }

    }



$consultaAutos= "SELECT autos.id_auto, autos.auto, autos.submarca, motores.motor FROM autos INNER JOIN motores ON autos.id_motor = motores.id_motor WHERE ".$generaFiltroAutos." LIMIT 50";
}else{

	$consultaAutos = "SELECT autos.id_auto, autos.auto, autos.submarca, motores.motor FROM autos INNER JOIN motores ON autos.id_motor = motores.id_motor";
}


//echo $consultaAutos;

$buscardor3 = $conexion->query($consultaAutos);  


echo '<br>

<table class="table table-bordered table-striped" id="tablaAutos">
            <thead>
                <tr>
                    <th></th>
                    <th>Auto</th>
                    <th>Versión</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

                
                


$contador = 0;        

 while($resultadoAutos = $buscardor3->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    <td>'.$resultadoAutos["auto"].'</td>
                    <td>'.$resultadoAutos["submarca"].'</td>
                    <td>'.$resultadoAutos["motor"].'</td>
                    <td class="botones"><div class="btn-group">

                            <button class="btn btn-warning btnEditarAuto" id_auto="'.$resultadoAutos["id_auto"].'">Editar</button> 
                            
                                <button class="btn btn-danger btnEliminarAuto" id_auto="'.$resultadoAutos["id_auto"].'" accesskey="0"><i class="fa fa-times"></i></button>

                                
                        </div></td></tr>';

                    


 } 


 echo '</tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Auto</th>
                    <th>Versión</th>
                    <th>Motor</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';


        ?>




                    
              
<?php 
error_reporting(0);
session_start();
require_once "../../modelos/conexion.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "conexion.php";



$busquedaGastos = $_POST["buscarGastos"];


if ($busquedaGastos != "") {
	$porcionesGastos = explode(" ", $busquedaGastos);
$contadorGastos = count($porcionesGastos); 

for ($iGastos=0; $iGastos < $contadorGastos; $iGastos++) { 
$generaFiltroGastos = $generaFiltroGastos."tipo_gasto LIKE '%".$porcionesGastos[$iGastos]."%'";

if ($iGastos < $contadorGastos-1) {
	$generaFiltroGastos = $generaFiltroGastos." AND ";
}

}

$generaFiltroGastos = $generaFiltroGastos." OR ";

for ($iGastos=0; $iGastos < $contadorGastos; $iGastos++) { 
$generaFiltroGastos = $generaFiltroGastos."comentario LIKE '%".$porcionesGastos[$iGastos]."%'";

if ($iGastos < $contadorGastos-1) {
	$generaFiltroGastos = $generaFiltroGastos." AND ";
}

}

$generaFiltroGastos = $generaFiltroGastos." OR ";

for ($iGastos=0; $iGastos < $contadorGastos; $iGastos++) { 
$generaFiltroGastos = $generaFiltroGastos."DATE_FORMAT(fecha,'%d-%m-%Y') LIKE '%".$porcionesGastos[$iGastos]."%'";

if ($iGastos < $contadorGastos-1) {
	$generaFiltroGastos = $generaFiltroGastos." AND ";
}

}

$consultaGastos= "SELECT gastos.id_gasto, tipos_gastos.tipo_gasto, DATE_FORMAT(gastos.fecha,'%d-%m-%Y') as fecha, gastos.total, gastos.comentario FROM gastos INNER JOIN tipos_gastos ON gastos.id_tipo_gasto = tipos_gastos.id_tipo_gasto WHERE (".$generaFiltroGastos.") ORDER BY fecha DESC LIMIT 50";
}else{

    $consultaGastos = "SELECT gastos.id_gasto, tipos_gastos.tipo_gasto, DATE_FORMAT(gastos.fecha,'%d-%m-%Y') as fecha, gastos.total, gastos.comentario FROM gastos INNER JOIN tipos_gastos ON gastos.id_tipo_gasto = tipos_gastos.id_tipo_gasto ORDER BY fecha DESC LIMIT 50";
}


$rsBuscadorGastos = $conexion->query($consultaGastos);  

 while($resultadoGastos = $rsBuscadorGastos->fetch_array(MYSQLI_BOTH)){ 



echo '<tr>
                    

                    
                    <td>
                    '.$resultadoGastos["fecha"].'
                    </td>
                    <td>
                    '.$resultadoGastos["tipo_gasto"].'
                    </td>
                    <td>
                    '.$resultadoGastos["total"].'
                    </td>
                    <td>
                    '.$resultadoGastos["comentario"].'
                    </td>
                    <td><div class="btn-group">';

                    $respuesta2 = ControladorGrupos::ctrMostrarGrupo($_SESSION['id_grupo']);

                        $array = json_decode($respuesta2['permisos']);

                        $indiceEditarGastos = array_search("Editar gastos",$array,true);

if($indiceEditarGastos == 0){
   
}else if($indiceEditarGastos !== ""){

                            echo '<button class="btn btn-warning btnEditarGasto" id_gasto="'.$resultadoGastos["id_gasto"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarGasto">Editar</button>';
                            }
                        $indiceEditarGastos = array_search("Editar gastos",$array,true);

if($indiceEditarGastos == 0){
   
}else if($indiceEditarGastos !== ""){ 
                            
                                echo '<button class="btn btn-danger btnEliminarGasto" id_gasto="'.$resultadoGastos["id_gasto"].'" accesskey="0"><i class="fa fa-times"></i></button>';

                            }

                                
                        echo '</div></td>';



 } ?>




                    
              
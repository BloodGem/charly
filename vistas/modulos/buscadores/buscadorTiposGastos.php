<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];



$busquedaTiposGastos = $_POST["buscarTiposGastos"];


if ($busquedaTiposGastos != "") {
	$porcionesTiposGastos = explode(" ", $busquedaTiposGastos);
$contadorTiposGastos = count($porcionesTiposGastos); 

for ($iTiposGastos=0; $iTiposGastos < $contadorTiposGastos; $iTiposGastos++) { 
$generaFiltroTiposGastos = $generaFiltroTiposGastos."tipo_gasto LIKE '%".$porcionesTiposGastos[$iTiposGastos]."%'";

if ($iTiposGastos < $contadorTiposGastos-1) {
	$generaFiltroTiposGastos = $generaFiltroTiposGastos." AND ";
}

}

$consultaTiposGastos= "SELECT * FROM tipos_gastos WHERE ".$generaFiltroTiposGastos." LIMIT 50";
}else{

	$consultaTiposGastos = "SELECT * FROM tipos_gastos LIMIT 50";
}



$rsBuscadorTiposGastos = $conexion->query($consultaTiposGastos);

echo '<table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th></th>
           <th>Tipo de Gasto</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;

 while($resultadoTiposGastos = $rsBuscadorTiposGastos->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>

                    <td>
                    '.$resultadoTiposGastos["tipo_gasto"].'
                    </td>
                    <td class="botones"><div class="btn-group">';

                    $respuesta2 = ControladorGrupos::ctrMostrarGrupo($traerUsuario['id_grupo']);

    $array = json_decode($respuesta2['permisos']);

    $indiceEditarTiposGastos = array_search("Editar tipos de gastos",$array,true);

    if($indiceEditarTiposGastos == 0){
     
    }else if($indiceEditarTiposGastos !== ""){

                            echo '<button class="btn btn-warning btnEditarTipoGasto" id_tipo_gasto="'.$resultadoTiposGastos["id_tipo_gasto"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarTipoGasto">Editar</button>';
}

    $indiceEliminarTiposGastos = array_search("Eliminar tipos de gastos",$array,true);

    if($indiceEliminarTiposGastos == 0){
     
    }else if($indiceEliminarTiposGastos !== ""){ 
                            
                                echo '<button class="btn btn-danger btnEliminarTipoGasto" id_tipo_gasto="'.$resultadoTiposGastos["id_tipo_gasto"].'" accesskey="0"><i class="fa fa-times"></i></button>';

                                }
                        echo '</div></td>';

                    


 } 



 echo '</tbody>
            <tfoot>
                <tr>
                <th></th>
           <th>Tipo de Gasto</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';



        ?>




                    
              
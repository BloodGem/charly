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

$busquedaAjustesInventario = $_POST["buscarAjustesInventario"];


if ($busquedaAjustesInventario != "") {

    /*$porcionesAjustesInventario = explode(" ", $busquedaAjustesInventario);
    $contadorAjustesInventario = count($porcionesAjustesInventario); 

    for ($iAjustesInventario=0; $iAjustesInventario < $contadorAjustesInventario; $iAjustesInventario++) { 
        $generaFiltroAjustesInventario = $generaFiltroAjustesInventario."ajustes_inventario.id_ajuste_inventario LIKE '%".$porcionesAjustesInventario[$iAjustesInventario]."%'";

        if ($iAjustesInventario < $contadorAjustesInventario-1) {
            $generaFiltroAjustesInventario = $generaFiltroAjustesInventario." AND ";
        }

    }



    $generaFiltroAjustesInventario = $generaFiltroAjustesInventario." OR ";

    for ($iAjustesInventario=0; $iAjustesInventario < $contadorAjustesInventario; $iAjustesInventario++) { 
        $generaFiltroAjustesInventario = $generaFiltroAjustesInventario."DATE_FORMAT(ajustes_inventario.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesAjustesInventario[$iAjustesInventario]."%'";

        if ($iAjustesInventario < $contadorAjustesInventario-1) {
            $generaFiltroAjustesInventario = $generaFiltroAjustesInventario." AND ";
        }

    }*/

    $consultaAjustesInventario= "SELECT ajustes_inventario.id_ajuste_inventario, ajustes_inventario.tipo_ajuste, ajustes_inventario.estatus, DATE_FORMAT(ajustes_inventario.fecha_creacion,'%d-%m-%Y') as fecha, ajustes_inventario.id_usuario_creador, ajustes_inventario.id_usuario_ult_mod FROM ajustes_inventario WHERE ajustes_inventario.id_ajuste_inventario = $busquedaAjustesInventario AND ajustes_inventario.id_sucursal = $id_sucursal";


}else{

    $consultaAjustesInventario = "SELECT ajustes_inventario.id_ajuste_inventario, ajustes_inventario.tipo_ajuste, ajustes_inventario.estatus, DATE_FORMAT(ajustes_inventario.fecha_creacion,'%d-%m-%Y') as fecha, ajustes_inventario.id_usuario_creador, ajustes_inventario.id_usuario_ult_mod FROM ajustes_inventario WHERE ajustes_inventario.id_sucursal = $id_sucursal ORDER BY ajustes_inventario.estatus ASC, ajustes_inventario.id_ajuste_inventario DESC LIMIT 75";

}


//echo $consultaAjustesInventario;
$rsBuscadorAjustesInventario = $conexion->query($consultaAjustesInventario);

echo '<table class="table-sm table-bordered table-striped" id="tablaAjustesInventario">
                <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Tipo Ajuste</th>
                    <th>Fecha</th>
                    <th>Usuario Creador</th>
                    <th>Usuario Última Edición</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;  

while($resultadoAjustesInventario = $rsBuscadorAjustesInventario->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

if($resultadoAjustesInventario['tipo_ajuste'] == 0){
    $tipo_ajuste = '<td style="color: red; font-weight:bold;">SALIDA</td>';
}else{
    $tipo_ajuste = '<td style="color: green; font-weight:bold;">ENTRADA</td>';
}

$traerCreador = ControladorUsuarios::ctrMostrarUsuario($resultadoAjustesInventario['id_usuario_creador']);

$traerUsuarioUltEdi = ControladorUsuarios::ctrMostrarUsuario($resultadoAjustesInventario['id_usuario_ult_mod']);

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoAjustesInventario["id_ajuste_inventario"].'
    </td>


    '.$tipo_ajuste.'


    <td>
    '.$resultadoAjustesInventario["fecha"].'
    </td>
    <td>
    '.$traerCreador["nombre"].'
    </td>
    <td>
    '.$traerUsuarioUltEdi["nombre"].'
    </td>

    <td class="botones"><div class="btn-group">';

    $indiceConfirmarAjustesInventario = array_search("Confirmar compras",$array,true);

    if($indiceConfirmarAjustesInventario == 0){
       
    }else if($indiceConfirmarAjustesInventario !== ""){

        if($resultadoAjustesInventario["estatus"] == 1 || $resultadoAjustesInventario["estatus"] == 2){
            

            echo '';  
        }else{
            if($resultadoAjustesInventario['tipo_ajuste'] == 0){
            echo '<button class="btn-sm btn-danger btnConfirmarAjusteInventario" id_ajuste_inventario="'.$resultadoAjustesInventario["id_ajuste_inventario"].'" tipo_ajuste="0">Confirmar ajuste</button>';
        }else{
            echo '<button class="btn-sm btn-success btnConfirmarAjusteInventario" id_ajuste_inventario="'.$resultadoAjustesInventario["id_ajuste_inventario"].'" tipo_ajuste="1">Confirmar ajuste</button>';
        }

                }//PERMISO PARA CONFIRMAR COMPRAS
        }
                
           
                
                
                
                
                
    $indiceEditarAjustesInventario = array_search("Editar ajustes de inventario",$array,true);

    if($indiceEditarAjustesInventario == 0){
       
    }else if($indiceEditarAjustesInventario !== ""){

        if($resultadoAjustesInventario["estatus"] == 1 || $resultadoAjustesInventario["estatus"] == 2){
            

            echo '';
        }else{

            echo '<button class="btn-sm btn-warning btnEditarAjusteInventario" id_ajuste_inventario="'.$resultadoAjustesInventario["id_ajuste_inventario"].'">Editar</button>
                ';
        }

                }//PERMISO PARA EDITAR COMPRAS




                $indiceVerPartidasAjusteInventario = array_search("Ver partidas ajuste de inventario",$array,true);

    if($indiceVerPartidasAjusteInventario == 0){
       
    }else if($indiceVerPartidasAjusteInventario !== ""){

        if($resultadoAjustesInventario["estatus"] == 1 || $resultadoAjustesInventario["estatus"] == 2){
            

            echo '<button class="btn-sm btn-info btnVerPartidasAjusteInventario" id_ajuste_inventario="'.$resultadoAjustesInventario["id_ajuste_inventario"].'">Ver ajuste
            </button>';
        }else{

            echo '';
        }

                }//PERMISO PARA VER PARTIDAS DE UNA COMPRA
                
                
                

               echo '</div></td>'; 


            } 



            echo '</tbody>
            <tfoot>
              <tr>
              <th></th>
                <th>No.</th>
                <th>Tipo Ajuste</th>
                <th>Fecha</th>
                <th>Usuario Creador</th>
                <th>Usuario Última Edición</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>';


    ?>




            
            
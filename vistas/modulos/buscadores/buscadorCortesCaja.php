<?php 
error_reporting(0);
session_start();

require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";

$id_usuario = $_SESSION['id'];

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
                
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);


$indiceVerTodosLosCortesDeCaja = array_search("Ver todos los cortes de caja",$array,true);




$busquedaCortesCaja = $_POST["buscarCortesCaja"];


if ($busquedaCortesCaja != "") {

    /*$porcionesCortesCaja = explode(" ", $busquedaCortesCaja);
    $contadorCortesCaja = count($porcionesCortesCaja); 

    for ($iCortesCaja=0; $iCortesCaja < $contadorCortesCaja; $iCortesCaja++) { 
        $generaFiltroCortesCaja = $generaFiltroCortesCaja."id_corte_caja LIKE '%".$porcionesCortesCaja[$iCortesCaja]."%'";

        if ($iCortesCaja < $contadorCortesCaja-1) {
           $generaFiltroCortesCaja = $generaFiltroCortesCaja." AND ";
       }

   }*/

   if($indiceVerTodosLosCortesDeCaja !== false){
        $consultaCortesCaja= "SELECT * FROM cortes_caja WHERE id_corte_caja = $busquedaCortesCaja";

        $td_creador = '<th>Creador</th>';

    }else{
        $consultaCortesCaja= "SELECT * FROM cortes_caja WHERE id_corte_caja = $busquedaCortesCaja AND id_usuario_creador = $id_usuario";

        $td_creador = '';
    }

   
}else{

    if($indiceVerTodosLosCortesDeCaja !== false){
        $consultaCortesCaja = "SELECT * FROM cortes_caja ORDER BY id_corte_caja DESC LIMIT 75";

        $td_creador = '<th>Creador</th>';

    }else{
        $consultaCortesCaja = "SELECT * FROM cortes_caja WHERE id_usuario_creador = $id_usuario ORDER BY id_corte_caja DESC LIMIT 75";

        $td_creador = '';
    }

    
}





$rsBuscadorCortesCaja = $conexion->query($consultaCortesCaja);

echo '<table class="table table-bordered table-striped" id="tablaCortesCaja">
            <thead>
                <tr>
                    <th></th>
            <th>No. corte</th>
            <th>Fecha</th>
            '.$td_creador.'
            <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;

while($resultadoCortesCaja = $rsBuscadorCortesCaja->fetch_array(MYSQLI_BOTH)){ 

    $consultaRetirosCorteCaja =  "SELECT SUM(importe) as sumaImportesRetiros FROM retiros WHERE id_corte_caja = ".$resultadoCortesCaja["id_corte_caja"]." AND estatus = 0";

    $rsRetirosCorteCaja = $conexion->query($consultaRetirosCorteCaja);  

    while($resultadoRetirosCorteCaja = $rsRetirosCorteCaja->fetch_array(MYSQLI_BOTH)){

        if($resultadoRetirosCorteCaja['sumaImportesRetiros'] == null || $resultadoRetirosCorteCaja['sumaImportesRetiros'] == ""){
            $suma = 0;
        }else{
            $suma = $resultadoRetirosCorteCaja['sumaImportesRetiros'];
        }

    
    } 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    <td>'.$resultadoCortesCaja["id_corte_caja"].'</td>
    <td>'.$resultadoCortesCaja["fecha_creacion"].'</td>';

    if($indiceVerTodosLosCortesDeCaja !== false){
        $traerCajero = ControladorUsuarios::ctrMostrarUsuario($resultadoCortesCaja['id_usuario_creador']);
        echo '<td>'.$traerCajero['nombre'].'</td>';
    }




    echo'<td class="botones"><div class="btn-group"><button class="btn-sm btn-warning btnVerCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" suma_importes_retiros="'.$suma.'" data-toggle="modal" data-target="#modalVerCorteCaja">Ver</button>';

    if ($resultadoCortesCaja["estatus"] == 0) {

        if($resultadoCortesCaja["id_usuario_creador"] == $id_usuario){
            echo'<button class="btn-sm btn-primary btnConfirmarCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" suma_importes_retiros="'.$suma.'" >Confirmar corte</button>';
        }
        
            
            echo'<button class="btn-sm btn-info btnVerRetirosCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" suma_importes_retiros="'.$suma.'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosCorteCaja">Gastos</button>';


            /*echo'<button class="btn btn-secondary btnVerRetirosBaulCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" suma_importes_retiros="'.$suma.'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosBaulCorteCaja">Baúl</button>';*/

    }else if($resultadoCortesCaja["estatus"] == 1){
        echo'
        <button class="btn-sm btn-info btnVerRetirosCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosCorteCaja">Gastos</button>';


        /*<button class="btn btn-secondary btnVerRetirosBaulCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" apertura="'.$resultadoCortesCaja["apertura"].'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosBaulCorteCaja">Baúl</button>*/



        $indiceVerVentasCorteCaja = array_search("Ver ventas corte caja",$array,true);

if($indiceVerVentasCorteCaja !== false){
                            
                                echo '<button class="btn-sm btn-dark btnVerVentasCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'">Ventas</button>';

                                }









$indiceVerDevolucionesCorteCaja = array_search("Ver devoluciones corte caja",$array,true);

if($indiceVerDevolucionesCorteCaja !== false){
                            
                                echo '<button class="btn-sm btn-success btnVerDevolucionesCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'">Devoluciones</button>';

                                }






$indiceVerGarantiasCorteCaja = array_search("Ver garantias corte caja",$array,true);

if($indiceVerGarantiasCorteCaja !== false){
                            
                                echo '<button class="btn-sm btn-danger btnVerGarantiasCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'">Garantias</button>';

                                }






        $indiceReimprimirTicketCorteCaja = array_search("Reimprimir ticket corte caja",$array,true);

if($indiceReimprimirTicketCorteCaja !== false){
                            
                                echo '<button class="btn-sm btn-primary btnReimprimirTicketCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'">Reimprimir</button>';

                                }
    }


        echo '</div></td></tr>';

    


} 



echo '</tbody>
            <tfoot>
                <tr>
                    <th></th>
            <th>No. corte</th>
            <th>Fecha</th>
            '.$td_creador.'
            <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';






/*suma_efectivo_ventas="'.$sumaEfectivo.'" suma_tarjeta_debito_ventas="'.$sumaTarjetaDebito.'" suma_tarjeta_credito_ventas="'.$sumaTarjetaCredito.'" suma_transferencia_ventas="'.$sumaTransferencia.'" accesskey="3"
suma_efectivo_ventas="'.$sumaEfectivo.'" accesskey="4"
suma_importes_retiros="'.$suma.'" suma_efectivo_ventas="'.$sumaEfectivo.'" accesskey="4"*/
?>






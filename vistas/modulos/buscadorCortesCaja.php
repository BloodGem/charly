<?php 
error_reporting(0);
session_start();
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "../../modelos/conexion2.php";

$id_usuario = $_SESSION['id'];

$busquedaCortesCaja = $_POST["buscarCortesCaja"];


if ($busquedaCortesCaja != "") {
    $porcionesCortesCaja = explode(" ", $busquedaCortesCaja);
    $contadorCortesCaja = count($porcionesCortesCaja); 

    for ($iCortesCaja=0; $iCortesCaja < $contadorCortesCaja; $iCortesCaja++) { 
        $generaFiltroCortesCaja = $generaFiltroCortesCaja."id_corte_caja LIKE '%".$porcionesCortesCaja[$iCortesCaja]."%'";

        if ($iCortesCaja < $contadorCortesCaja-1) {
           $generaFiltroCortesCaja = $generaFiltroCortesCaja." AND ";
       }

   }

   $consultaCortesCaja= "SELECT * FROM cortes_caja WHERE ".$generaFiltroCortesCaja." ORDER BY id_corte_caja DESC LIMIT 50";
}else{

    $consultaCortesCaja = "SELECT * FROM cortes_caja WHERE id_usuario = $id_usuario ORDER BY id_corte_caja DESC LIMIT 50";
}



$rsBuscadorCortesCaja = $conexion->query($consultaCortesCaja);  

while($resultadoCortesCaja = $rsBuscadorCortesCaja->fetch_array(MYSQLI_BOTH)){ 


     









    echo '<tr>
    <td>'.$resultadoCortesCaja["id_corte_caja"].'</td>
    <td>'.$resultadoCortesCaja["fecha"].'</td>
    <td><button class="btn btn-warning btnVerCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" accesskey="2" data-toggle="modal" data-target="#modalVerCorteCaja">Ver</button>';
    if ($resultadoCortesCaja["estatus"] == 0) {
        echo'<button class="btn btn-primary btnConfirmarCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'">Confirmar corte</button>
            
            <button class="btn btn-info btnVerRetirosCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosCorteCaja">Ver Retiros</button>';
    }else if($resultadoCortesCaja["estatus"] == 1){
        echo'<button class="btn btn-disabled" disabled>Confirmar corte</button>
        <button class="btn btn-info btnVerRetirosCorteCaja" id_corte_caja="'.$resultadoCortesCaja["id_corte_caja"].'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalVerRetirosCorteCaja">Ver Retiros</button>';
    }


        echo '</td></tr>';

    


} ?>






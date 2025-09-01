<?php 
//error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $_SESSION['id_sucursal_actual'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busquedaCotizaciones = $_POST["buscarCotizaciones"];


if ($busquedaCotizaciones != "") {


        

    /*$porcionesCotizaciones = explode(" ", $busquedaCotizaciones);
    $contadorCotizaciones = count($porcionesCotizaciones); 

    for ($iCotizaciones=0; $iCotizaciones < $contadorCotizaciones; $iCotizaciones++) { 
        $generaFiltroCotizaciones = $generaFiltroCotizaciones."cotizaciones.id_cotizacion LIKE '%".$porcionesCotizaciones[$iCotizaciones]."%'";

        if ($iCotizaciones < $contadorCotizaciones-1) {
           $generaFiltroCotizaciones = $generaFiltroCotizaciones." AND ";
       }

   }


   $generaFiltroCotizaciones = $generaFiltroCotizaciones." OR ";

for ($iCotizaciones=0; $iCotizaciones < $contadorCotizaciones; $iCotizaciones++) { 
    $generaFiltroCotizaciones = $generaFiltroCotizaciones."DATE_FORMAT(cotizaciones.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesCotizaciones[$iCotizaciones]."%'";

    if ($iCotizaciones < $contadorCotizaciones-1) {
       $generaFiltroCotizaciones = $generaFiltroCotizaciones." AND ";
   }

}



$generaFiltroCotizaciones = $generaFiltroCotizaciones." OR ";

for ($iCotizaciones=0; $iCotizaciones < $contadorCotizaciones; $iCotizaciones++) { 
    $generaFiltroCotizaciones = $generaFiltroCotizaciones."clientes.nombre LIKE '%".$porcionesCotizaciones[$iCotizaciones]."%'";

    if ($iCotizaciones < $contadorCotizaciones-1) {
       $generaFiltroCotizaciones = $generaFiltroCotizaciones." AND ";
   }

}*/


$consultaCotizaciones= "SELECT cotizaciones.id_cotizacion, clientes.nombre, cotizaciones.total, DATE_FORMAT(cotizaciones.fecha_creacion,'%d-%m-%Y') as fecha FROM cotizaciones INNER JOIN clientes ON cotizaciones.id_cliente = clientes.id_cliente WHERE cotizaciones.id_cotizacion = $busquedaCotizaciones AND id_sucursal = $id_sucursal";


}else{

    $consultaCotizaciones = "SELECT cotizaciones.id_cotizacion, clientes.nombre, cotizaciones.total, DATE_FORMAT(cotizaciones.fecha_creacion,'%d-%m-%Y') as fecha FROM cotizaciones INNER JOIN clientes ON cotizaciones.id_cliente = clientes.id_cliente WHERE id_sucursal = $id_sucursal ORDER BY id_cotizacion DESC LIMIT 75";
}



$rsBuscadorCotizaciones = $conexion->query($consultaCotizaciones);

echo '<table class="table-sm table-bordered table-striped" id="tablaCotizaciones">
            <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th style="text-align: right;">Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  

$contador = 0;

while($resultadoCotizaciones = $rsBuscadorCotizaciones->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoCotizaciones["id_cotizacion"].'
    </td>
    <td>
    '.$resultadoCotizaciones["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoCotizaciones["total"], 2).'
    </td> 
    <td>
    '.$resultadoCotizaciones["fecha"].'
    </td>
    <td class="botones">
        <div class="btn-group">
            <button class="btn-sm btn-success btnVerPartidasCotizacion" id_cotizacion="'.$resultadoCotizaciones["id_cotizacion"].'">Ver cotizacion
            </button>

        </div>
    </td>';
            
    

    


} 



echo '</tbody>
                  <tfoot>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th style="text-align: right;">Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>';



        ?>




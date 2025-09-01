<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];



$busquedaVentas = $_POST["buscarVentasDevoluciones"];


if ($busquedaVentas != "") {


        

    /*$porcionesVentas = explode(" ", $busquedaVentas);
    $contadorVentas = count($porcionesVentas); 

    for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
        $generaFiltroVentas = $generaFiltroVentas."ventas.id LIKE '%".$porcionesVentas[$iVentas]."%'";

        if ($iVentas < $contadorVentas-1) {
           $generaFiltroVentas = $generaFiltroVentas." AND ";
       }

   }


   $generaFiltroVentas = $generaFiltroVentas." OR ";

for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
    $generaFiltroVentas = $generaFiltroVentas."DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesVentas[$iVentas]."%'";

    if ($iVentas < $contadorVentas-1) {
       $generaFiltroVentas = $generaFiltroVentas." AND ";
   }

}


$generaFiltroVentas = $generaFiltroVentas." OR ";

for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
    $generaFiltroVentas = $generaFiltroVentas."ventas.folio LIKE '%".$porcionesVentas[$iVentas]."%'";

    if ($iVentas < $contadorVentas-1) {
       $generaFiltroVentas = $generaFiltroVentas." AND ";
   }
}



$generaFiltroVentas = $generaFiltroVentas." OR ";

for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
    $generaFiltroVentas = $generaFiltroVentas."clientes.nombre LIKE '%".$porcionesVentas[$iVentas]."%'";

    if ($iVentas < $contadorVentas-1) {
       $generaFiltroVentas = $generaFiltroVentas." AND ";
   }

}*/


$consultaVentas= "SELECT ventas.id, ventas.folio, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (ventas.id = '$busquedaVentas' OR ventas.folio = '$busquedaVentas') AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_sucursal = $id_sucursal";


}else{

    //$consultaVentas = "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente ORDER BY id DESC LIMIT 50";
}


/*if($_SESSION['id'] == 1){
 echo $consultaVentas;
}*/

$rsBuscadorVentas = $conexion->query($consultaVentas); 

$contador = 0; 

while($resultadoVentas = $rsBuscadorVentas->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
    

    <td>
    '.$resultadoVentas["id"].'
    </td>
    <td>
    '.$resultadoVentas["folio"].'
    </td>
    <td>
    '.$resultadoVentas["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoVentas["total"], 2).'
    </td>
    <td>
    '.$resultadoVentas["tipo_venta"].'
    </td>  
    <td>
    '.$resultadoVentas["fecha"].'
    </td>
    <td class="botones">
        <div class="btn-group">
            <button class="btn btn-info btnSeleccionaVentaDevolucion guardaFoco'.$contador.'" contador = "'.$contador.'" id_venta="'.$resultadoVentas["id"].'">Seleccionar</button>
        </div>
    </td>';
    

    


} 








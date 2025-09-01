<?php 
//error_reporting(0);
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

$busquedaEntregaVentas = $_POST["buscarEntregaVentas"];


if ($busquedaEntregaVentas != "") {


        

    $porcionesEntregaVentas = explode(" ", $busquedaEntregaVentas);
    $contadorEntregaVentas = count($porcionesEntregaVentas); 
    $generaFiltroEntregaVentas = "";

    for ($iEntregaVentas=0; $iEntregaVentas < $contadorEntregaVentas; $iEntregaVentas++) { 
        $generaFiltroEntregaVentas = $generaFiltroEntregaVentas."ventas.id LIKE '%".$porcionesEntregaVentas[$iEntregaVentas]."%'";

        if ($iEntregaVentas < $contadorEntregaVentas-1) {
           $generaFiltroEntregaVentas = $generaFiltroEntregaVentas." AND ";
       }

   }


   $generaFiltroEntregaVentas = $generaFiltroEntregaVentas." OR ";

for ($iEntregaVentas=0; $iEntregaVentas < $contadorEntregaVentas; $iEntregaVentas++) { 
    $generaFiltroEntregaVentas = $generaFiltroEntregaVentas."DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesEntregaVentas[$iEntregaVentas]."%'";

    if ($iEntregaVentas < $contadorEntregaVentas-1) {
       $generaFiltroEntregaVentas = $generaFiltroEntregaVentas." AND ";
   }

}


$generaFiltroEntregaVentas = $generaFiltroEntregaVentas." OR ";

for ($iEntregaVentas=0; $iEntregaVentas < $contadorEntregaVentas; $iEntregaVentas++) { 
    $generaFiltroEntregaVentas = $generaFiltroEntregaVentas."ventas.folio LIKE '%".$porcionesEntregaVentas[$iEntregaVentas]."%'";

    if ($iEntregaVentas < $contadorEntregaVentas-1) {
       $generaFiltroEntregaVentas = $generaFiltroEntregaVentas." AND ";
   }
}



$generaFiltroEntregaVentas = $generaFiltroEntregaVentas." OR ";

for ($iEntregaVentas=0; $iEntregaVentas < $contadorEntregaVentas; $iEntregaVentas++) { 
    $generaFiltroEntregaVentas = $generaFiltroEntregaVentas."clientes.nombre LIKE '%".$porcionesEntregaVentas[$iEntregaVentas]."%'";

    if ($iEntregaVentas < $contadorEntregaVentas-1) {
       $generaFiltroEntregaVentas = $generaFiltroEntregaVentas." AND ";
   }

}


$consultaEntregaVentas= "SELECT ventas.id, clientes.nombre AS nombre_cliente, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha_creacion, vendedores.nombres, vendedores.apellido_p, vendedores.apellido_m FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente INNER JOIN vendedores ON ventas.id_vendedor = vendedores.id_vendedor WHERE (".$generaFiltroEntregaVentas.") AND ventas.id_sucursal = $id_sucursal AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.entregada = 0 ORDER BY id DESC LIMIT 50";



}else{

    $consultaEntregaVentas = "SELECT ventas.id, clientes.nombre AS nombre_cliente, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha_creacion, vendedores.nombres, vendedores.apellido_p, vendedores.apellido_m FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente INNER JOIN vendedores ON ventas.id_vendedor = vendedores.id_vendedor WHERE ventas.id_sucursal = $id_sucursal AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.entregada = 0 ORDER BY id DESC LIMIT 50";


}


$rsBuscadorEntregaVentas = $conexion->query($consultaEntregaVentas);  

echo '<table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>';
                  

while($resultadoEntregaVentas = $rsBuscadorEntregaVentas->fetch_array(MYSQLI_BOTH)){ 


    $nombre_vendedor = $resultadoEntregaVentas["nombres"]." ".$resultadoEntregaVentas["apellido_p"]." ".$resultadoEntregaVentas["apellido_m"];

    echo '<tr>
    

    <td>
    '.$resultadoEntregaVentas["id"].'
    </td>
    <td>
    '.$resultadoEntregaVentas["nombre_cliente"].'
    </td>
    <td>
    '.$resultadoEntregaVentas["total"].'
    </td>
    <td>
    '.$resultadoEntregaVentas["tipo_venta"].'
    </td>  
    <td>
    '.$resultadoEntregaVentas["fecha_creacion"].'
    </td>
    <td>
    '.$nombre_vendedor.'
    </td>
    <td><div class="btn-group">
<button class="btn btn-info btnSeleccionaEntregaVenta" id_venta="'.$resultadoEntregaVentas["id"].'">Comenzar entrega</button></div>';
    

    


} 




echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
        </table>';



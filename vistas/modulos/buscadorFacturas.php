<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "conexion.php";




$busquedaFacturas = $_POST["buscarFacturas"];


if ($busquedaFacturas != "") {


        

    $porcionesFacturas = explode(" ", $busquedaFacturas);
    $contadorFacturas = count($porcionesFacturas); 

    for ($iFacturas=0; $iFacturas < $contadorFacturas; $iFacturas++) { 
        $generaFiltroFacturas = $generaFiltroFacturas."ventas.id LIKE '%".$porcionesFacturas[$iFacturas]."%'";

        if ($iFacturas < $contadorFacturas-1) {
           $generaFiltroFacturas = $generaFiltroFacturas." AND ";
       }

   }


   $generaFiltroFacturas = $generaFiltroFacturas." OR ";

for ($iFacturas=0; $iFacturas < $contadorFacturas; $iFacturas++) { 
    $generaFiltroFacturas = $generaFiltroFacturas."DATE_FORMAT(ventas.fecha,'%d-%m-%Y') LIKE '%".$porcionesFacturas[$iFacturas]."%'";

    if ($iFacturas < $contadorFacturas-1) {
       $generaFiltroFacturas = $generaFiltroFacturas." AND ";
   }

}


$generaFiltroFacturas = $generaFiltroFacturas." OR ";

for ($iFacturas=0; $iFacturas < $contadorFacturas; $iFacturas++) { 
    $generaFiltroFacturas = $generaFiltroFacturas."ventas.folio LIKE '%".$porcionesFacturas[$iFacturas]."%'";

    if ($iFacturas < $contadorFacturas-1) {
       $generaFiltroFacturas = $generaFiltroFacturas." AND ";
   }
}



$generaFiltroFacturas = $generaFiltroFacturas." OR ";

for ($iFacturas=0; $iFacturas < $contadorFacturas; $iFacturas++) { 
    $generaFiltroFacturas = $generaFiltroFacturas."clientes.nombre LIKE '%".$porcionesFacturas[$iFacturas]."%'";

    if ($iFacturas < $contadorFacturas-1) {
       $generaFiltroFacturas = $generaFiltroFacturas." AND ";
   }

}


$consultaFacturas= "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (".$generaFiltroFacturas.") AND ventas.tipo_venta = 'FC' AND facturado = 0 ORDER BY id DESC LIMIT 50";


}else{

    $consultaFacturas = "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE ventas.tipo_venta = 'FC' AND facturado = 0 ORDER BY id DESC LIMIT 50";
}



$rsBuscadorFacturas = $conexion->query($consultaFacturas);  

while($resultadoFacturas = $rsBuscadorFacturas->fetch_array(MYSQLI_BOTH)){ 


    

    echo '<tr>
    

    <td>
    '.$resultadoFacturas["id"].'
    </td>
    <td>
    '.$resultadoFacturas["nombre"].'
    </td>
    <td>
    '.$resultadoFacturas["total"].'
    </td>
    <td>
    '.$resultadoFacturas["tipo_venta"].'
    </td>  
    <td>
    '.$resultadoFacturas["fecha"].'
    </td>
    <td><div class="btn-group">


    <button class="btn btn-warning btnFacturar" id_venta="'.$resultadoFacturas["id"].'"
     accesskey="0" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalConvertirNotaFactura">Volver a facturar</button></div></td></tr>';

    


} 








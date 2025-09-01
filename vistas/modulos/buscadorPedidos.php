<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "conexion.php";




$busquedaPedidos = $_POST["buscarPedidos"];


if ($busquedaPedidos != "") {


        

    $porcionesPedidos = explode(" ", $busquedaPedidos);
    $contadorPedidos = count($porcionesPedidos); 

    for ($iPedidos=0; $iPedidos < $contadorPedidos; $iPedidos++) { 
        $generaFiltroPedidos = $generaFiltroPedidos."pedidos.id LIKE '%".$porcionesPedidos[$iPedidos]."%'";

        if ($iPedidos < $contadorPedidos-1) {
           $generaFiltroPedidos = $generaFiltroPedidos." AND ";
       }

   }


   $generaFiltroPedidos = $generaFiltroPedidos." OR ";

for ($iPedidos=0; $iPedidos < $contadorPedidos; $iPedidos++) { 
    $generaFiltroPedidos = $generaFiltroPedidos."DATE_FORMAT(pedidos.fecha,'%d-%m-%Y') LIKE '%".$porcionesPedidos[$iPedidos]."%'";

    if ($iPedidos < $contadorPedidos-1) {
       $generaFiltroPedidos = $generaFiltroPedidos." AND ";
   }

}


$generaFiltroPedidos = $generaFiltroPedidos." OR ";

for ($iPedidos=0; $iPedidos < $contadorPedidos; $iPedidos++) { 
    $generaFiltroPedidos = $generaFiltroPedidos."pedidos.folio LIKE '%".$porcionesPedidos[$iPedidos]."%'";

    if ($iPedidos < $contadorPedidos-1) {
       $generaFiltroPedidos = $generaFiltroPedidos." AND ";
   }
}



$generaFiltroPedidos = $generaFiltroPedidos." OR ";

for ($iPedidos=0; $iPedidos < $contadorPedidos; $iPedidos++) { 
    $generaFiltroPedidos = $generaFiltroPedidos."clientes.nombre LIKE '%".$porcionesPedidos[$iPedidos]."%'";

    if ($iPedidos < $contadorPedidos-1) {
       $generaFiltroPedidos = $generaFiltroPedidos." AND ";
   }

}


$consultaPedidos= "SELECT pedidos.id, clientes.nombre, pedidos.total, pedidos.saldo_actual, pedidos.tipo_pedido, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente WHERE (".$generaFiltroPedidos.") ORDER BY id DESC LIMIT 50";


}else{

    $consultaPedidos = "SELECT pedidos.id, clientes.nombre, pedidos.total, pedidos.saldo_actual, pedidos.tipo_pedido, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente WHERE ORDER BY id DESC LIMIT 50";
}



$rsBuscadorPedidos = $conexion->query($consultaPedidos);  

while($resultadoPedidos = $rsBuscadorPedidos->fetch_array(MYSQLI_BOTH)){ 


    

    echo '<tr>
    

    <td>
    '.$resultadoPedidos["id"].'
    </td>
    <td>
    '.$resultadoPedidos["nombre"].'
    </td>
    <td>
    '.$resultadoPedidos["total"].'
    </td>
    <td>
    '.$resultadoPedidos["tipo_pedido"].'
    </td>  
    <td>
    '.$resultadoPedidos["fecha"].'
    </td>';
    

    


} 








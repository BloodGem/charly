<?php 
//error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];



$busqueda = $_POST["buscarVentasGarantias"];

$genera_filtro = "";

if ($busqueda != "") {


        

    $porciones = explode(" ", $busqueda);
    $contador = count($porciones); 

    for ($i=0; $i < $contador; $i++) { 
        $genera_filtro = $genera_filtro."ventas.id LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
           $genera_filtro = $genera_filtro." AND ";
       }

   }


   $genera_filtro = $genera_filtro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $genera_filtro = $genera_filtro."DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $genera_filtro = $genera_filtro." AND ";
   }

}


$genera_filtro = $genera_filtro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $genera_filtro = $genera_filtro."ventas.folio LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $genera_filtro = $genera_filtro." AND ";
   }
}



$genera_filtro = $genera_filtro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $genera_filtro = $genera_filtro."clientes.nombre LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $genera_filtro = $genera_filtro." AND ";
   }

}


$consultaVentas= "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (".$genera_filtro.") AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_sucursal = $id_sucursal ORDER BY id DESC LIMIT 50";


}else{

    //$consultaVentas = "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente ORDER BY id DESC LIMIT 50";
}



$rsBuscadorVentas = $conexion->query($consultaVentas); 

$contador = 0; 

while($resultadoVentas = $rsBuscadorVentas->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
    

    <td>
    '.$resultadoVentas["id"].'
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
            <button class="btn btn-info btnSeleccionaVentaGarantia guardaFoco'.$contador.'" contador = "'.$contador.'" id_venta="'.$resultadoVentas["id"].'">Seleccionar</button>
        </div>
    </td>';
    

    


} 







